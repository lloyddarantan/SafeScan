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
