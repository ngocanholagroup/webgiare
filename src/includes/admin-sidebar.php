<?php
// views/admin/includes/sidebar.php

// 1. Xử lý Logic lấy thông tin Admin từ Session
$adminName = $_SESSION['admin_name'] ?? 'Administrator';
$adminRole = 'Super Admin'; // Mặc định vì hệ thống chỉ có 1 loại admin
$adminAvatar = $_SESSION['admin_avatar'] ?? '';

// Nếu chưa có avatar thì tạo avatar chữ cái
if (empty($adminAvatar)) {
    $adminAvatar = "https://ui-avatars.com/api/?name=" . urlencode($adminName) . "&background=f97316&color=fff";
}

// 2. Xử lý Active Menu
$uri = $_SERVER['REQUEST_URI'];

if (!function_exists('isActive')) {
    function isActive($keyword, $uri) {
        // Kiểm tra xem đường dẫn hiện tại có chứa keyword không
        return strpos($uri, $keyword) !== false 
            ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/30' 
            : 'text-slate-400 hover:bg-slate-800 hover:text-white';
    }
}
?>

<div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-40 hidden backdrop-blur-sm transition-opacity lg:hidden"></div>

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-black text-white transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col border-r border-slate-800 shadow-2xl">
    
    <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md">
        <?php include 'logo.php';?>
    </div>

    <div class="flex-1 overflow-y-auto no-scrollbar py-6 px-4 space-y-1">

        <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Nội dung</p>

        <a href="/admin" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/template', $uri) ?>">
            <i data-lucide="layout-template" class="w-5 h-5"></i>
            Templates
        </a>
        <a href="/admin/blog" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/blog', $uri) ?>">
            <i data-lucide="newspaper" class="w-5 h-5"></i>
            Blog
        </a>

        <a href="/admin/contact" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/contact', $uri) ?>">
            <div class="relative">
                <i data-lucide="inbox" class="w-5 h-5"></i>
                <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-slate-900"></span>
            </div>
            Liên hệ
        </a>

        <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Cấu hình</p>

        <a href="/admin/page" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/page', $uri) ?>">
            <i data-lucide="file" class="w-5 h-5"></i>
            Trang tĩnh
        </a>

        <a href="/admin/account" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/account', $uri) ?>">
            <i data-lucide="users" class="w-5 h-5"></i>
            Tài khoản Admin
        </a>
        <a href="/admin/setting" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/setting', $uri) ?>">
            <i data-lucide="settings" class="w-5 h-5"></i>
            Cài đặt chung
        </a>
    </div>

    <div class="p-4 border-t border-slate-800 bg-slate-900/50">
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-800 transition-colors cursor-pointer group">
            
            <div class="relative shrink-0">
                <img src="<?= $adminAvatar ?>" alt="<?= htmlspecialchars($adminName) ?>" class="w-10 h-10 rounded-full border-2 border-slate-700 object-cover group-hover:border-orange-500 transition-colors">
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-slate-900 rounded-full"></span>
            </div>
            
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate group-hover:text-orange-400 transition-colors">
                    <?= htmlspecialchars($adminName) ?>
                </p>
                <p class="text-xs text-slate-400 truncate"><?= $adminRole ?></p>
            </div>
            
            <a href="/admin/logout" class="text-slate-400 hover:text-red-500 hover:bg-red-500/10 p-2 rounded-lg transition-all" title="Đăng xuất">
                <i data-lucide="log-out" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</aside>