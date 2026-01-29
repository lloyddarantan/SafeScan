<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        session_start();
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['password'] !== $_POST['confirm_password']) {
                die("Passwords do not match");
            }

            $this->userModel->create($_POST);
            header("Location: index.php?page=login");
            exit;
        }

        require '../app/views/login/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $this->userModel->findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php?page=profile");
                exit;
            }

            $error = "Invalid credentials";
        }

        require '../app/views/login/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=home");
        exit;
    }
}
