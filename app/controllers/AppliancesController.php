<?php

class AppliancesController {
    public function index() {
        $page = 'appliances';
        require_once __DIR__ . '/../views/pages/appliances.php';
    }
}
