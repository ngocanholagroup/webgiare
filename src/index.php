<?php
// src/index.php

// 1. AUTOLOAD
spl_autoload_register(function ($className) {
    $fileController = __DIR__ . '/controllers/' . $className . '.php';
    if (file_exists($fileController)) {
        require_once $fileController;
        return;
    }

    $fileModel = __DIR__ . '/models/' . $className . '.php';
    if (file_exists($fileModel)) {
        require_once $fileModel;
        return;
    }
    
    if ($className === 'Router') {
        require_once __DIR__ . '/Router.php';
    }
});

// 2. HELPER VIEW
function view($viewPath, $data = []) {
    $path = str_replace('.', '/', $viewPath);
    $fullPath = __DIR__ . '/views/' . $path . '.php';
    if (file_exists($fullPath)) {
        extract($data);
        require $fullPath;
    } else {
        echo "View not found: $fullPath";
    }
}

// 3. KHỞI TẠO ROUTER
$router = new Router();

// --- ĐỊNH NGHĨA ROUTE ---

$router->get('/', [HomeController::class, 'index']);
$router->get('/gioi-thieu', [HomeController::class, 'about']);
$router->get('/dich-vu', [HomeController::class, 'services']);

// Route Tin tức
$router->get('/tin-tuc', [BlogController::class, 'index']);
$router->get('/tin-tuc/{slug}', [BlogController::class, 'detail']);

// ✅ Route Template (Logic Database nằm ở đây)
$router->get('/kho-giao-dien', [TemplateController::class, 'index']);
$router->get('/kho-giao-dien/{slug}', [TemplateController::class, 'detail']);

// Route Lien hệ
$router->get('/lien-he', function() {
    view('client.contact', ['title' => 'Liên hệ']);
});

// Route Admin
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/login', function() {
    view('admin.login', ['title' => 'Đăng nhập Admin']);
});

// --- CHẠY ---
$router->resolve();