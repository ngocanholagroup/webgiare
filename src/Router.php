<?php

class Router {
    private $routes = [];
    private $apiVersion = null;  // For tracking API version

    // Đăng ký route GET
    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    // Đăng ký route POST (xử lý form)
    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    // Register API endpoint with versioning support
    // Usage: $router->api('v1', '/users', 'UserController@index');
    public function api($version, $path, $callback) {
        // Convert /users to /api/v1/users
        $apiPath = '/api/' . $version . $path;
        return $this->addRoute('GET', $apiPath, $callback);
    }

    public function apiPost($version, $path, $callback) {
        $apiPath = '/api/' . $version . $path;
        return $this->addRoute('POST', $apiPath, $callback);
    }

    private function addRoute($method, $path, $callback) {
        // Chuyển đổi path dạng /product/{slug} thành Regex
        // Ví dụ: /product/{slug} => #^/product/([a-zA-Z0-9-_]+)$#
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9-_]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback,
            'path' => $path
        ];
        
        return $this;
    }

    public function resolve() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);

                // Extract API version if present
                if (preg_match('#/api/(v\d+)/#', $uri, $versionMatch)) {
                    $this->apiVersion = $versionMatch[1];
                }

                $action = $route['callback'];

                // Support string format: 'ControllerName@methodName'
                if (is_string($action) && strpos($action, '@') !== false) {
                    [$controllerName, $methodName] = explode('@', $action);
                    $controller = new $controllerName();
                    return call_user_func_array([$controller, $methodName], $matches);
                }

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
        
        // Check if this is an API request and return JSON error
        if (strpos($uri, '/api/') === 0) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'API endpoint not found',
                'path' => $uri,
                'method' => $method
            ]);
        } else {
            http_response_code(404);
            if (file_exists(__DIR__ . '/views/client/404.php')) {
                require __DIR__ . '/views/client/404.php';
            } else {
                echo "404 Not Found";
            }
        }
    }

    /**
     * Get current API version (if route is API)
     */
    public function getApiVersion() {
        return $this->apiVersion;
    }

    /**
     * Check if current route is API
     */
    public function isApiRoute() {
        return $this->apiVersion !== null;
    }

    /**
     * Helper to register all v1 API routes
     */
    public function registerV1API() {
        // These are example routes - add your actual API endpoints
        // $this->api('v1', '/posts', 'PostController@index');
        // $this->api('v1', '/posts/{id}', 'PostController@show');
        // $this->apiPost('v1', '/posts', 'PostController@create');
    }

    /**
     * Helper to register all v2 API routes
     */
    public function registerV2API() {
        // Future API version routes
    }
}
?>
