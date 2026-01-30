<?php
    $page = $_GET['url'] ?? 'home'; // highlight active link
?>

<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='orange' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 8V6a2 2 0 0 1 2-2h2'/%3E%3Cpath d='M4 16v2a2 2 0 0 0 2 2h2'/%3E%3Cpath d='M16 4h2a2 2 0 0 1 2 2v2'/%3E%3Cpath d='M16 20h2a2 2 0 0 0 2-2v-2'/%3E%3Cline x1='4' y1='12' x2='20' y2='12'/%3E%3C/svg%3E">

<link rel="stylesheet" href="../assets/css/navigation.css">
<link rel="stylesheet" href="../assets/css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500&display=swap" rel="stylesheet">

<nav class="navbar">
    <div class="logo-container">
        <svg class="logo-icon" viewBox="0 0 24 24">
            <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
            <path d="M16 20h2a2 2 0 0 0 2-2v-2"></path>
            <line x1="4" y1="12" x2="20" y2="12"></line>
        </svg>
        <span>Safe <span class="text-highlight">Scan</span></span>
    </div>

    <ul class="nav-links">
        <li>
            <a href="/home" class="<?= ($page ?? '') == 'home' ? 'active' : '' ?>">Home</a>
        </li>
        <li>
            <a href="/about" class="<?= ($page ?? '') == 'about' ? 'active' : '' ?>">About</a>
        </li>
        <li>
            <a href="/works" class="<?= ($page ?? '') == 'works' ? 'active' : '' ?>">How it Works</a>
        </li>
        <li>
            <a href="/profile" class="<?= ($page ?? '') == 'profile' ? 'active' : '' ?>">Profile</a>
        </li>
    </ul>

    <a href="#" class="btn-chat">Chat</a>
</nav>
