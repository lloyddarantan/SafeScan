<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {

    public function index() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        $page = 'profile';
        require '../app/views/profile.php';
    }
}
