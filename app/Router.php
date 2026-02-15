<?php

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

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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

    protected function normalize($path) {
        return trim($path, '/');
    }
}
