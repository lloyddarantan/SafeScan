<?php 
    $page = 'login';     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeScan</title>
    <link rel="stylesheet" href="/assets/css/logincss/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='orange' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 8V6a2 2 0 0 1 2-2h2'/%3E%3Cpath d='M4 16v2a2 2 0 0 0 2 2h2'/%3E%3Cpath d='M16 4h2a2 2 0 0 1 2 2v2'/%3E%3Cpath d='M16 20h2a2 2 0 0 0 2-2v-2'/%3E%3Cline x1='4' y1='12' x2='20' y2='12'/%3E%3C/svg%3E">
</head>
<body>

    <div class="login-container">

        <div class="login-left">
            <div class="brand-logo">
                <svg class="logo-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
                    <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                    <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                    <path d="M16 20h2a2 2 0 0 0 2-2v-2"></path>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                </svg>
                <span>SafeScan</span>
            </div>

            <div class="visual-container">
                <div class="circle-outer"></div>
                <div class="circle-inner"></div>
                <div class="energy-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
            </div>

            <div class="left-content">
                <h2>Smart Appliance</h2>
                <h2 class="highlight">Energy & Outlet Monitoring</h2>
                <p>Track appliance wattage, calculate total outlet load, and prevent electrical overload with real-time safety insights.</p>
            </div>
        </div>

        <div class="login-right">

            <a href="/home" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </a>

			 <div class="mobile-logo">
				<svg class="logo-icon-mobile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
					<path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
					<path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
					<path d="M16 20h2a2 2 0 0 0 2-2v-2"></path>
					<line x1="4" y1="12" x2="20" y2="12"></line>
				</svg>
        		<span>SafeScan</span>
   			 </div>
			
			<div class="mobile-divider"></div>
			
           <div class="form-wrapper">

			<h1>Welcome!</h1>
			<p class="subtitle">Enter your credentials to access your scanning dashboard.</p>

                <?php if (isset($error)): ?>
                    <div style="background: #fff0f0; color: #e74c3c; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; border: 1px solid #ffcccc;">
                        <i class="fa-solid fa-circle-exclamation"></i> 
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <form action="/login" method="POST" id="login-form">
                    
                    <label>Email Address</label>
                    <div class="input-group">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" name="email" required>
                    </div>

                    <label>Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" required>
                    </div>
                    
                    <div class="forgot-link">
                       <a href="#" id="forgot-password-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">Log In</button>

                    <div class="signup-links">
                        <p>Have no account? <a href="/signup">Create <span class="role-admin">ACCOUNT</span>.</a></p>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <div id="forgotModal" class="forgot-modal">
    <div class="forgot-modal-content">
        
        <button id="close-modal-btn" class="modal-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <h3>Forgot Password</h3>

        <input type="email" id="fp-email" placeholder="Enter your email">
            <button type="button" id="send-otp-btn" class="btn-send-otp">Send OTP</button>

        <input type="text" id="fp-otp" placeholder="Enter OTP">
        <input type="password" id="fp-password" placeholder="New Password">

         <button type="button" id="reset-pass-btn" class="btn-reset-pass">Reset Password</button>

    </div>
</div>

<div id="responseModal" class="forgot-modal">
    <div class="forgot-modal-content response-box">
        <button class="modal-close-btn" onclick="closeResponseModal()">&times;</button>

        <h3 id="responseTitle">Success</h3>
        <p id="responseMessage">Message here</p>

        <button class="btn-reset-pass" onclick="closeResponseModal()">OK</button>
    </div>
</div>

    <script src="/assets/js/loginvalidation.js"></script>    
</body>
</html>