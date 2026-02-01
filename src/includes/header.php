<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Giá Rẻ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        blob: "blob 7s infinite",
                    },
                    keyframes: {
                        blob: {
                            "0%": {
                                transform: "translate(0px, 0px) scale(1)"
                            },
                            "33%": {
                                transform: "translate(30px, -50px) scale(1.1)"
                            },
                            "66%": {
                                transform: "translate(-20px, 20px) scale(0.9)"
                            },
                            "100%": {
                                transform: "translate(0px, 0px) scale(1)"
                            },
                        },
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-gray-50 font-sans leading-normal tracking-normal text-gray-800">

    <header class="fixed w-full top-0 z-50 transition-all duration-300" id="main-header">
        
        <div class="bg-slate-900 text-white py-2 text-xs md:text-sm hidden md:block">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2 opacity-80 hover:opacity-100 cursor-pointer transition">
                        <i data-lucide="mail" class="w-3.5 h-3.5"></i> sale@holagroup.com.vn
                    </span>
                    <span class="flex items-center gap-2 opacity-80 hover:opacity-100 cursor-pointer transition">
                        <i data-lucide="phone" class="w-3.5 h-3.5"></i> 0973.157.932
                    </span>
                </div>
                <a href="/blog.php" class="opacity-80 hover:opacity-100 transition">Tin tức</a>
            </div>
        </div>

        <nav class="bg-white/80 backdrop-blur-md border-b border-white/20 shadow-sm relative z-50">
            <div class="container mx-auto px-4 py-3 md:py-4">
                <div class="flex items-center justify-between">
                    
                    <a href="index.php" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20 group-hover:rotate-12 transition-transform duration-300">
                            <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                        </div>
                        <div class="leading-tight">
                            <span class="block text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700">HolaGroup</span>
                            <span class="block text-[10px] font-bold tracking-widest text-orange-500 uppercase">Tech Solution</span>
                        </div>
                    </a>

                    <div class="hidden lg:flex items-center gap-8">
                        <a href="index.php" class="text-sm font-semibold text-orange-600">Trang chủ</a>
                        <a href="/about.php" class="text-sm font-semibold text-gray-600 hover:text-orange-500 transition-colors">Giới thiệu</a>
                        <a href="/services.php" class="text-sm font-semibold text-gray-600 hover:text-orange-500 transition-colors">Dịch vụ</a>
                        <a href="/products.php" class="text-sm font-semibold text-gray-600 hover:text-orange-500 transition-colors">Dự án</a>
                        <a href="/portfolio.php" class="text-sm font-semibold text-gray-600 hover:text-orange-500 transition-colors">Portfolio</a>
                    </div>

                    <div class="hidden lg:flex">
                        <a href="/contact.php" class="bg-gray-900 hover:bg-orange-600 text-white text-sm font-bold px-5 py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-gray-900/20 hover:shadow-orange-500/30 flex items-center gap-2">
                            <span>Tư vấn ngay</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-600 hover:text-orange-500 transition-colors">
                        <i data-lucide="menu" class="w-7 h-7"></i>
                    </button>

                </div>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute w-full left-0 top-full shadow-xl">
                <div class="flex flex-col p-4 space-y-2">
                    <a href="index.php" class="px-4 py-3 text-orange-600 bg-orange-50 font-semibold rounded-lg">Trang chủ</a>
                    <a href="#" class="px-4 py-3 text-gray-600 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg">Sản phẩm</a>
                    <a href="#bang-gia" class="px-4 py-3 text-gray-600 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg">Bảng giá</a>
                    <a href="#lien-he" class="px-4 py-3 text-gray-600 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg">Liên hệ</a>
                    <div class="h-px bg-gray-100 my-2"></div>
                    <a href="#" class="px-4 py-3 text-center text-gray-600 font-bold border border-gray-200 rounded-lg">Đăng nhập</a>
                    <a href="#lien-he" class="px-4 py-3 text-center text-white bg-orange-500 hover:bg-orange-600 font-bold rounded-lg shadow-md">Nhận tư vấn ngay</a>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="h-[72px] md:h-[108px]"></div>

    <main>