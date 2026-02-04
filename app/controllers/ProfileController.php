<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        require_once __DIR__ . '/../views/pages/profile.php';
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userModel = new User();

        $data = [
            'firstname' => $_POST['firstname'],
            'lastname'  => $_POST['lastname'],
            'email'     => $_POST['email'],
            'contact'   => $_POST['contact'],
            'street'    => $_POST['street']
        ];

        $userModel->updateProfile($_SESSION['user_id'], $data);

        header("Location: /profile");
        exit;
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userModel = new User();
        $userModel->deleteAccount($_SESSION['user_id']);

        session_destroy();

        header("Location: /login");
        exit;
    }
}
