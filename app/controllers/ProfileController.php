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
        $savedAppliances = $userModel->getSavedAppliances($_SESSION['user_id']);

        require_once __DIR__ . '/../views/pages/profile.php';
    }

    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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
            'street'    => $_POST['street'],
            'city'      => $_POST['city'],
            'province'  => $_POST['province'],
            'country'   => $_POST['country']
        ];
        
        if (!empty($_POST['new_password'])) {
            $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        }

        $userModel->updateProfile($_SESSION['user_id'], $data);

        header("Location: /profile");
        exit;
    }

    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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