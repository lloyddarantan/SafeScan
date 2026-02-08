<?php

class AboutController {
    public function index() {
        $page = 'about';
        require_once __DIR__ . '/../views/pages/about.php';
    }
}
