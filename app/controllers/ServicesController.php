<?php
    class ServicesController {
        public function index() {
            $page = 'services';
            require_once __DIR__ . '/../views/others/services.php';
        }
    }
?>