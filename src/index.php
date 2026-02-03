<?php
// src/index.php

// 1. TỰ ĐỘNG NẠP FILE (AUTOLOAD)
// Giúp không phải require_once từng file controller/model
spl_autoload_register(function ($className) {
    // Thử tìm trong folder controllers
    $fileController = __DIR__ . '/controllers/' . $className . '.php';
    if (file_exists($fileController)) {
        require_once $fileController;
        return;
    }

    // Thử tìm trong folder models
    $fileModel = __DIR__ . '/models/' . $className . '.php';
    if (file_exists($fileModel)) {
        require_once $fileModel;
        return;
    }
    
    // Thử tìm Router
    if ($className === 'Router') {
        require_once __DIR__ . '/Router.php';
    }
});

// 2. HELPER VIEW (Giữ nguyên của bạn)
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

// --- ĐỊNH NGHĨA ROUTE KIỂU MVC ---

// Dùng mảng [TênClass, TênHàm]
$router->get('/', [HomeController::class, 'index']);
$router->get('/gioi-thieu', [HomeController::class, 'about']);
$router->get('/dich-vu', [HomeController::class, 'services']);
$router->get('/kho-giao-dien', [HomeController::class, 'template']);

// Route Tin tức
$router->get('/tin-tuc', [BlogController::class, 'index']);
$router->get('/tin-tuc/{slug}', [BlogController::class, 'detail']);

// Route template
$router->get('/kho-giao-dien', [HomeController::class, 'template']);
$router->get('/kho-giao-dien/{slug}', [TemplateController::class, 'detail']);

// Route Lien hệ (form)
$router->get('/lien-he', function() {
    view('client.contact', ['title' => 'Liên hệ']);
});

// Route Admin (Ví dụ)
$router->get('/admin', [AdminController::class, 'dashboard']);

// Router login admin (form)
$router->get('/admin/login', function() {
    view('admin.login', ['title' => 'Đăng nhập Admin']);
});

// --- CHẠY ---
$router->resolve();