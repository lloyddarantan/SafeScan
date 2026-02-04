<?php
// app/Router.php

class Router
{
    protected $routes = [];

    // Register GET route
    public function get($path, $callback) {
        $this->routes['GET'][$this->normalize($path)] = $callback;
    }

    // Register POST route
    public function post($path, $callback) {
        $this->routes['POST'][$this->normalize($path)] = $callback;
    }

    // Resolve the current request (HelioHost-safe)
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];

        // Get the real path from the browser
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove leading and trailing slashes only
        $path = trim($uri, '/');

        // Default route
        if ($path === '') {
            $path = 'home';
        }

        $callback = $this->routes[$method][$path] ?? null;

        if ($callback) {
            call_user_func($callback);
        } else {
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
        }
    }

    // Normalize registered paths
    protected function normalize($path) {
        return trim($path, '/');
    }
}
