<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userModel = new User();
        
        $user = $userModel->getById($_SESSION['user_id']);

        require_once __DIR__ . '/../views/pages/profile.php';
    }
}