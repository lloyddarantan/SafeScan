<?php

class HomeController {
    public function index() {
        $page = 'home';
        require '../app/views/pages/home.php';
    }
}
