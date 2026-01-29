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
        navElement.classList.add('active');
    }

//                               // 
// EDIT PROFILE MODAL
//                              //   
    const editModal = document.getElementById('editModal');
    const editBtns = document.querySelectorAll('.edit-btn');

    if (editBtns) {
        editBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault(); 
                clearErrors();
                editModal.classList.add('show');
            });
        });
    }

    function closeModal() {
        editModal.classList.remove('show');
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
            const postal = form.querySelector('input[name="postal"]');

        
// required Text Fields
            const requiredInputs = form.querySelectorAll('input[type="text"]');
            requiredInputs.forEach(input => {
                if(input.value.trim() === '') {
                    showError(input, 'This field is required');
                    isValid = false;
                }
            });

// email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value.trim())) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }

// phone number
            const phonePattern = /^[0-9+\s]+$/;
            if (!phonePattern.test(contact.value.trim()) || contact.value.length < 7) {
                showError(contact, 'Invalid phone number');
                isValid = false;
            }

// postal
            if (isNaN(postal.value.trim())) {
                showError(postal, 'Postal code must be a number');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); 
            }
        });
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        input.style.borderColor = '#ff4d4d';
        const errorMsg = document.createElement('small');
        errorMsg.className = 'error-msg';
        errorMsg.style.color = '#ff4d4d';
        errorMsg.style.fontSize = '0.8rem';
        errorMsg.style.marginTop = '5px';
        errorMsg.innerText = message;
        formGroup.appendChild(errorMsg);
    }

    function clearErrors() {
        if (form) {
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.style.borderColor = '#ddd');
            const errors = form.querySelectorAll('.error-msg');
            errors.forEach(error => error.remove());
        }
    }

//                    //
// LOGOUT MODAL 
//                    //
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('show');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('show');
    }

//                     //
// DELETE MODAL
//                    //
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }
