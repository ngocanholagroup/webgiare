<?php
// views/admin/includes/sidebar.php

// -------------------------------------------------------------------
// 1. LẤY THÔNG TIN TỪ SESSION (Tối ưu hiệu năng)
// -------------------------------------------------------------------
// Các biến này đã được AuthController lưu khi login
$adminName   = $_SESSION['admin_name'] ?? 'Administrator';
$adminAvatar = $_SESSION['admin_avatar'] ?? '';
$adminRole   = 'Super Admin'; 

// Fallback Avatar: Nếu session không có ảnh (hoặc rỗng), dùng tạo ảnh chữ cái
if (empty($adminAvatar)) {
    $adminAvatar = "https://ui-avatars.com/api/?name=" . urlencode($adminName) . "&background=f97316&color=fff";
}

// -------------------------------------------------------------------
// 2. LẤY SỐ LIÊN HỆ MỚI (Vẫn cần Query DB để Real-time)
// -------------------------------------------------------------------
$newContactCount = 0;
if (isset($conn)) { // Đảm bảo biến kết nối tồn tại
    try {
        $stmtCount = $conn->prepare("SELECT COUNT(*) FROM contacts WHERE status = 'new'");
        $stmtCount->execute();
        $newContactCount = $stmtCount->fetchColumn();
    } catch (Exception $e) {
        // Bỏ qua lỗi nếu DB chưa sẵn sàng
    }
}

// -------------------------------------------------------------------
// 3. XỬ LÝ ACTIVE MENU
// -------------------------------------------------------------------
$currentUri = $_SERVER['REQUEST_URI'];

if (!function_exists('isActive')) {
    function isActive($keyword, $uri) {
        $cleanUri = strtok($uri, '?');
        // Chỉ cần so sánh bắt đầu (cho gọn) vì Router đã redirect /admin -> /admin/template
        return (strpos($cleanUri, $keyword) === 0) 
            ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/30' 
            : 'text-slate-400 hover:bg-slate-800 hover:text-white';
    }
}
?>

<div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-40 hidden backdrop-blur-sm transition-opacity lg:hidden"></div>

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col border-r border-slate-800 shadow-2xl">
    
    <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md relative">
        <?php include 'logo.php';?>
        
        <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white absolute right-4">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto no-scrollbar py-6 px-4 space-y-1">

        <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-2">Quản lý</p>

        <a href="/admin/template" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/template', $currentUri) ?>">
            <i data-lucide="layout-template" class="w-5 h-5"></i>
            Templates
        </a>
        
        <a href="/admin/blog" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/blog', $currentUri) ?>">
            <i data-lucide="newspaper" class="w-5 h-5"></i>
            Blog
        </a>

        <a href="/admin/contact" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/contact', $currentUri) ?>">
            <div class="relative">
                <i data-lucide="inbox" class="w-5 h-5"></i>
                <?php if ($newContactCount > 0): ?>
                    <span class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold border-2 border-slate-900">
                        <?= $newContactCount > 9 ? '9+' : $newContactCount ?>
                    </span>
                <?php endif; ?>
            </div>
            Liên hệ
        </a>

        <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Hệ thống</p>

        <a href="/admin/page" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/page', $currentUri) ?>">
            <i data-lucide="file" class="w-5 h-5"></i>
            Trang tĩnh
        </a>

        <a href="/admin/account" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/account', $currentUri) ?>">
            <i data-lucide="users" class="w-5 h-5"></i>
            Tài khoản Admin
        </a>
        
        <a href="/admin/setting" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('/admin/setting', $currentUri) ?>">
            <i data-lucide="settings" class="w-5 h-5"></i>
            Cài đặt chung
        </a>
    </div>

    <div class="p-4 border-t border-slate-800 bg-slate-900">
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