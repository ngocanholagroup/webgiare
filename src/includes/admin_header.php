<?php
// Lấy đường dẫn hiện tại để active menu
// Ví dụ: /admin/templates -> lấy 'templates'
$uri = $_SERVER['REQUEST_URI'];
$active_page = basename(parse_url($uri, PHP_URL_PATH));

// Hàm kiểm tra active (Hỗ trợ cả thư mục con)
function isActive($keyword, $uri) {
    return strpos($uri, $keyword) !== false ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - HolaGroup</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: { 500: '#f97316', 600: '#ea580c' },
                        slate: { 800: '#1e293b', 900: '#0f172a' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-40 hidden backdrop-blur-sm transition-opacity lg:hidden"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col border-r border-slate-800 shadow-2xl">
        
        <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md">
            <a href="/admin/dashboard" class="flex items-center gap-3 group">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform">
                    <i data-lucide="zap" class="w-5 h-5 fill-current"></i>
                </div>
                <span class="font-bold text-lg tracking-tight text-slate-100">Hola<span class="text-orange-500">Admin</span></span>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar py-6 px-4 space-y-1">

            <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Quản lý sản phẩm</p>

            <a href="/admin/templates" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('templates', $uri) ?>">
                <i data-lucide="layout-template" class="w-5 h-5"></i>
                Templates
            </a>
            
            <a href="/admin/categories" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('categories', $uri) ?>">
                <i data-lucide="layers" class="w-5 h-5"></i>
                Danh mục Templates
            </a>

            <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Nội dung & KH</p>

            <a href="/admin/blogs" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('blogs', $uri) ?>">
                <i data-lucide="newspaper" class="w-5 h-5"></i>
                Blog
            </a>
            <a href="/admin/blog-categories" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('blog-categories', $uri) ?>">
                <i data-lucide="folder" class="w-5 h-5"></i>
                Danh mục Blog
            </a>

            <a href="/admin/contacts" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('contacts', $uri) ?>">
                <div class="relative">
                    <i data-lucide="inbox" class="w-5 h-5"></i>
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-slate-900"></span>
                </div>
                Liên hệ
            </a>

            <p class="px-2 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 mt-8">Cấu hình</p>

            <a href="/admin/users" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('users', $uri) ?>">
                <i data-lucide="users" class="w-5 h-5"></i>
                Tài khoản Admin
            </a>
            <a href="/admin/settings" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all <?= isActive('settings', $uri) ?>">
                <i data-lucide="settings" class="w-5 h-5"></i>
                Cài đặt chung
            </a>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-800 transition-colors cursor-pointer">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=f97316&color=fff" class="w-10 h-10 rounded-full border-2 border-slate-700">
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-slate-900 rounded-full"></span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">Administrator</p>
                    <p class="text-xs text-slate-400 truncate">Super Admin</p>
                </div>
                <a href="/admin/logout" class="text-slate-400 hover:text-red-500 transition-colors" title="Đăng xuất">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 lg:pl-64 transition-all duration-300">
        
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-30 px-4 lg:px-8 flex items-center justify-between">
            
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                
                <nav class="hidden md:flex text-sm font-medium text-slate-500">
                    <a href="/admin/dashboard" class="hover:text-orange-600 transition-colors">Admin</a>
                    <span class="mx-2 text-slate-300">/</span>
                    <span class="text-slate-800 capitalize"><?= str_replace(['/admin/', '.php'], '', $uri) ?: 'Dashboard' ?></span>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                <a href="/" target="_blank" class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-orange-50 text-slate-600 hover:text-orange-600 rounded-full text-xs font-bold transition-all border border-transparent hover:border-orange-200">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i> Xem trang chủ
                </a>

                <div class="h-6 w-px bg-slate-200 mx-1"></div>

                <button class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <main class="flex-1 p-4 lg:p-8 overflow-y-auto">