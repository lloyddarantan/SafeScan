// validation step 1
function showNextStep() {
    const step1Div = document.getElementById('step-1');
    const step2Div = document.getElementById('step-2');
    
    if (!step1Div || !step2Div) return;

    const inputs = step1Div.querySelectorAll('input');
    let allValid = true;

    inputs.forEach(input => {
        const value = input.value.trim();
        let errorMsg = "";

// to check empty
        if (value === "") {
            errorMsg = "This field is required.";
        } 

// to check email format
        else if (input.type === "email") {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(value)) errorMsg = "Please enter a valid email.";
        } 
// to check number format
        else if (input.type === "tel" || input.placeholder.includes("09")) {
            const phonePattern = /^[0-9]+$/;
            if (!phonePattern.test(value)) errorMsg = "Numbers only.";
        }

        if (errorMsg !== "") {
            allValid = false;
            markError(input, errorMsg);
        } else {
            removeError(input);
        }
    });

    if (allValid) {
        step1Div.style.display = 'none';
        step2Div.style.display = 'block';
    }
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.type = (input.type === "password") ? "text" : "password";
}


// error float logic
function markError(input, message) {
    input.classList.add('input-error');

// to find which has error
    const parent = input.closest('.input-group') || input.closest('.address-field') || input.parentElement;

// remove existing error if any
    const existingError = parent.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

// floating error message
    const errorDisplay = document.createElement('div');
    errorDisplay.className = 'error-message';
    errorDisplay.textContent = message;
    
    parent.appendChild(errorDisplay);

// remove on type
    input.addEventListener('input', function() {
        removeError(input);
    }, { once: true });
}

function removeError(input) {
    input.classList.remove('input-error');
    const parent = input.closest('.input-group') || input.closest('.address-field') || input.parentElement;
    const errorDisplay = parent.querySelector('.error-message');
    if (errorDisplay) {
        errorDisplay.remove();
    }
}


//                                   //
// FOR UNIVERSAL LOGIN FORM         //
//                                 //

document.addEventListener('DOMContentLoaded', function() {
    
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            let isFormValid = true;

// Email
            const emailInput = loginForm.querySelector('input[type="email"]');
            if (emailInput && emailInput.value.trim() === "") {
                isFormValid = false;
                markError(emailInput, "Email is required.");
            }

// Password
            const passInput = loginForm.querySelector('input[type="password"]');
            if (passInput && passInput.value.trim() === "") {
                isFormValid = false;
                markError(passInput, "Password is required.");
            }

// OTP
            const otpInput = document.getElementById('otp-input'); 
            if (otpInput && otpInput.value.trim() === "") {
                isFormValid = false;
                markError(otpInput, "Please enter the OTP.");
            }

            if (!isFormValid) event.preventDefault(); 
        });
    }

 //                                   //
// FOR ADMIN AND MEMBER SIGNUP FORM //
//                                 //
    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', function(event) {
            let isValid = true;

// validate Passwords
            const pass1 = document.getElementById('passInput') || document.getElementById('passInputMem');
            const pass2 = document.getElementById('confirmPassInput') || document.getElementById('confirmPassInputMem');
            
            if (pass1 && pass1.value.trim() === "") {
                isValid = false;
                markError(pass1, "Password required.");
            }
            if (pass2) {
                if (pass2.value.trim() === "") {
                    isValid = false;
                    markError(pass2, "Confirm password.");
                } else if (pass1 && pass1.value !== pass2.value) {
                    isValid = false;
                    markError(pass2, "Passwords do not match!"); 
                }
            }

// validate address fields
            const addressInputs = signupForm.querySelectorAll('.address-grid input');
            addressInputs.forEach(addrInput => {
                if (addrInput.value.trim() === "") {
                    isValid = false;
                    markError(addrInput, "Required.");
                }
            });

 // validate signup OTP
            const otpInput = document.querySelector('#step-2 input[placeholder="_ _ _ _"]');
            if (otpInput && otpInput.value.trim() === "") {
                isValid = false;
                markError(otpInput, "OTP required.");
            }

            if (!isValid) event.preventDefault();
        });
    }
});