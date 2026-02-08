<?php
require_once __DIR__ . '/../models/Appliance.php';

class AppliancesController {

    public function index() {
        $page = 'appliances';

        $applianceModel = new Appliance();
        $appliances = $applianceModel->getAllAppliances();

        $groupedAppliances = [];

        foreach ($appliances as $a) {
            $group = $a['group'];

            if (!isset($groupedAppliances[$group])) {
                $groupedAppliances[$group] = [];
            }

            $groupedAppliances[$group][] = $a;
        }

        ksort($groupedAppliances, SORT_STRING | SORT_FLAG_CASE);

        require_once __DIR__ . '/../views/pages/appliances.php';
    }

    public function toggleFavorite() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        require_once __DIR__ . '/../config/Database.php';

        $db = Database::getInstance()->getConnection();

        $user_id = $_SESSION['user_id'];
        $appliance_id = $_POST['appliance_id'];

        $check = $db->prepare("SELECT id FROM favorites WHERE user_id=? AND appliance_id=?");
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

}
