<?php
// src/index.php
ob_start();
session_start();

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

// --- CLIENT: LIÊN HỆ ---
$router->get('/lien-he', [ContactController::class, 'index']);
$router->post('/lien-he/submit', [ContactController::class, 'submit']);

// Route Login
$router->get('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/login', [AuthController::class, 'handleLogin']);
$router->get('/admin/logout', [AuthController::class, 'logout']);
$router->get('/admin', function() {
    header('Location: /admin/template');
    exit;
});

// --- QUẢN LÝ GIAO DIỆN (TEMPLATES) ---
$router->get('/admin/template', [AdminTemplateController::class, 'index']);
$router->get('/admin/template/create', [AdminTemplateController::class, 'create']);
$router->post('/admin/template/store', [AdminTemplateController::class, 'store']);
$router->post('/admin/template/update/{id}', [AdminTemplateController::class, 'update']);
$router->get('/admin/template/edit/{id}', [AdminTemplateController::class, 'edit']);
$router->get('/admin/template/delete/{id}', [AdminTemplateController::class, 'delete']);
$router->post('/admin/template/upload-gallery/{id}', [AdminTemplateController::class, 'uploadGallery']);
$router->get('/admin/template/delete-image/{id}', [AdminTemplateController::class, 'deleteImage']);

// --- QUẢN LÝ DANH MỤC TEMPLATES ---
$router->get('/admin/category/create', [AdminTemplateCategoryController::class, 'create']);
$router->post('/admin/category/store', [AdminTemplateCategoryController::class, 'store']);
$router->get('/admin/category/edit/{id}', [AdminTemplateCategoryController::class, 'edit']);
$router->post('/admin/category/update/{id}', [AdminTemplateCategoryController::class, 'update']);
$router->get('/admin/category/delete/{id}', [AdminTemplateCategoryController::class, 'delete']);


// --- QUẢN LÝ BLOG ---
$router->get('/admin/blog', [AdminBlogController::class, 'index']); // List
$router->get('/admin/blog/create', [AdminBlogController::class, 'create']);
$router->post('/admin/blog/store', [AdminBlogController::class, 'store']);
$router->get('/admin/blog/edit/{id}', [AdminBlogController::class, 'edit']);
$router->post('/admin/blog/update/{id}', [AdminBlogController::class, 'update']);
$router->get('/admin/blog/delete/{id}', [AdminBlogController::class, 'delete']);
$router->get('/admin/blog-category/create', [AdminBlogCategoryController::class, 'create']);
$router->post('/admin/blog-category/store', [AdminBlogCategoryController::class, 'store']);
$router->get('/admin/blog-category/edit/{id}', [AdminBlogCategoryController::class, 'edit']);
$router->post('/admin/blog-category/update/{id}', [AdminBlogCategoryController::class, 'update']);
$router->get('/admin/blog-category/delete/{id}', [AdminBlogCategoryController::class, 'delete']);
$router->get('/admin/author/create', [AdminAuthorController::class, 'create']);
$router->post('/admin/author/store', [AdminAuthorController::class, 'store']);
$router->get('/admin/author/edit/{id}', [AdminAuthorController::class, 'edit']);
$router->post('/admin/author/update/{id}', [AdminAuthorController::class, 'update']);
$router->get('/admin/author/delete/{id}', [AdminAuthorController::class, 'delete']);
$router->post('/admin/upload-ckeditor', [AdminBlogController::class, 'uploadCKEditor']);

// --- QUẢN LÝ LIÊN HỆ (CONTACTS) ---
$router->get('/admin/contact', [AdminContactController::class, 'index']);
$router->get('/admin/contact/detail/{id}', [AdminContactController::class, 'detail']);
$router->post('/admin/contact/update/{id}', [AdminContactController::class, 'update']);
$router->get('/admin/contact/delete/{id}', [AdminContactController::class, 'delete']);
$router->post('/admin/service/store', [AdminContactController::class, 'storeService']);
$router->get('/admin/service/delete/{id}', [AdminContactController::class, 'deleteService']);
$router->get('/admin/setting', [AdminSettingController::class, 'index']);
$router->post('/admin/setting/save', [AdminSettingController::class, 'save']);

// --- QUẢN LÝ TÀI KHOẢN (ADMINS) ---
$router->get('/admin/account', [AdminAccountController::class, 'index']);
$router->get('/admin/account/create', [AdminAccountController::class, 'create']);
$router->post('/admin/account/store', [AdminAccountController::class, 'store']);
$router->get('/admin/account/edit/{id}', [AdminAccountController::class, 'edit']);
$router->post('/admin/account/update/{id}', [AdminAccountController::class, 'update']);
$router->get('/admin/account/delete/{id}', [AdminAccountController::class, 'delete']);

// --- QUẢN LÝ TRANG TĨNH (PAGES) ---
$router->get('/admin/page', [AdminPageController::class, 'index']);
$router->get('/admin/page/edit/{id}', [AdminPageController::class, 'edit']);
$router->post('/admin/page/update/{id}', [AdminPageController::class, 'update']);

// --- CHẠY ---
$router->resolve();