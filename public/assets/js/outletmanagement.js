/* --- OUTLET MANAGEMENT LOGIC --- */

let outletState = {
    "socket-1": null,
    "socket-2": null,
    "socket-3": null
};

const MAX_AMPS = 15;
let mobileSelectedData = null;

/* --- MOBILE DETECTION --- */
function isMobileView() {
    return window.innerWidth <= 768;
}

/* --- MOBILE SELECT + TAP --- */
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

function handleSocketClick(socketElement) {
    if (!isMobileView()) return;

    const socketId = socketElement.id;

    if (mobileSelectedData) {
        if (outletState[socketId] !== null) {
            showToast("Socket occupied", "error");
            return;
        }

        outletState[socketId] = {
            id: mobileSelectedData.id,
            name: mobileSelectedData.name,
            amps: mobileSelectedData.amps
        };

        updateSocketVisual(socketElement, mobileSelectedData.img, mobileSelectedData.name);
        calculateTotals();

        mobileSelectedData = null;
        document.querySelectorAll('.draggable-item')
            .forEach(el => el.classList.remove('mobile-selected'));

        showToast("Connected", "success");
    } 
    else if (outletState[socketId] !== null) {
        clearSocket(socketId);
        calculateTotals();
        showToast("Unplugged");
    }
}

/* --- DRAG & DROP --- */
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
    let data = outletState[socketId];

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

    if (outletState[targetSocket.id] !== null) {
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

    outletState[targetSocket.id] = { id, name, amps };
    updateSocketVisual(targetSocket, imgSrc, name);
    calculateTotals();
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

/* --- SOCKET UI --- */
function clearSocket(socketId) {
    outletState[socketId] = null;

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
    outletState = {
        "socket-1": null,
        "socket-2": null,
        "socket-3": null
    };

    document.querySelectorAll('.socket-dropzone').forEach(socket => {
        socket.classList.remove("has-item");
        let img = socket.querySelector('.plugged-icon');
        if (img) img.remove();
    });

    calculateTotals();
}

/* --- CALCULATIONS --- */
function calculateTotals() {
    let totalAmps = 0;

    for (let i = 1; i <= 3; i++) {
        let key = "socket-" + i;
        let data = outletState[key];
        let listText = document.querySelector(`#connection-list li:nth-child(${i})`);

        if (data) {
            totalAmps += data.amps;
            listText.innerHTML = `Socket ${i}: <strong>${data.name}</strong> (${data.amps}A)`;
        } else {
            listText.innerHTML = `Socket ${i}: <span class="empty-slot">-</span>`;
        }
    }

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

/* --- DROPDOWN --- */
function toggleDropdown() {
    document.getElementById("outletDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.closest('.dropbtn')) {
        document.querySelectorAll(".dropdown-content")
            .forEach(d => d.classList.remove("show"));
    }
};

/* --- MODE (2 or 3 SOCKETS) --- */
function setOutletMode(count) {
    const wallPlate = document.querySelector('.wall-plate');
    const socket3 = document.getElementById('socket-3');
    const listSocket3 = document.querySelector('#connection-list li:nth-child(3)');

    if (count === 2) {
        socket3.classList.add('hidden');
        wallPlate.classList.add('mode-2');
        if (listSocket3) listSocket3.style.display = 'none';

        outletState['socket-3'] = null;
        clearSocket('socket-3');
        calculateTotals();
    } else {
        socket3.classList.remove('hidden');
        wallPlate.classList.remove('mode-2');
        if (listSocket3) listSocket3.style.display = 'block';
    }

    document.getElementById("outletDropdown").classList.remove("show");
}

/* --- TOAST --- */
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span>${message}</span>`;

    container.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}

/* --- MOBILE OPTIMIZATION --- */
function optimizeForMobile() {
    if (isMobileView()) {
        document.querySelectorAll('.draggable-item').forEach(item => {
            item.setAttribute('draggable', 'false');
        });
    }
}

window.addEventListener('load', optimizeForMobile);
window.addEventListener('resize', optimizeForMobile);