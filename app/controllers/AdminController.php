<?php
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
            header("Location: /login");
            exit();
        }

        $this->adminModel = new Admin();
    }

    public function index() {
        $stats = $this->adminModel->getStats();
        $users = $this->adminModel->getAllUsers();
        $appliances = $this->adminModel->getAllAppliances();
        
        $adminProfile = $this->adminModel->getAdminProfile($_SESSION['user_id']);
        
        $data = [
            'stats' => $stats,
            'users' => $users,
            'recentUsers' => array_slice($users, 0, 3),
            'appliances' => $appliances,
            'admin' => $adminProfile
        ];

        require __DIR__ . '/../views/pages/admindashboard.php';
    }

    public function updateRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $newRole = $_POST['role'];

            if ($userId == $_SESSION['user_id']) {
                header("Location: /admin");
                exit();
            }

            $this->adminModel->updateUserRole($userId, $newRole);
            
            header("Location: /admin");
            exit();
        }
    }

    public function addAppliance() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'brand' => $_POST['brand'],
                'group' => $_POST['group'],
                'type'  => $_POST['type'],
                'watt'  => $_POST['watt'],
                'cons'  => $_POST['cons']
            ];

            $this->adminModel->createAppliance($data);
            
            header("Location: /admin");
            exit();
        }
    }

    public function deleteAppliance() {
        if (isset($_GET['id'])) {
            $this->adminModel->deleteAppliance($_GET['id']);
            header("Location: /admin");
            exit();
        }
    }
	
	public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_SESSION['user_id'];

            $data = [
                'first_name' => htmlspecialchars(trim($_POST['first_name'])),
                'last_name'  => htmlspecialchars(trim($_POST['last_name'])),
                'email'      => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'phone'      => htmlspecialchars(trim($_POST['phone']))
            ];

            $this->adminModel->updateAdminProfile($id, $data);
            
            header("Location: /admin");
            exit();
        }
    }
}
?>