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
}
