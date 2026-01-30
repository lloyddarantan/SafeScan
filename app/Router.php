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
    // app/Router.php

    public function resolve()
        {
            $method = $_SERVER['REQUEST_METHOD'];

            // 1. Get the URL, default to empty string if missing
            $url = $_GET['url'] ?? '';
            
            // 2. Trim slashes
            $path = trim($url, '/');

            // 3. IF path is empty (root domain), force it to 'home'
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

    // Normalize path (remove slashes)
    protected function normalize($path)
    {
        return trim($path, '/');
    }
}
