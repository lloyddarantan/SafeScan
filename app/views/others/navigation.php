<?php
// Set the base URL dynamically depending on your project folder
$baseUrl = '/SafeScan/public'; // <-- replace SafeScan/public with your actual project folder in XAMPP
?>

<link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/navigation.css">
<link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/footer.css">
<link rel="stylesheet" href="<?= $baseUrl ?>https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="<?= $baseUrl ?>https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500&display=swap" rel="stylesheet">

<nav class="navbar">
    <div class="logo-container">
        <span>Safe <span class="text-highlight">Scan</span></span>
    </div>

    <ul class="nav-links">
        <li>
            <a href="<?= $baseUrl ?>?url=home" class="<?= ($page ?? '') == 'home' ? 'active' : '' ?>">Home</a>
        </li>
        <li>
            <a href="<?= $baseUrl ?>?url=about" class="<?= ($page ?? '') == 'about' ? 'active' : '' ?>">About</a>
        </li>
        <li>
            <a href="<?= $baseUrl ?>?url=works" class="<?= ($page ?? '') == 'works' ? 'active' : '' ?>">How it Works</a>
        </li>
        <li>
            <a href="<?= $baseUrl ?>?url=profile" class="<?= ($page ?? '') == 'profile' ? 'active' : '' ?>">Profile</a>
        </li>
    </ul>

    <a href="#" class="btn-chat">Chat</a>
</nav>
