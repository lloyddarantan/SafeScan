<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan - Login</title>
    <link rel="stylesheet" href="../view/assets/css/logincss/universallogin.css">
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
                <div class="energy-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
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
                <h1>Welcome!</h1>
                <p class="subtitle">Enter your credentials to access your scanning dashboard.</p>

                <form action="#" method="POST" id="login-form">
                    
                    <label>Email Address</label>
                    <div class="input-group">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" placeholder="name@email.com" required>
                    </div>

                    <label>Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" placeholder="•••••••" required>
                    </div>
                    <div class="forgot-link">
                        <a href="#">Forgot password?</a>
                    </div>

                    <label>OTP</label>
                <div class="otp-section">
                    <div class="input-group otp-input">
                        <i class="fa-regular fa-comment-dots input-icon"></i>
                        <input type="text" placeholder="_ _ _ _" id="otp-input">
                    </div>
                    <div class="sms-link">
                        <a href="#">Send <span class="highlight-text">SMS</span> code.</a>
                    </div>
                </div>

                    <button type="submit" class="btn-login">Log In</button>

<!-- sign up links -->
                    <div class="signup-links">
                        <p>Have no account? <a href="adminlogin.php">Create as <span class="role-admin">ADMIN</span>.</a></p>
                        
                        <p>Have no account? <a href="memberlogin.php">Create as <span class="role-member">MEMBER</span>.</a></p>
                    </div>
                </form>

<!-- js script path -->
                <script src="../view/assets/js/loginvalidation.js"></script>
            </div>
        </div>

    </div>

</body>
</html>