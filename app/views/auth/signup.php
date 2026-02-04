<?php 
     $page =  'signup';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeScan</title>
    <link rel="stylesheet" href="/assets/css/logincss/signup.css">
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
                <div class="energy-icon"><i class="fa-solid fa-bolt"></i></div>
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
                <h1>Create an account.</h1>
                <p class="subtitle">Set up your account to securely access scanning features.</p>

                <?php if (isset($error)): ?>
                    <div style="background: #fff0f0; color: #e74c3c; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; border: 1px solid #ffcccc;">
                        <i class="fa-solid fa-circle-exclamation"></i> 
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <form action="/signup" method="POST" id="signup-form">
    
                    <div id="step-1">
                        <label>First name</label>
                        <div class="input-group">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" name="first_name" placeholder="Enter your first name" value="<?= $_POST['first_name'] ?? '' ?>" required>
                        </div>

                        <label>Last name</label>
                        <div class="input-group">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" name="last_name" placeholder="Enter your last name" value="<?= $_POST['last_name'] ?? '' ?>" required>
                        </div>

                        <label>Phone number</label>
                        <div class="input-group">
                            <i class="fa-solid fa-mobile-screen input-icon"></i>
                            <input type="tel" name="phone" placeholder="09.........." value="<?= $_POST['phone'] ?? '' ?>" required>
                        </div>

                        <label style="margin-top: 15px; margin-bottom: 10px; font-size: 1rem;">Home Address</label>
                        <div class="address-grid">
                            <div class="address-field">
                                <label>Country</label>
                                <input type="text" name="country" value="<?= $_POST['country'] ?? '' ?>" required>
                            </div>
                            <div class="address-field">
                                <label>Province</label>
                                <input type="text" name="province" value="<?= $_POST['province'] ?? '' ?>" required>
                            </div>
                            <div class="address-field">
                                <label>City</label>
                                <input type="text" name="city" value="<?= $_POST['city'] ?? '' ?>" required>
                            </div>
                            <div class="address-field">
                                <label>Street</label>
                                <input type="text" name="street" value="<?= $_POST['street'] ?? '' ?>" required>
                            </div>
                        </div>

                        <button type="button" class="btn-login" onclick="showNextStep()">Next</button>
                    </div>

                    <div id="step-2" style="display: none;">
                        
                        <label>Email Address</label>
                        <div class="input-group">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" name="email" placeholder="name@email.com" value="<?= $_POST['email'] ?? '' ?>" required>
                        </div>

                        <label>Password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="password" placeholder="Create a password" id="passInput" required>
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('passInput')"></i>
                        </div>

                        <label>Confirm password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="confirm_password" placeholder="Confirm your password" id="confirmPassInput" required>
                            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('confirmPassInput')"></i>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn-back" onclick="showPreviousStep()">Back</button>
                            <button type="submit" class="btn-login">Register</button>
                        </div>
                    
                    </div> 
                    
                    <div class="signup-links" style="text-align: center; margin-top: 10px;">
                        <p style="color: #555;">
                            Have an account? 
                            <a href="/login" style="color: #F89b42; font-weight: 500;">Log in.</a>
                        </p>
                    </div>
                </form>
                <script src="/assets/js/loginvalidation.js"></script>
            </div>
        </div>

    </div>

</body>
</html>