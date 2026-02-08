<?php
// public/index.php

session_start();

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/AboutController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AppliancesController.php';
require_once __DIR__ . '/../app/controllers/ChatController.php';
require_once __DIR__ . '/../app/controllers/UploadController.php';

$router = new Router();

// Routes
$router->get('home', function() {
    (new HomeController())->index();
});

$router->get('profile', function() {
    (new ProfileController())->index();
});

$router->get('about', function() {
    (new AboutController())->index();
});

$router->get('appliances', function() {
    (new AppliancesController())->index();
});

$router->get('chat', function() {
    (new ChatController())->index();
});

$router->get('upload', function() {
    (new UploadController())->index();
});

// Auth routes
$router->get('login', function() {
    (new AuthController())->login();
});

$router->post('login', function() {
    (new AuthController())->login();
});

$router->get('signup', function() {
    (new AuthController())->register();
});

$router->post('signup', function() {
    (new AuthController())->register();
});

$router->post('profile/update', function() {
    (new ProfileController())->update();
});

$router->post('profile/delete', function() {
    (new ProfileController())->delete();
});

$router->get('logout', function() {
    (new AuthController())->logout();
});


// Handle the request
$router->resolve();
