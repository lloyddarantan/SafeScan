<?php
class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
            header("Location: /admin");
            exit();
        }

        $page = 'home';
        require_once __DIR__ . '/../views/pages/home.php';
    }
}