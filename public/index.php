<?php
// public/index.php

session_start();

// Load core router
require_once __DIR__ . '/../app/Router.php';

// Load controllers
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

// Create router instance
$router = new Router();

// Define routes
$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

$router->get('home', function() {
    $controller = new HomeController();
    $controller->index();
});

$router->get('profile', function() {
    $controller = new ProfileController();
    $controller->index();
});

// Auth routes
$router->get('login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->post('login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->get('signup', function() {
    $controller = new AuthController();
    $controller->register();
});

$router->post('signup', function() {
    $controller = new AuthController();
    $controller->register();
});

$router->resolve();
