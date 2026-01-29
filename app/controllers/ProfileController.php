<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {

    public function index() {

        if (!isset($_SESSION['user_id'])) {
            // header("Location: ?url=home");
            // exit;

            $_SESSION['user_id'] = 1;
        }

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        require_once __DIR__ . '/../views/pages/profile.php';
    }
}
