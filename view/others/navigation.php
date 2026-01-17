<link rel="stylesheet" href="../view/assets/css/navigation.css">
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
            <a href="index.php" class="<?= ($page == 'home') ? 'active' : ''; ?>">Home</a>
        </li>
        <li>
            <a href="about.php" class="<?= ($page == 'about') ? 'active' : ''; ?>">About</a>
        </li>
        <li>
            <a href="works.php" class="<?= ($page == 'works') ? 'active' : ''; ?>">How it Works</a>
        </li>
        <li>
            <a href="account.php" class="<?= ($page == 'account') ? 'active' : ''; ?>">Account</a>
        </li>
    </ul>

    <a href="#" class="btn-chat">Chat</a>
</nav>