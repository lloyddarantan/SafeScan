<?php 
    $page = 'home';  
    require __DIR__ . '/../others/navigation.php';     
?>


<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/index.css">

    <section class="hero-section">
        <div class="hero-content">
            <h1>
                Track appliance <br> 
                energy in <span class="highlight">real time.</span>
            </h1>
            <p>Upload your appliance now</p>
            <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                <a href="/upload" class="btn-upload">Upload</a>
            <?php else: ?>
                <a href="#" class="btn-upload login-trigger">Upload</a>
            <?php endif; ?>
        </div>
        
        <div class="hero-image-container">
            <img src="/assets/img/appliances.png" alt="Appliances" class="hero-img">
        </div>
    </section>

    <div class="bottom-section-wrapper">
        <section class="ai-section">
            <div class="ai-image-card">
                <img src="/assets/img/api-appliances.png" alt="AI Detection" class="ai-img">
            </div>

            <div class="ai-content">
                <h2>
                    Understand your appliance <br>
                    energy usage with <span class="highlight">AI detection</span>
                </h2>
                <p>
                    Gain better insight into your household appliances by using AI-powered image scanning to identify appliance names and their power consumption. Avoid guesswork and confusion when estimating electricity usage.
                </p>
            </div>
        </section>
    </div>

<!-- login and signup modal -->

    <div id="authModal" class="modal-overlay">
        <div class="modal-box">
            <span class="close-modal">&times;</span>
            
            <div class="modal-content">
                <i class="fa-solid fa-lock" style="font-size: 3rem; color: orange; margin-bottom: 15px;"></i>
                <h3>Login Required</h3>
                <p>You need to sign in to view your profile, use the chat, or upload appliances.</p>
                
                <div class="modal-actions">
                    <a href="/login" class="btn-login">Log In</a>
                    <a href="/signup" class="btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/../others/footer.php'; ?>