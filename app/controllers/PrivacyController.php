<?php

class PrivacyController {
    public function index() {
        $page = 'privacy';
        require_once __DIR__ . '/../views/others/privacypolicy.php';
    }
}
