<?php
// app/Router.php

class Router
{
    protected $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$this->normalize($path)] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$this->normalize($path)] = $callback;
    }

    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];

        // Get the real URL path (VERY IMPORTANT)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove "/public" or subfolder automatically (HelioHost safe)
        $base = dirname($_SERVER['SCRIPT_NAME']);
        if ($base !== '/' && strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }

        $path = trim($uri, '/');

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

    protected function normalize($path) {
        return trim($path, '/');
    }
}
