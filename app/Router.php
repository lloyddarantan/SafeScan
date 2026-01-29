<?php
$url = $_GET['url'] ?? 'home';

switch ($url) {
    case 'home':
        $page = 'home';
        require __DIR__ . '/views/pages/home.php';
        break;
    case 'profile':
        $page = 'profile';
        require __DIR__ . '/views/pages/profile.php';
        break;
    default:
        echo "Page not found!";
        break;
}
