<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    const SUPER_ADMIN_EMAIL = 'superadmin@safescan.com';

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
			
			$existingUser = $this->userModel->findByEmail($_POST['email']);
            if ($existingUser) {
                $error = "This email is already registered.";
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
                'password'   => $_POST['password'],
				'role'       => 'User'
            ];

            $this->userModel->create($userData);
            
            header("Location: /login"); 
            exit;
        }
        require __DIR__ . '/../views/auth/signup.php';
    }

    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $this->userModel->findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                
                session_regenerate_id(true);
				
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['email']   = $user['email'];
                $_SESSION['name']    = $user['first_name'];
				
                if ($user['email'] === self::SUPER_ADMIN_EMAIL || (isset($user['role']) && $user['role'] === 'Admin')) {
                    
                    $_SESSION['role'] = 'Admin';
                    header("Location: /admin");
                    exit;

                } else {
                    
                    $_SESSION['role'] = 'User';
                    header("Location: /home");
                    exit;
                }
            }

            $error = "Invalid email or password.";
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        
        header("Location: /login");
        exit;
    }

// otp
    public function sendOTP() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $user = $this->userModel->findByEmail($email);

            if (!$user) {
                echo json_encode(['status' => 'error', 'message' => 'Email not found']);
                return;
            }

            $phone = '63' . ltrim($user['phone'], '0');
            $otp = rand(100000, 999999);

            $this->userModel->saveOTP($email, $otp);

            // 🔥 PhilSMS API
            $apiKey = "2083|gg8c4xZq5rM5tdpDjGLzPBchiRiAb0ka5gfQ3RQb49c996f1";
            $message = "Your SafeScan OTP is: $otp";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                "recipient" => $phone,
                "sender_id" => "SafeScan",
                "type" => "plain",
                "message" => $message
            ]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $apiKey"
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            echo json_encode(['status' => 'success']);
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $otp = $_POST['otp'];
            $newPassword = $_POST['password'];

            $valid = $this->userModel->verifyOTP($email, $otp);

            if ($valid) {
                $this->userModel->updatePassword($email, $newPassword);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid or expired OTP']);
            }
        }
    }
}
?>