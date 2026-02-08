<?php

class UploadController {
    public function index() {
        $page = 'upload';
        require_once __DIR__ . '/../views/pages/upload.php';
    }
}
