<?php $page = 'home'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan - Home</title>
    <link rel="stylesheet" href="../view/assets/css/index.css">
</head>
<body>

    <?php include 'others/navigation.php'; ?>

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
            <img src="../view/assets/img/appliances.png" alt="Appliances" class="hero-img">
        </div>
    </section>

    <div class="bottom-section-wrapper">
        <section class="ai-section">
            <div class="ai-image-card">
                <img src="../view/assets/img/api-appliances.png" alt="AI Detection" class="ai-img">
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

    <?php include 'others/footer.php'; ?>

</body>
</html>