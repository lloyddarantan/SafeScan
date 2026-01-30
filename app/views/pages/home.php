<?php 
    $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $page = 'home';   
?>

<?php require __DIR__ . '/../others/navigation.php'; ?>

<link rel="stylesheet" href="/assets/css/index.css">

    <section class="hero-section">
        <div class="hero-content">
            <h1>
                Track appliance <br> 
                energy in <span class="highlight">real time.</span>
            </h1>
            <p>Upload your appliance now</p>
            <a href="#" class="btn-upload">Upload</a>
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

    <?php require __DIR__ . '/../others/footer.php'; ?>