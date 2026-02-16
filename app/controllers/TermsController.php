<?php
    class TermsController {
        public function index() {
            $page = 'terms';
            require_once __DIR__ . '/../views/others/terms.php';
        }
    }
?>