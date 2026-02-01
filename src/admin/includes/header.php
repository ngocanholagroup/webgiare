<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - HolaGroup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Scrollbar cho đẹp */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { bg: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col border-r border-slate-800 transition-all duration-300">
            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <a href="../index.php" target="_blank" class="flex items-center gap-2 font-bold text-xl tracking-tight group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-pink-500 flex items-center justify-center group-hover:rotate-12 transition-transform">
                        <i data-lucide="zap" class="w-5 h-5 fill-current text-white"></i>
                    </div>
                    <span>HolaAdmin</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-2">Tổng quan</p>
                
                <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors <?php echo ($activePage == 'dashboard') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 <?php echo ($activePage == 'dashboard') ? '' : 'group-hover:text-orange-400'; ?>"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-6 mb-2">Quản lý</p>
                
                <a href="products.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors <?php echo ($activePage == 'products') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?>">
                    <i data-lucide="shopping-bag" class="w-5 h-5 <?php echo ($activePage == 'products') ? '' : 'group-hover:text-blue-400'; ?>"></i>
                    <span class="font-medium">Sản phẩm / Kho</span>
                </a>

                <a href="orders.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors <?php echo ($activePage == 'orders') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?>">
                    <i data-lucide="shopping-cart" class="w-5 h-5 <?php echo ($activePage == 'orders') ? '' : 'group-hover:text-green-400'; ?>"></i>
                    <span class="font-medium">Đơn hàng</span>
                    <?php if(!isset($activePage) || $activePage != 'orders'): ?>
                    <span class="ml-auto bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">3</span>
                    <?php endif; ?>
                </a>

                <a href="customers.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors <?php echo ($activePage == 'customers') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?>">
                    <i data-lucide="users" class="w-5 h-5 <?php echo ($activePage == 'customers') ? '' : 'group-hover:text-purple-400'; ?>"></i>
                    <span class="font-medium">Khách hàng</span>
                </a>

                <a href="blog.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors <?php echo ($activePage == 'blog') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?>">
                    <i data-lucide="pen-tool" class="w-5 h-5 <?php echo ($activePage == 'blog') ? '' : 'group-hover:text-pink-400'; ?>"></i>
                    <span class="font-medium">Bài viết Blog</span>
                </a>

            </nav>

            <div class="p-4 border-t border-slate-800">
                <a href="login.php" class="flex items-center gap-3 text-slate-400 hover:text-white transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="font-medium">Đăng xuất</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-20 flex-shrink-0">
                <button class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h2 class="text-lg font-bold text-gray-800 hidden md:block capitalize">
                    <?php echo isset($pageTitle) ? $pageTitle : 'Quản trị hệ thống'; ?>
                </h2>

                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-full transition-colors">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                    </button>
                    
                    <div class="h-8 w-px bg-gray-200 mx-1"></div>

                    <div class="flex items-center gap-3 cursor-pointer group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-gray-700 group-hover:text-orange-600">Admin</p>
                            <p class="text-xs text-gray-400">Super User</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-orange-100 border border-gray-200 p-0.5 overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=admin" alt="Admin" class="w-full h-full rounded-full object-cover">
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 md:p-8 scroll-smooth">