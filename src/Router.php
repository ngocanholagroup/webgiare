<?php

class Router {
    private $routes = [];

    // Đăng ký route GET
    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    // Đăng ký route POST (xử lý form)
    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    private function addRoute($method, $path, $callback) {
        // Chuyển đổi path dạng /product/{slug} thành Regex
        // Ví dụ: /product/{slug} => #^/product/([a-zA-Z0-9-_]+)$#
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9-_]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    public function resolve() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);

                $action = $route['callback'];

                // Nếu callback là dạng array [Controller, Method]
                if (is_array($action)) {
                    $controllerName = $action[0];
                    $methodName = $action[1];
                    
                    // Khởi tạo Controller: $controller = new HomeController();
                    $controller = new $controllerName();
                    
                    // Gọi hàm trong Controller: $controller->index($slug);
                    return call_user_func_array([$controller, $methodName], $matches);
                }

                // Vẫn giữ lại support cho function() cũ
                return call_user_func_array($action, $matches);
            }
        }
        
        // Handle 404...
        echo "404 Not Found";
    }
}