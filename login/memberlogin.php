<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan - Member Signup</title>
    <link rel="stylesheet" href="../view/assets/css/logincss/adminlogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="login-container">
        
<!-- left side design -->
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

<!-- righ side -->      
        <div class="login-right">
            <div class="form-wrapper">
                <h1>Make member account.</h1>
                <p class="subtitle">Set up your account to securely access scanning features.</p>

                <form action="#" method="POST" id="signup-form">

<!-- step 1 -->  
                    <div id="step-1">
                        <label>Full name</label>
                        <div class="input-group">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" placeholder="Enter your full name">
                        </div>

                        <label>Email Address</label>
                        <div class="input-group">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" placeholder="name@email.com">
                        </div>

                        <label>Phone number</label>
                        <div class="input-group">
                            <i class="fa-solid fa-mobile-screen input-icon"></i>
                            <input type="tel" placeholder="09..........">
                        </div>

                        <label>Email Address of <span style="color: #1A2238; font-weight: 700;">Admin</span></label>
                        <div class="input-group">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" placeholder="name@email.com">
                        </div>

                        <button type="button" class="btn-login" style="margin-top: 20px;" onclick="showNextStep()">Next</button>
                    </div>

<!-- step 2 -->
                    <div id="step-2" style="display: none;">
                        
                        <label>Password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" placeholder="Create a password" id="passInputMem">
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('passInputMem')"></i>
                        </div>

                        <label>Confirm password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" placeholder="Confirm your password" id="confirmPassInputMem">
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('confirmPassInputMem')"></i>
                        </div>

                        <label>OTP</label>
                        <div class="input-group" style="width: 50%;">
                            <i class="fa-regular fa-comment-dots input-icon"></i>
                            <input type="text" placeholder="_ _ _ _">
                        </div>
                        <div style="margin-top: -5px; margin-bottom: 20px; font-size: 0.85rem; color: #666;">
                            Send <span style="color: #F89b42; cursor: pointer; font-weight: 500;">SMS code.</span>
                        </div>

                        <button type="submit" class="btn-login">Register</button>
                    </div>

<!-- sign up links -->
                    <div class="signup-links" style="text-align: center; margin-top: 10px;">
                        <p style="color: #555;">
                            Have an account? 
                            <a href="universallogin.php" style="color: #F89b42; font-weight: 500;">Log in.</a>
                        </p>
                    </div>
                </form>
                
<!-- js script path -->
            <script src="../view/assets/js/loginvalidation.js"></script>
            </div>
        </div>

    </div>

</body>
</html>