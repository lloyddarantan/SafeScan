let outlets = JSON.parse(localStorage.getItem('outlets')) || [
    {
        "socket-1": null,
        "socket-2": null,
        "socket-3": null
    }
];

let currentOutletIndex = parseInt(localStorage.getItem('currentOutletIndex')) || 0;

const MAX_AMPS = 15;
let mobileSelectedData = null;

function isMobileView() {
    return window.innerWidth <= 768;
}

//for mobile view
function handleApplianceClick(element) {
    if (!isMobileView()) return;

    document.querySelectorAll('.draggable-item')
        .forEach(el => el.classList.remove('mobile-selected'));

    if (mobileSelectedData && mobileSelectedData.elementId === element.id) {
        mobileSelectedData = null;
        return;
    }

    element.classList.add('mobile-selected');

    mobileSelectedData = {
        elementId: element.id,
        id: element.id,
        name: element.dataset.name,
        amps: parseFloat(element.dataset.amps),
        img: element.querySelector('img').src
    };

    showToast(`Selected: ${mobileSelectedData.name}`);
}

function optimizeForMobile() {
    if (isMobileView()) {
        document.querySelectorAll('.draggable-item').forEach(item => {
            item.setAttribute('draggable', 'false');
        });
    }
}

function handleSocketClick(socketElement) {
    if (!isMobileView()) return;

    const socketId = socketElement.id;

    if (mobileSelectedData) {
        if (outlets[currentOutletIndex][socketId] !== null) {
            showToast("Socket occupied", "error");
            return;
        }

        outlets[currentOutletIndex][socketId] = {
            id: mobileSelectedData.id,
            name: mobileSelectedData.name,
            amps: mobileSelectedData.amps
        };

        updateSocketVisual(socketElement, mobileSelectedData.img, mobileSelectedData.name);
        calculateTotals();
        saveState();

        mobileSelectedData = null;
        document.querySelectorAll('.draggable-item')
            .forEach(el => el.classList.remove('mobile-selected'));

        showToast("Connected", "success");
    } 
    else if (outlets[currentOutletIndex][socketId] !== null) {
        clearSocket(socketId);
        calculateTotals();
        showToast("Unplugged");
    }
}

// drag drop
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    if (isMobileView()) {
        ev.preventDefault();
        return;
    }

    ev.dataTransfer.setData("source", "sidebar");
    ev.dataTransfer.setData("id", ev.target.id);
    ev.dataTransfer.setData("name", ev.target.dataset.name);
    ev.dataTransfer.setData("amps", ev.target.dataset.amps);
    ev.dataTransfer.setData("img", ev.target.querySelector('img').src);
}

function dragFromSocket(ev) {
    if (isMobileView()) {
        ev.preventDefault();
        return;
    }

    let socketId = ev.target.parentNode.id;
    let data = outlets[currentOutletIndex][socketId];

    ev.dataTransfer.setData("source", "socket");
    ev.dataTransfer.setData("fromSocketId", socketId);
    ev.dataTransfer.setData("name", data.name);
    ev.dataTransfer.setData("amps", data.amps);
    ev.dataTransfer.setData("img", ev.target.src);
    ev.dataTransfer.setData("id", data.id);
}

function drop(ev) {
    ev.preventDefault();

    let targetSocket = ev.target.closest('.socket-dropzone');
    if (!targetSocket) return;

    const current = outlets[currentOutletIndex];

    if (current[targetSocket.id] !== null) {
        showToast("Socket occupied", "error");
        return;
    }

    let source = ev.dataTransfer.getData("source");
    let id = ev.dataTransfer.getData("id");
    let name = ev.dataTransfer.getData("name");
    let amps = parseFloat(ev.dataTransfer.getData("amps"));
    let imgSrc = ev.dataTransfer.getData("img");

    if (source === "socket") {
        let oldSocketId = ev.dataTransfer.getData("fromSocketId");
        clearSocket(oldSocketId);
    }

    current[targetSocket.id] = { id, name, amps, img: imgSrc };

    updateSocketVisual(targetSocket, imgSrc, name);
    calculateTotals();
    saveState();
}

function removeAppliance(ev) {
    ev.preventDefault();

    let source = ev.dataTransfer.getData("source");

    if (source === "socket") {
        let socketId = ev.dataTransfer.getData("fromSocketId");
        clearSocket(socketId);
        calculateTotals();
    }
}

function clearSocket(socketId) {
    outlets[currentOutletIndex][socketId] = null;
    saveState();

    let socketEl = document.getElementById(socketId);
    if (socketEl) {
        socketEl.classList.remove("has-item");
        let img = socketEl.querySelector('.plugged-icon');
        if (img) img.remove();
    }
}

function updateSocketVisual(socketElement, imgSrc, name) {
    socketElement.classList.add("has-item");

    let img = document.createElement("img");
    img.src = imgSrc;
    img.className = "plugged-icon";
    img.title = name;

    if (!isMobileView()) {
        img.draggable = true;
        img.ondragstart = dragFromSocket;
    }

    let oldImg = socketElement.querySelector('.plugged-icon');
    if (oldImg) oldImg.remove();

    socketElement.appendChild(img);
}

function clearOutlets() {
    const current = outlets[currentOutletIndex];

    Object.keys(current).forEach(key => {
        current[key] = null;

        let socketEl = document.getElementById(key);
        if (socketEl) {
            socketEl.classList.remove("has-item");
            let img = socketEl.querySelector('.plugged-icon');
            if (img) img.remove();
        }
    });

    calculateTotals();
    saveState();
}

function calculateTotals() {
    let totalAmps = 0;

    const current = outlets[currentOutletIndex];
    const socketKeys = Object.keys(current);

    socketKeys.forEach((key, index) => {
        const data = current[key];
        const listItem = document.querySelector(`#connection-list li:nth-child(${index + 1})`);

        if (!listItem) return;

        if (data) {
            totalAmps += data.amps;
            listItem.innerHTML = `Socket ${index + 1}: <strong>${data.name}</strong> (${data.amps}A)`;
        } else {
            listItem.innerHTML = `Socket ${index + 1}: <span class="empty-slot">-</span>`;
        }
    });

    document.getElementById("total-amps").innerText = totalAmps.toFixed(2);
    updateStatusBar(totalAmps);
}

function updateStatusBar(total) {
    let bar = document.getElementById("status-bar");
    let text = document.getElementById("status-text");

    bar.className = "status-bar";

    if (total <= 0) {
        bar.classList.add("safe");
        text.innerText = "System Idle";
    } else if (total > MAX_AMPS) {
        bar.classList.add("danger");
        text.innerText = `OVERLOAD (${total.toFixed(2)}A)`;
    } else if (total > MAX_AMPS * 0.8) {
        bar.classList.add("warning");
        text.innerText = "High Load";
    } else {
        bar.classList.add("safe");
        text.innerText = "System Normal";
    }
}

function toggleDropdown() {
    document.getElementById("outletDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.closest('.dropbtn')) {
        document.querySelectorAll(".dropdown-content")
            .forEach(d => d.classList.remove("show"));
    }
};

function setOutletMode(count) {
    const wallPlate = document.querySelector('.wall-plate');
    const socket3 = document.getElementById('socket-3');
    const listSocket3 = document.querySelector('#connection-list li:nth-child(3)');
    const current = outlets[currentOutletIndex];

    if (count === 2) {
        socket3.classList.add('hidden');
        wallPlate.classList.add('mode-2');
        if (listSocket3) listSocket3.style.display = 'none';

        current['socket-3'] = null;
        clearSocket('socket-3');
        calculateTotals();
    } else {
        socket3.classList.remove('hidden');
        wallPlate.classList.remove('mode-2');
        if (listSocket3) listSocket3.style.display = 'block';
    }

    document.getElementById("outletDropdown").classList.remove("show");
}

// cute msg pop
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span>${message}</span>`;

    container.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}



function addOutlet() {
    outlets.push({
        "socket-1": null,
        "socket-2": null,
        "socket-3": null
    });

    currentOutletIndex = outlets.length - 1;

    renderOutlet();
    updateDeleteButton();
    showToast("New outlet created"); saveState();
}

function nextOutlet() {
    if (currentOutletIndex < outlets.length - 1) {
        currentOutletIndex++;
        renderOutlet();
        saveState();
    } else {
        showToast("No next outlet");
    }
}

function prevOutlet() {
    if (currentOutletIndex > 0) {
        currentOutletIndex--;
        renderOutlet();
        saveState();
    } else {
        showToast("No previous outlet");
    }
}

function renderOutlet() {
    const current = outlets[currentOutletIndex];

    document.getElementById("outlet-page").innerText = currentOutletIndex + 1;

    Object.keys(current).forEach((socketId) => {
        const socketEl = document.getElementById(socketId);
        if (!socketEl) return;

        // CLEAR UI ONLY (NOT DATA)
        socketEl.classList.remove("has-item");
        let oldImg = socketEl.querySelector('.plugged-icon');
        if (oldImg) oldImg.remove();

        const data = current[socketId];

        if (data) {
            updateSocketVisual(socketEl, data.img, data.name);
        }
    });

    calculateTotals();
}

function deleteOutlet() {

    if (outlets.length === 1) {
        showToast("You must have at least 1 outlet", "error");
        return;
    }

    outlets.splice(currentOutletIndex, 1);

    if (currentOutletIndex >= outlets.length) {
        currentOutletIndex = outlets.length - 1;
    }

    renderOutlet();
    saveState();
    updateDeleteButton();

    showToast("Outlet deleted", "success");
}

function updateDeleteButton() {
    const btn = document.querySelector('[onclick="deleteOutlet()"]');
    if (!btn) return;

    btn.disabled = outlets.length === 1;
}

// SAVE Function, IMPORTANT!!
function saveState() {
    localStorage.setItem('outlets', JSON.stringify(outlets));
    localStorage.setItem('currentOutletIndex', currentOutletIndex);
}

window.addEventListener("DOMContentLoaded", () => {
    renderOutlet();
    optimizeForMobile();
    updateDeleteButton();
});

window.addEventListener('load', optimizeForMobile);
window.addEventListener('resize', optimizeForMobile);