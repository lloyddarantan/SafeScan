<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        // REMOVE session_start() here if it is already in index.php
        // (Calling it twice causes a warning)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // FIX 1: Use "new User()" (Singular, Capitalized) to match the class name
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['password'] !== $_POST['confirm_password']) {
                die("Passwords do not match");
            }

            $this->userModel->create($_POST);
            
            // FIX 2: Use Clean URL for redirect
            header("Location: /login"); 
            exit;
        }

        // FIX 3: Correct path to view (views/auth/ instead of views/login/)
        require __DIR__ . '/../views/auth/signup.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $users = $this->userModel->findByEmail($_POST['email']);

            if ($users && password_verify($_POST['password'], $users['password'])) {
                $_SESSION['user_id'] = $users['id'];
                
                // FIX 2: Use Clean URL for redirect
                header("Location: /profile");
                exit;
            }

            $error = "Invalid credentials";
        }

        // FIX 3: Correct path to view
        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        
        // FIX 2: Use Clean URL for redirect
        header("Location: /home");
        exit;
    }
}