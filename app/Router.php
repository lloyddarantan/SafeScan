<?php
// app/Router.php

class Router
{
    protected $routes = [];

    // Register GET route
    public function get($path, $callback)
    {
        $this->routes['GET'][$this->normalize($path)] = $callback;
    }

    // Register POST route
    public function post($path, $callback)
    {
        $this->routes['POST'][$this->normalize($path)] = $callback;
    }

    // Resolve the current request
    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        // Use query string ?url= if present
        $path = trim($_GET['url'] ?? 'home', '/');

        $callback = $this->routes[$method][$path] ?? null;

        if ($callback) {
            call_user_func($callback);
        } else {
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
        }
    }

    // Normalize path (remove slashes)
    protected function normalize($path)
    {
        return trim($path, '/');
    }
}
