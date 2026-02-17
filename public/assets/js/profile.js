//                  //
// SWITCH WINDOWS
//                 //
    function switchTab(tabId, navElement) {
		const sections = document.querySelectorAll('.content-section');
		sections.forEach(sec => sec.classList.remove('active'));

		const navLinks = document.querySelectorAll('.nav-item');
		navLinks.forEach(link => link.classList.remove('active'));

		const targetSection = document.getElementById('section-' + tabId);
		if (targetSection) {
			targetSection.classList.add('active');
		}

		if(navElement) {
			navElement.classList.add('active');
		}
	}

//                               // 
// EDIT PROFILE MODAL
//                              //   
    const editModal = document.getElementById('editModal');

	function openModal() {
    	const form = document.querySelector('.edit-form');
		if (form) {
			form.reset();
		}
		clearErrors();
		editModal.classList.add('show');
	}

	function closeModal() {
		editModal.classList.remove('show');
	}

//                    //
// LOGOUT MODAL 
//                    //
    const logoutModal = document.getElementById('logoutModal');

	function openLogoutModal() {
		logoutModal.classList.add('show');
	}

	function closeLogoutModal() {
		logoutModal.classList.remove('show');
	}

//                     //
// DELETE MODAL
//                    //
    const deleteModal = document.getElementById('deleteModal');

	function openDeleteModal() {
		deleteModal.classList.add('show');
	}

	function closeDeleteModal() {
		deleteModal.classList.remove('show');
	}

//                               //
// VALIDATION FOR EDIT PROFILE
//                              //

	const form = document.querySelector('.edit-form');

	if (form) {
		form.addEventListener('submit', function(e) {
			let isValid = true;
			clearErrors();

			const email = form.querySelector('input[name="email"]');
			const contact = form.querySelector('input[name="contact"]');

// Password fields
			const newPass = form.querySelector('input[name="new_password"]');
			const confirmPass = form.querySelector('input[name="confirm_password"]');

//Validate Required Text Fields
			const requiredInputs = form.querySelectorAll('input[type="text"]');
			requiredInputs.forEach(input => {
				if(input.value.trim() === '') {
					showError(input, 'This field is required');
					isValid = false;
				}
			});

//Validate Email
			const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (!emailPattern.test(email.value.trim())) {
				showError(email, 'Please enter a valid email address');
				isValid = false;
			}

//Validate Phone Number
			const phonePattern = /^[0-9+\s]+$/;
			if (!phonePattern.test(contact.value.trim()) || contact.value.length < 7) {
				showError(contact, 'Invalid phone number');
				isValid = false;
			}

//Validate Password
			if (newPass && confirmPass) {
            const newPassVal = newPass.value.trim();
            const confirmPassVal = confirmPass.value.trim();
				
            if (newPassVal !== '' || confirmPassVal !== '') {

                if (newPassVal === '') {
                    showError(newPass, 'Please enter a new password');
                    isValid = false;
                }

                if (newPassVal !== confirmPassVal) {
                    showError(confirmPass, 'Passwords do not match');
                    isValid = false;
                }
            }
        }

// If any validation failed, stop the form submission
			if (!isValid) {
				e.preventDefault(); 
			}
		});
	}

// Show Error Message
	function showError(input, message) {
		const formGroup = input.parentElement;
		input.style.borderColor = '#ff4d4d';

		const errorMsg = document.createElement('small');
		errorMsg.className = 'error-msg';
		errorMsg.style.color = '#ff4d4d';
		errorMsg.style.fontSize = '0.75rem';
		errorMsg.style.marginTop = '2px';
		errorMsg.style.display = 'block';
		errorMsg.innerText = message;

		formGroup.appendChild(errorMsg);
	}

//Clear Error Messages
	function clearErrors() {
		if (form) {
			const inputs = form.querySelectorAll('input');
			inputs.forEach(input => input.style.borderColor = '#ddd');

			const errors = form.querySelectorAll('.error-msg');
			errors.forEach(error => error.remove());
		}
	}


function removeSavedAppliance(event, form) {
    // 1. Prevent page reload
    event.preventDefault();

    // 2. Get the elements we need
    const btn = form.querySelector('.fav-btn');
    const card = form.closest('.product-card');
    
    // Grab the appliance ID from the hidden input in the form
    const applianceId = form.querySelector('input[name="appliance_id"]').value; 
    
    // Change icon to a loading spinner
    const originalIcon = btn.innerHTML;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
    btn.disabled = true;

    // 3. Send the background request
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (response.ok) {
            // --- SECTION 1: Remove from "My Saved Appliances" Tab ---
            card.style.transition = 'all 0.3s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                card.remove();
                checkIfGridEmpty();
            }, 300);

            // --- SECTION 2: Remove from "Outlet Management" Sidebar ---
            const draggableItem = document.getElementById('app-' + applianceId);
            if (draggableItem) {
                // If the item exists in the sidebar, remove it too
                draggableItem.remove();
                checkIfDraggableListEmpty();
                
                // Optional: If this appliance was CURRENTLY plugged into a socket, 
                // you might also want to trigger your function to unplug it here!
            }
            
            // showToast("Appliance removed");
        } else {
            alert("Failed to remove appliance. Please try again.");
            btn.innerHTML = originalIcon;
            btn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred.");
        btn.innerHTML = originalIcon;
        btn.disabled = false;
    });

    return false;
}

// Checks if "My Saved Appliances" is empty
function checkIfGridEmpty() {
    const grid = document.querySelector('#section-members .product-grid');
    const cards = grid.querySelectorAll('.product-card');
    
    if (cards.length === 0) {
        grid.innerHTML = "<p style='color: #666;'>You haven't saved any appliances yet.</p>";
    }
}

// Checks if the "Outlet Management" sidebar is empty
function checkIfDraggableListEmpty() {
    const list = document.querySelector('.draggable-list');
    const items = list.querySelectorAll('.draggable-item');
    
    if (items.length === 0) {
        list.innerHTML = '<p class="no-items">No saved appliances.</p>';
    }
}

// Check if that was the last appliance and show the "empty" message
function checkIfGridEmpty() {
    const grid = document.querySelector('#section-members .product-grid');
    const cards = grid.querySelectorAll('.product-card');
    
    if (cards.length === 0) {
        grid.innerHTML = "<p style='color: #666;'>You haven't saved any appliances yet.</p>";
    }
}

/* --- OUTLET MANAGEMENT LOGIC --- */

let outletState = {
    "socket-1": null,
    "socket-2": null,
    "socket-3": null
};

const MAX_AMPS = 15; 

function allowDrop(ev) {
    ev.preventDefault();
}

// 1. Dragging from the Sidebar
function drag(ev) {
    ev.dataTransfer.setData("source", "sidebar");
    ev.dataTransfer.setData("id", ev.target.id);
    ev.dataTransfer.setData("name", ev.target.dataset.name);
    ev.dataTransfer.setData("amps", ev.target.dataset.amps);
    ev.dataTransfer.setData("img", ev.target.querySelector('img').src);
}

// 2. Dragging from a Socket (New Function)
function dragFromSocket(ev) {
    let socketId = ev.target.parentNode.id; // Get the parent socket ID
    let data = outletState[socketId];

    ev.dataTransfer.setData("source", "socket");
    ev.dataTransfer.setData("fromSocketId", socketId);
    
    // Pass existing data so we can move it to another socket if desired
    ev.dataTransfer.setData("name", data.name);
    ev.dataTransfer.setData("amps", data.amps);
    ev.dataTransfer.setData("img", ev.target.src);
    ev.dataTransfer.setData("id", data.id);
}

function drop(ev) {
    ev.preventDefault();
    ev.stopPropagation(); 

    let targetSocket = ev.target.closest('.socket-dropzone');
    if (!targetSocket) return;

    if (outletState[targetSocket.id] !== null) {
        showToast("This socket is already occupied!", "error");
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
    
    // Only act if the item came from a socket
    let source = ev.dataTransfer.getData("source");
    
    if (source === "socket") {
        let socketId = ev.dataTransfer.getData("fromSocketId");
        clearSocket(socketId);
        calculateTotals();
    }
}

// Helper to clear a specific socket
function clearSocket(socketId) {
    // Clear Data
    outletState[socketId] = null;
    
    // Clear Visuals
    let socketEl = document.getElementById(socketId);
    if(socketEl) {
        socketEl.classList.remove("has-item");
        let img = socketEl.querySelector('.plugged-icon');
        if(img) img.remove();
    }
}

function updateSocketVisual(socketElement, imgSrc, name) {
    socketElement.classList.add("has-item");
    
    let img = document.createElement("img");
    img.src = imgSrc;
    img.className = "plugged-icon";
    img.title = name; // Tooltip
    
    // MAKE THE PLUGGED ITEM DRAGGABLE
    img.draggable = true;
    img.ondragstart = dragFromSocket;
    
    let oldImg = socketElement.querySelector('.plugged-icon');
    if(oldImg) oldImg.remove();
    
    socketElement.appendChild(img);
}
function clearOutlets() {
    // Reset State
    outletState = { "socket-1": null, "socket-2": null, "socket-3": null };
    
    document.querySelectorAll('.socket-dropzone').forEach(socket => {
        socket.classList.remove("has-item");
        let img = socket.querySelector('.plugged-icon');
        if(img) img.remove();
    });

    calculateTotals();
}

function calculateTotals() {
    let totalAmps = 0;
    
// Loop through state to update list and sum amps
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

    let totalEl = document.getElementById("total-amps");
    totalEl.innerText = totalAmps.toFixed(2);

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
        text.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> WARNING: OVERLOAD DETECTED (${total.toFixed(2)}A)`;
    } else if (total > (MAX_AMPS * 0.8)) {
        bar.classList.add("warning");
        text.innerText = "Caution: High Load";
    } else {
        bar.classList.add("safe");
        text.innerText = "System Normal";
    }
}

function toggleDropdown() {
    document.getElementById("outletDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.closest('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function setOutletMode(count) {
    const wallPlate = document.querySelector('.wall-plate');
    const socket3 = document.getElementById('socket-3');
    const listSocket3 = document.querySelector('#connection-list li:nth-child(3)');

    if (count === 2) {
        socket3.classList.add('hidden');
        wallPlate.classList.add('mode-2');
        
        if(listSocket3) listSocket3.style.display = 'none';

        if (outletState['socket-3'] !== null) {
            socket3.classList.remove("has-item");
            let img = socket3.querySelector('.plugged-icon');
            if(img) img.remove();
            
            outletState['socket-3'] = null;
            
            calculateTotals();
        }

    } else {
        socket3.classList.remove('hidden');
        wallPlate.classList.remove('mode-2');
        
        if(listSocket3) listSocket3.style.display = 'block';
    }

    document.getElementById("outletDropdown").classList.remove("show");
}

function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    let iconClass = 'fa-circle-info';
    if (type === 'error') iconClass = 'fa-circle-exclamation';
    if (type === 'success') iconClass = 'fa-circle-check';
    if (type === 'warning') iconClass = 'fa-triangle-exclamation';

    toast.innerHTML = `
        <i class="fa-solid ${iconClass}"></i>
        <span class="toast-message">${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = "fadeOut 0.5s forwards";
        toast.addEventListener('animationend', () => {
            toast.remove();
        });
    }, 3000);
}

window.addEventListener('load', () => {
    const hash = window.location.hash.slice(1);
    if(hash) {
        const navItem = Array.from(document.querySelectorAll('.nav-item'))
                             .find(el => el.getAttribute('onclick')?.includes(hash));
        if(navItem) {

            const onclickAttr = navItem.getAttribute('onclick');
            const match = /switchTab\('(.+?)'/.exec(onclickAttr);
            if(match) {
                const tabId = match[1];
                switchTab(tabId, navItem);
            }
        } else {
            const section = document.getElementById('section-' + hash);
            if(section) section.classList.add('active');
        }
    }
});


