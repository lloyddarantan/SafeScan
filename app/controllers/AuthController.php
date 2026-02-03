<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['password'] !== $_POST['confirm_password']) {
                $error = "Passwords do not match";
                require __DIR__ . '/../views/auth/signup.php';
                return;
            }

            $userData = [
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'email'      => $_POST['email'],
                'phone'      => $_POST['phone'],
                'country'    => $_POST['country'],
                'province'   => $_POST['province'],
                'city'       => $_POST['city'],
                'street'     => $_POST['street'],
                'password'   => $_POST['password']
            ];

            $this->userModel->create($userData);
            
            header("Location: /login"); 
            exit;
        }

        require __DIR__ . '/../views/auth/signup.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $user = $this->userModel->findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['email'] = $user['email'];

                header("Location: /home"); 
                exit;
            }

            $error = "Invalid email or password.";
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        
        header("Location: /login");
        exit;
    }
}