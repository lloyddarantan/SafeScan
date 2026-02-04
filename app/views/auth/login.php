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
                <h2>Next Generation</h2>
                <h2 class="highlight">Electric Scanning Technology</h2>
                <p>Experience the fastest, most accurate electric scanning powered by advanced neural networks.</p>
            </div>
        </div>

        <div class="login-right">

            <a href="/home" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </a>

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
                        <a href="#">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">Log In</button>

                    <div class="signup-links">
                        <p>Have no account? <a href="/signup">Create <span class="role-admin">ACCOUNT</span>.</a></p>
                    </div>
                </form>
                <script src="/assets/js/loginvalidation.js"></script>
            </div>
        </div>

    </div>

</body>
</html>