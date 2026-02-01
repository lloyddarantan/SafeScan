<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan - Admin Create Account</title>
    <link rel="stylesheet" href="public/assets/css/logincss/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="login-container">
        
<!-- logo left side part -->

        <div class="login-left">

            <div class="brand-logo">
                <svg class="logo-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
                    <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                    <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                    <path d="M16 20h2a2 2 0 0 0 2-2v-2"></path>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                </svg>
                <span>Safe Scan</span>
            </div>

            <div class="visual-container">
                <div class="circle-outer"></div>
                <div class="circle-inner"></div>
                <div class="energy-icon"><i class="fa-solid fa-bolt"></i></div>
            </div>

            <div class="left-content">
                <h2>Next Generation</h2>
                <h2 class="highlight">Electric Scanning Technology</h2>
                <p>Experience the fastest, most accurate electric scanning powered by advanced neural networks.</p>
            </div>
        </div>

<!-- right side login -->

        <div class="login-right">

            <a href="home.php" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </a>

            <div class="form-wrapper">
                <h1>Create an account.</h1>
                <p class="subtitle">Set up your account to securely access scanning features.</p>

                <form action="#" method="POST" id="signup-form">
    
<!-- first step create account -->
                    <div id="step-1">
                        <label>First name</label>
                        <div class="input-group">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" placeholder="Enter your first name">
                        </div>

                         <label>Last name</label>
                        <div class="input-group">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" placeholder="Enter your last name">
                        </div>

                        <label>Phone number</label>
                        <div class="input-group">
                            <i class="fa-solid fa-mobile-screen input-icon"></i>
                            <input type="tel" placeholder="09..........">
                        </div>

                        <label style="margin-top: 15px; margin-bottom: 10px; font-size: 1rem;">Home Address</label>
                        <div class="address-grid">
                            <div class="address-field">
                                <label>Country</label>
                                <input type="text">
                            </div>
                            <div class="address-field">
                                <label>Province</label>
                                <input type="text">
                            </div>
                            <div class="address-field">
                                <label>City</label>
                                <input type="text">
                            </div>
                            <div class="address-field">
                                <label>Street</label>
                                <input type="text">
                            </div>
                        </div>

                        <button type="button" class="btn-login" onclick="showNextStep()">Next</button>
                    </div>

<!-- second step create account -->
                    <div id="step-2" style="display: none;">
                        
                        <label>Email Address</label>
                        <div class="input-group">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" placeholder="name@email.com">
                        </div>

                        <label>Password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" placeholder="Create a password" id="passInput">
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('passInput')"></i>
                        </div>

                        <label>Confirm password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" placeholder="Confirm your password" id="confirmPassInput">
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('confirmPassInput')"></i>
                        </div>

<!-- button -->
                        <div class="button-group">
                            <button type="button" class="btn-back" onclick="showPreviousStep()">Back</button>
                            <button type="submit" class="btn-login">Register</button>
                        </div>
                    
                    </div> <div class="signup-links" style="text-align: center; margin-top: 10px;">
                        <p style="color: #555;">
                            Have an account? 
                            <a href="login.php" style="color: #F89b42; font-weight: 500;">Log in.</a>
                        </p>
                    </div>
                </form>

<!-- js script path -->
                <script src="../Safe Scan/loginvalidation.js"></script>
            </div>
        </div>

    </div>

</body>
</html>