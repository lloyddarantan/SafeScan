<?php 
    $page = 'signup';      
?>

<link rel="stylesheet" href="/assets/css/logincss/universallogin.css">
<link rel="stylesheet" href="/assets/css/logincss/adminlogin.css">

<div class="login-container">

    <div class="login-left">
        <div class="brand-logo">
            <span>Safe Scan</span>
        </div>
    </div>

    <div class="login-right">
        <div class="form-wrapper">
            <h1>Make member account.</h1>
            <p class="subtitle">Set up your account to securely access scanning features.</p>

            <form action="/?url=register" method="POST">

                <!-- Step 1 -->
                <div id="step-1">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Enter first name">

                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter last name">

                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter Address">

                    <label>Phone number</label>
                    <input type="tel" name="phone" placeholder="09..........">

                    <button type="button" onclick="showNextStep()">Next</button>
                </div>

                <!-- Step 2 -->
                <div id="step-2" style="display:none;">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="name@email.com">

                    <label>Password</label>
                    <input type="password" name="password" id="passInputMem">

                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirmPassInputMem">

                    <button type="submit">Register</button>
                </div>

                <div class="signup-links">
                    <p>Have an account? <a href="/?url=login">Log in.</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/assets/js/loginvalidation.js"></script>
