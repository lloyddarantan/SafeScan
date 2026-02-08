<?php

class ChatController {
    public function index() {
        $page = 'chat';
        require_once __DIR__ . '/../views/pages/chat.php';
    }
}
