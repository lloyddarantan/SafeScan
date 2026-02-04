<?php

class HomeController {
    public function index() {
        $page = 'home';
        require_once __DIR__ . '/../views/pages/home.php';
    }
}
