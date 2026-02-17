<?php
class HomeController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
            header("Location: /admin");
            exit();
        }

        $page = 'home';
        require_once __DIR__ . '/../views/pages/home.php';
    }
}
?>