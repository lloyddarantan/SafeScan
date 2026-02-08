<?php 
    // $page = 'home';  
    require __DIR__ . '/../others/navigation.php';     
?>


<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

	<section class="category-section">
        <h2 class="section-title">Know more about your appliances</h2>
        
        <div class="card-container">
            
            <div class="appliance-card">
                <div class="card-image">
                    <img src="/assets/img/kitchen.png" alt="Kitchen"> 
                </div>
                <div class="card-content">
                    <h3>Kitchen</h3>
                    <p>Appliances used for cooking, food preparation, and food storage. These usually consume high electricity because they produce heat or keep items cold.</p>
                    <a href="/appliances#kitchen" class="btn-view">View</a>
                </div>
            </div>

            <div class="appliance-card highlight">
                <div class="card-image">
                    <img src="/assets/img/living-room.png" alt="Living Room">
                </div>
                <div class="card-content">
                    <h3>Living Room</h3>
                    <p>Appliances used for comfort, entertainment, and daily activities where people usually gather. These are often used for long hours.</p>
                    <a href="/appliances#living" class="btn-view">View</a>
                </div>
            </div>

            <div class="appliance-card">
                <div class="card-image">
                    <img src="/assets/img/bedroom.png" alt="Bedroom">
                </div>
                <div class="card-content">
                    <h3>Bedroom</h3>
                    <p>Appliances used for rest, relaxation, and personal comfort. These are commonly used at night or for extended periods.</p>
                    <a href="/appliances#bedroom" class="btn-view">View</a>
                </div>
            </div>

        </div>
    </section>

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