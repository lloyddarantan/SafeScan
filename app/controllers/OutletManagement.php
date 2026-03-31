<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Appliance.php';

class OutletManagementController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $applianceModel = new Appliance();
        $userModel = new User();
        
        $user = $userModel->getById($_SESSION['user_id']);
        $savedAppliances = $userModel->getSavedAppliances($_SESSION['user_id']);

        foreach ($savedAppliances as $key => $row) {

            $webBasePath = '/assets/img/appliances/';
            $serverBasePath = __DIR__ . '/../../public/assets/img/appliances/';

            $imageFound = false;

            if (!empty($row['image'])) {
                $dbImagePath = $serverBasePath . $row['image'];

                if (file_exists($dbImagePath)) {
                    $savedAppliances[$key]['image'] =
                        $webBasePath . $row['image'];
                    $imageFound = true;
                }
            }

            if (!$imageFound) {
                $slugImage = $this->getApplianceImage($row['brand'], $row['type']);
                $slugServerPath = __DIR__ . '/../../public' . $slugImage;

                if (file_exists($slugServerPath)) {
                    $savedAppliances[$key]['image'] = $slugImage;
                    $imageFound = true;
                }
            }

            if (!$imageFound) {
                $savedAppliances[$key]['image'] =
                    $webBasePath . 'default.png';
            }

            $savedAppliances[$key]['amperes'] =
                $applianceModel->calculateAmperes($row['wattage'] ?? 0);
        }

        require __DIR__ . '/../views/pages/outletmanagement.php';
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