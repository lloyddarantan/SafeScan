<?php 
    require __DIR__ . '/../others/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan</title>
    <link rel="stylesheet" href="/assets/css/about.css">
</head>
<body>
   <div class="container">
        
        <section class="project-section">
            <h1 class="project-title">About Safe Scan</h1>
            <div class="project-subtitle">Monitor. Detect. Protect.</div>
            <p class="project-desc">
                Safe Scan is an advanced monitoring solution designed to give you complete visibility 
                over your electrical appliances. We help you track usage, detect irregularities, and prevent 
                electrical hazards before they happen. By combining real-time scanning with a user-friendly 
                dashboard, we bring industrial-grade safety right to your screen.
            </p>
        </section>

        <div class="team-header">
            <h2>Meet the Developers</h2>
            <p>The team bridging the gap between raw data and your safety.</p>
        </div>

        <section class="team-grid">
            
            <div class="member-card">
                <div class="photo-container">
                    <img src="../assets/img/lloyd.png" alt="Lloyd Darantan">
                </div>
                <div class="role-title">The Data Architect (Back-End)</div>
                <h3>Lloyd Darantan</h3>
                <p class="bio">
                    The engine behind the safety. Lloyd builds the infrastructure that processes appliance 
                    telemetry and manages our extensive database of electrical standards. They ensure that 
                    data flows securely from the hardware to the database without missing a beat.
                </p>
            </div>

            <div class="member-card">
                <div class="photo-container">
                     <img src="../assets/img/mika.jpg" alt="Mikealla Rentuaya">
                </div>
                <div class="role-title">The Interface Designer (Front-End)</div>
                <h3>Mikealla Rentuaya</h3>
                <p class="bio">
                    The visualization of your safety. Mika takes complex electrical readings and transforms 
                    them into a clean, easy-to-read dashboard. They focus on the user experience, ensuring 
                    that alerts are clear and monitoring your appliances is intuitive.
                </p>
            </div>

        </section>

        <div class="mission-statement">
            <p>
                "We built Safe Scan because we believe you shouldn't need an engineering degree 
                to know if your home electronics are safe."
            </p>
        </div>

    </div>

<?php require __DIR__ . '/../others/footer.php'; ?>
</body>
</html>