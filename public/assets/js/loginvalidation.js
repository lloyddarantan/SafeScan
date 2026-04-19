/* =========================================
   STEP NAVIGATION (Next / Back)
   ========================================= */

function showNextStep() {
    const step1Div = document.getElementById('step-1');
    const step2Div = document.getElementById('step-2');
    
    if (!step1Div || !step2Div) return;

    // Select all inputs in Step 1
    const inputs = step1Div.querySelectorAll('input');
    let allValid = true;

    inputs.forEach(input => {
        const value = input.value.trim();
        let errorMsg = "";

        // Check if empty
        if (value === "") {
            errorMsg = "This field is required.";
        } 
        // Check phone format
        else if (input.type === "tel" || input.name === "phone") {
            const phonePattern = /^[0-9]+$/;
            if (!phonePattern.test(value)) errorMsg = "Numbers only.";
        }

        // Apply or remove error
        if (errorMsg !== "") {
            allValid = false;
            markError(input, errorMsg);
        } else {
            removeError(input);
        }
    });

    // If no errors, proceed to Step 2
    if (allValid) {
        step1Div.style.display = 'none';
        step2Div.style.display = 'block';
    }
}

function showPreviousStep() {
    const step1Div = document.getElementById('step-1');
    const step2Div = document.getElementById('step-2');

    if (step1Div && step2Div) {
        step2Div.style.display = 'none';
        step1Div.style.display = 'block';
    }
}

/* =========================================
   UI INTERACTIONS (Password Toggle)
   ========================================= */

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;

    // Toggle Input Type
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
    
    // Toggle Icon Class
    const icon = input.nextElementSibling;
    if (icon && icon.classList.contains('password-toggle')) {
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
}

/* =========================================
   ERROR HANDLING (Floating Messages)
   ========================================= */

function markError(input, message) {
    input.classList.add('input-error');

    // Find the closest parent to append the error message
    const parent = input.closest('.input-group') || input.closest('.address-field') || input.parentElement;

    // Remove existing error if present
    const existingError = parent.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Create the error message div
    const errorDisplay = document.createElement('div');
    errorDisplay.className = 'error-message';
    errorDisplay.textContent = message;
    
    parent.appendChild(errorDisplay);

    // Remove error as soon as user types
    input.addEventListener('input', function() {
        removeError(input);
    }, { once: true });
}

function removeError(input) {
    input.classList.remove('input-error');
    const parent = input.closest('.input-group') || input.closest('.address-field') || input.parentElement;
    if(parent) {
        const errorDisplay = parent.querySelector('.error-message');
        if (errorDisplay) {
            errorDisplay.remove();
        }
    }
}

/* =========================================
   FORM SUBMISSION VALIDATION
   ========================================= */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. LOGIN FORM VALIDATION ---
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            let isFormValid = true;

            // Email Check
            const emailInput = loginForm.querySelector('input[name="email"]');
            if (emailInput && emailInput.value.trim() === "") {
                isFormValid = false;
                markError(emailInput, "Email is required.");
            }

            // Password Check
            const passInput = loginForm.querySelector('input[name="password"]');
            if (passInput && passInput.value.trim() === "") {
                isFormValid = false;
                markError(passInput, "Password is required.");
            }

            // OTP Check (if visible)
            const otpInput = document.getElementById('otp-input'); 
            if (otpInput && otpInput.offsetParent !== null && otpInput.value.trim() === "") {
                isFormValid = false;
                markError(otpInput, "Please enter the OTP.");
            }

            if (!isFormValid) event.preventDefault(); 
        });
    }

    // --- 2. SIGNUP FORM VALIDATION ---
    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate Email
            const emailInput = signupForm.querySelector('input[name="email"]');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailInput) {
                if (emailInput.value.trim() === "") {
                    isValid = false;
                    markError(emailInput, "Email is required.");
                } else if (!emailPattern.test(emailInput.value.trim())) {
                    isValid = false;
                    markError(emailInput, "Invalid email format.");
                }
            }

            // Validate Passwords
            const pass1 = document.getElementById('passInput');
            const pass2 = document.getElementById('confirmPassInput');
            
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

            if (!isValid) event.preventDefault();
        });
    }
	
	});

document.addEventListener('DOMContentLoaded', function() {

    const closeBtn = document.getElementById('close-modal-btn');
    const sendOtpBtn = document.getElementById('send-otp-btn');
    const resetPassBtn = document.getElementById('reset-pass-btn');

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (sendOtpBtn) {
        sendOtpBtn.addEventListener('click', sendOTP);
    }

    if (resetPassBtn) {
        resetPassBtn.addEventListener('click', resetPassword);
    }

});

function sendOTP() {
    const emailInput = document.getElementById('fp-email');
    const email = emailInput.value.trim();

    if (email === "") {
        showResponseModal("error", "Please enter your email first.");
        return;
    }

    fetch('/send-otp', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'email=' + encodeURIComponent(email)
    })
    .then(res => res.json())
    .then(data => {

        console.log("OTP RESPONSE:", data); // DEBUG

        if (data.status === "success") {
            showResponseModal("success", data.message || "OTP sent successfully");
        } else {
            const msg = data.message || "";

            if (msg.toLowerCase().includes("email not found")) {
                showResponseModal("error", "Email cannot be found.");
            } else {
                showResponseModal("error", msg || "Failed to send OTP");
            }
        }
    })
    .catch(err => {
        console.error(err);
        showResponseModal("error", "Server error. Please try again.");
    });
}

function resetPassword() {
    const email = document.getElementById('fp-email').value;
    const otp = document.getElementById('fp-otp').value;
    const password = document.getElementById('fp-password').value;

    fetch('/reset-password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${email}&otp=${otp}&password=${password}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            showResponseModal("success", "Password reset successful!");

            // OPTIONAL: close forgot modal after success
            setTimeout(() => {
                closeModal();
            }, 2000);

        } else {
            showResponseModal("error", data.message || "Reset failed");
        }
    })
    .catch(() => {
        showResponseModal("error", "Something went wrong. Try again.");
    });
}
	
document.addEventListener('DOMContentLoaded', function() {
    
    const forgotLink = document.getElementById('forgot-password-link');
    const modal = document.getElementById('forgotModal');

    if (forgotLink && modal) {
        forgotLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('show');
        });
    }
});

function showResponseModal(type, message) {
    const modal = document.getElementById("responseModal");
    const title = document.getElementById("responseTitle");
    const msg = document.getElementById("responseMessage");

    // SAFETY CHECK (IMPORTANT)
    if (!modal || !title || !msg) {
        console.error("Response modal elements not found in DOM");
        alert(message); // fallback so user still sees something
        return;
    }

    const box = modal.querySelector(".forgot-modal-content");

    if (box) {
        box.classList.remove("response-success", "response-error");
    }

    if (type === "success") {
        title.innerText = "Success";
        if (box) box.classList.add("response-success");
    } else {
        title.innerText = "Error";
        if (box) box.classList.add("response-error");
    }

    msg.innerText = message;
    modal.classList.add("show");
}

function closeResponseModal() {
    document.getElementById("responseModal").classList.remove("show");
}

window.closeModal = function() {
    document.getElementById('forgotModal').classList.remove('show');
};

document.addEventListener('DOMContentLoaded', function () {
    const emailField = document.getElementById('fp-email');
    if (emailField) {
        emailField.addEventListener('input', function () {
            this.classList.remove('input-error');
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("responseModal");

    if (modal) {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.classList.remove("show");
            }
        });
    }
});
