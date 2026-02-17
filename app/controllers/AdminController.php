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
        $adminProfile = $this->adminModel->getAdminProfile($_SESSION['user_id']);
        $appliances = $this->adminModel->getAllAppliances();
            foreach ($appliances as $key => $app) {
                $webBasePath = '/assets/img/appliances/';
                $serverBasePath = __DIR__ . '/../../public/assets/img/appliances/';
                $imageFound = false;

                if (!empty($app['image'])) {
                    $dbImagePath = $serverBasePath . $app['image'];
                    if (file_exists($dbImagePath)) {
                        $appliances[$key]['image_path'] = $webBasePath . $app['image'];
                        $imageFound = true;
                    }
                }

                if (!$imageFound) {
                    $slugImage = $this->getApplianceImage($app['brand'], $app['type']);
                    $slugServerPath = __DIR__ . '/../../public' . $slugImage;

                    if (file_exists($slugServerPath)) {
                        $appliances[$key]['image_path'] = $slugImage;
                        $imageFound = true;
                    }
                }

                if (!$imageFound) {
                    $appliances[$key]['image_path'] = $webBasePath . 'default.png';
                }
            }

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
            
            $imageFilename = "default.png"; 

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    
			$uploadDir = __DIR__ . '/../../public/assets/img/appliances/';

			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0777, true);
			}

			$fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$fileName = time() . '_' . uniqid() . '.' . $fileExtension;
			$targetFilePath = $uploadDir . $fileName;

			if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
				$imageFilename = $fileName;
			} else {
				error_log("Failed to move file to: " . $targetFilePath);
			}
		}

            $data = [
                'brand'       => $_POST['brand'],
                'category'    => $_POST['category'],
                'group'       => $_POST['group'],
                'type'        => $_POST['type'],
                'watt'        => $_POST['watt'],
                'cons'        => $_POST['cons'],
                'description' => $_POST['description'],
                'image'       => $imageFilename
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

     private function getApplianceImage($brand, $type) {
        $slug = strtolower($brand . '_' . $type);
        $slug = preg_replace('/[^a-z0-9\.]+/', '_', $slug);
        $slug = trim($slug, '_');

        $serverPath = __DIR__ . '/../../public/assets/img/appliances/';
        $webPath    = '/assets/img/appliances/';

        foreach (['png', 'jpg', 'jpeg'] as $ext) {
            if (file_exists($serverPath . $slug . '.' . $ext)) {
                return $webPath . $slug . '.' . $ext;
            }
        }

        return $webPath . 'default.png';
    }
}
?>