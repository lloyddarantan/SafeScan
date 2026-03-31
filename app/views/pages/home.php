<?php 
    require __DIR__ . '/../others/navigation.php';     
?>


<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- hero -->
    <section class="hero-section">
        <div class="hero-content">
			<h1> <span class = "highlight"> Monitor </span> 
					<span class = "highlight-2"> Appliance <br> Energy </span>
			</h1>
            <p>Track socket amperage, detect connected appliances, and prevent overloads with visual indicators.</p>
            <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                <a href="/outletmanagement" class="btn-upload">Try it Now</a>
            <?php else: ?>
                <a href="#" class="btn-upload login-trigger">Try it Now</a>
            <?php endif; ?>
        </div>
        
        <div class="hero-image-container">
            <img src="/assets/img/hero_page.png" alt="Appliances" class="hero-img">
        </div>
    </section>
<!-- iinfo sec -->
    <div class="bottom-section-wrapper">
        <section class="ai-section">
            <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                <a href="/outletmanagement" class="ai-image-link">
                    <div class="ai-image-card">
                        <img src="/assets/img/api-appliances.jpg" alt="AI Detection" class="ai-img">
                        <div class="image-overlay">
                            <span class="hover-btn">Go to Outlet Management <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            <?php else: ?>
                <a href="#" class="ai-image-link login-trigger">
                    <div class="ai-image-card">
                        <img src="/assets/img/api-appliances.jpg" alt="AI Detection" class="ai-img">
                        <div class="image-overlay">
                            <span class="hover-btn">Go to Outlet Management <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>

            <div class="ai-content">
                <h2>
                    Understand your appliance energy 
                    <br> usage with <span class="highlight">Smart detection</span>
                </h2>
                <p>
                    Track the total amperage connected to each socket and prevent electrical overloads before they happen. Visual indicators help you manage appliance connections safely and efficiently.
                </p>
            </div>
        </section>
    </div>
<!-- new feature -->
    <section class="how-it-works">
        <h2 class="how-title">How it <span class="highlight">Works</span></h2>
        <p class="how-subtitle">Monitor and manage your appliances in three simple steps.</p>
            <div class="how-container">
                <div class="how-step">
                    <div class="step-circle">1</div>
                    <h3>View Appliances</h3>
                    <p>See common appliances found in your home and understand their typical energy usage.</p>
                </div>
                <div class="how-step">
                    <div class="step-circle">2</div>
                    <h3>Save Appliances</h3>
                    <p>Save appliances to your list to monitor their power consumption and track usage.</p>
                </div>
                <div class="how-step">
                    <div class="step-circle">3</div>
                    <h3>Outlet Management</h3>
                    <p>Monitor total amperage connected to outlets and prevent electrical overloads.</p>
                </div>
            </div>
    </section>

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
                        <a href="/appliances#living-room" class="btn-view">View</a>
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
                <p>You need to sign in to view your profile, manage your outlets or use the chat.</p>
                
                <div class="modal-actions">
                    <a href="/login" class="btn-login">Log In</a>
                    <a href="/signup" class="btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
    <?php require __DIR__ . '/../others/footer.php'; ?>