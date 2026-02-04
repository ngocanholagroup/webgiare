<?php
// src/index.php

// 1. NẠP AUTOLOAD (QUAN TRỌNG: Phải nạp đầu tiên)
require_once __DIR__ . '/autoload.php';

// 2. SAU ĐÓ MỚI NẠP HELPER
require_once __DIR__ . '/helpers.php';

// 3. KHỞI TẠO ROUTER
$router = new Router();

// --- ĐỊNH NGHĨA ROUTE ---

// 1. Các trang tĩnh
$router->get('/', [PageController::class, 'home']);
// $router->get('/gioi-thieu', [PageController::class, 'about']);
// $router->get('/dich-vu', [PageController::class, 'services']);
// $router->get('/chinh-sach', [PageController::class, 'policy']);

$router->get('/gioi-thieu', function() {
    view('client.about', ['title' => 'Giới thiệu - HolaGroup']);
});

$router->get('/dich-vu', function() {
    view('client.services', ['title' => 'Dịch vụ - HolaGroup']);
});

$router->get('/chinh-sach', function() {
    view('client.policy', ['title' => 'Điều khoản sử dụng - HolaGroup']);
});

// ✅ Route Blog
$router->get('/tin-tuc', [BlogController::class, 'index']);
$router->get('/tin-tuc/{slug}', [BlogController::class, 'detail']);

// ✅ Route Template
$router->get('/kho-giao-dien', [TemplateController::class, 'index']);
$router->get('/kho-giao-dien/{slug}', [TemplateController::class, 'detail']);

// Route Lien hệ hiển thị form
$router->get('/lien-he', [ContactController::class, 'index']);
$router->post('/lien-he/submit', [ContactController::class, 'submit']);

// Route Admin
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/login', function() {
    view('admin.login', ['title' => 'Đăng nhập Admin']);
});

// --- CHẠY ---
$router->resolve();