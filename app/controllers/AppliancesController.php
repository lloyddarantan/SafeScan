<?php
require_once __DIR__ . '/../models/Appliance.php';
require_once __DIR__ . '/../config/Database.php';

class AppliancesController {

    public function index() {
        $page = 'appliances';

        $applianceModel = new Appliance();
        $appliances = $applianceModel->getAllAppliances();

        $db = Database::getInstance()->getConnection();

        // Get liked appliances for current user
        $likedItems = [];
        if (isset($_SESSION['user_id'])) {
            $stmt = $db->prepare("SELECT appliance_id FROM favorites WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $likedItems = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        // Attach image path & favorite status to each appliance
        foreach ($appliances as &$a) {
            $a['image'] = $this->getApplianceImage($a['brand'], $a['type']);
            $a['isLiked'] = in_array($a['appliance_id'], $likedItems);
        }
        unset($a);

        // Group appliances by "group" (Air Conditioner, Refrigerator, etc.)
        $groupedAppliances = [];
        foreach ($appliances as $a) {
            $group = $a['group']; // <-- Use `group` field

            if (!isset($groupedAppliances[$group])) {
                $groupedAppliances[$group] = [];
            }

            $groupedAppliances[$group][] = $a;
        }

        // Sort groups alphabetically
        ksort($groupedAppliances, SORT_STRING | SORT_FLAG_CASE);

        require_once __DIR__ . '/../views/pages/appliances.php';
    }

    public function toggleFavorite() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $db = Database::getInstance()->getConnection();
        $user_id = $_SESSION['user_id'];
        $appliance_id = $_POST['appliance_id'];

        $check = $db->prepare("SELECT appliance_id FROM favorites WHERE user_id=? AND appliance_id=?");
        $check->execute([$user_id, $appliance_id]);

        if ($check->fetch()) {
            $del = $db->prepare("DELETE FROM favorites WHERE user_id=? AND appliance_id=?");
            $del->execute([$user_id, $appliance_id]);
        } else {
            $ins = $db->prepare("INSERT INTO favorites (user_id, appliance_id) VALUES (?,?)");
            $ins->execute([$user_id, $appliance_id]);
        }

        header("Location: /appliances");
        exit;
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
