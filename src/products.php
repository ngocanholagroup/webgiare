<?php
require_once 'config/database.php';
$pageTitle = "Kho giao diện Website chuyên nghiệp - HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-20 overflow-hidden bg-slate-50">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-gradient-to-r from-orange-200 to-pink-200 rounded-full blur-[100px] opacity-40 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-orange-100 text-orange-600 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
            <i data-lucide="layers" class="w-3.5 h-3.5"></i> 500+ Mẫu giao diện có sẵn
        </span>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
            Chọn giao diện <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">Đẳng cấp cho thương hiệu</span>
        </h1>
        
        <p class="text-gray-500 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
            Kho giao diện đa dạng ngành nghề, được thiết kế chuẩn UX/UI, tối ưu SEO và tốc độ. Giúp bạn tiết kiệm 80% thời gian và chi phí làm web.
        </p>

        <div class="max-w-xl mx-auto relative group z-20">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-pink-500 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
            <form class="relative flex items-center bg-white rounded-full p-2 pr-2.5 shadow-xl border border-gray-100">
                <div class="pl-4 text-gray-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <input type="text" placeholder="Tìm kiếm giao diện (VD: Bất động sản...)" 
                    class="w-full px-4 py-3 bg-transparent outline-none text-gray-700 placeholder-gray-400 font-medium">
                <button class="bg-slate-900 text-white px-6 py-3 rounded-full font-bold hover:bg-orange-600 transition-colors shadow-lg flex items-center gap-2">
                    <span>Tìm ngay</span>
                </button>
            </form>
        </div>
    </div>
</section>

<div class="sticky top-[72px] md:top-0 z-40 bg-white/80 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-3 overflow-x-auto no-scrollbar md:justify-center pb-2 md:pb-0">
            <button class="px-5 py-2.5 rounded-full bg-slate-900 text-white text-sm font-bold shadow-lg shadow-slate-900/20 hover:scale-105 transition-transform whitespace-nowrap">
                Tất cả mẫu
            </button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Bán hàng
            </button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-blue-500 hover:text-blue-500 hover:bg-blue-50 transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="building-2" class="w-4 h-4"></i> Doanh nghiệp
            </button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-green-500 hover:text-green-500 hover:bg-green-50 transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="home" class="w-4 h-4"></i> Bất động sản
            </button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-purple-500 hover:text-purple-500 hover:bg-purple-50 transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="rocket" class="w-4 h-4"></i> Landing Page
            </button>
        </div>
    </div>
</div>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">techzone.vn</div>
                </div>

                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200 group-hover:shadow-inner">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-md uppercase tracking-wide">Hot</span>
                    </div>
                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-400 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="laptop" class="w-16 h-16 opacity-30"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="product-detail.php" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded uppercase tracking-wider">E-commerce</span>
                        <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-orange-600 transition-colors">
                        <a href="product-detail.php">Siêu thị điện máy TechZone</a>
                    </h3>
                    
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">5.000.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">3.500.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-orange-50 hover:border-orange-200 hover:text-orange-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">nhaxinh.com</div>
                </div>
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="bg-blue-500 text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-md uppercase tracking-wide">New</span>
                    </div>
                    <div class="w-full h-full bg-gradient-to-br from-amber-50 to-orange-100 flex items-center justify-center text-amber-300 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="armchair" class="w-16 h-16 opacity-50"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="#" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded uppercase tracking-wider">Nội thất</span>
                         <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-gray-300 fill-current"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-amber-600 transition-colors">
                        <a href="#">Showroom Nội thất Nhà Xinh</a>
                    </h3>
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">6.500.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600">4.200.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-amber-50 hover:border-amber-200 hover:text-amber-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">bds-luxury.vn</div>
                </div>
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                    <div class="w-full h-full bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center text-emerald-300 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="building" class="w-16 h-16 opacity-50"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="#" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded uppercase tracking-wider">Bất động sản</span>
                        <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-emerald-600 transition-colors">
                        <a href="#">Sàn Bất động sản Luxury</a>
                    </h3>
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">8.000.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600">5.500.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">hera-spa.vn</div>
                </div>
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                    <div class="w-full h-full bg-gradient-to-br from-pink-50 to-rose-100 flex items-center justify-center text-rose-300 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="flower-2" class="w-16 h-16 opacity-50"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="#" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-pink-600 bg-pink-50 px-2 py-1 rounded uppercase tracking-wider">Mỹ phẩm / Spa</span>
                        <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-gray-300 fill-current"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-pink-600 transition-colors">
                        <a href="#">Chuỗi Spa & Mỹ phẩm Hera</a>
                    </h3>
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">4.000.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-600">2.800.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-pink-50 hover:border-pink-200 hover:text-pink-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

             <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">landing-sale.vn</div>
                </div>
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                    <div class="absolute top-3 left-3 z-10">
                         <span class="bg-purple-500 text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-md uppercase tracking-wide">Promo</span>
                    </div>
                    <div class="w-full h-full bg-gradient-to-br from-purple-50 to-violet-100 flex items-center justify-center text-violet-300 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="rocket" class="w-16 h-16 opacity-50"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="#" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded uppercase tracking-wider">Landing Page</span>
                        <div class="flex gap-0.5">
                             <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-purple-600 transition-colors">
                        <a href="#">Landing Page Bán Thực Phẩm Chức Năng</a>
                    </h3>
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">2.500.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-violet-600">1.500.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-purple-50 hover:border-purple-200 hover:text-purple-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    <div class="ml-auto text-[10px] text-gray-400 font-mono">edu-pro.vn</div>
                </div>
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                    <div class="w-full h-full bg-gradient-to-br from-sky-50 to-blue-100 flex items-center justify-center text-sky-300 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="graduation-cap" class="w-16 h-16 opacity-50"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                        <a href="#" class="bg-white text-gray-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-orange-500 hover:text-white transition-all shadow-lg flex items-center gap-2 transform hover:scale-105">
                            <i data-lucide="eye" class="w-4 h-4"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-sky-600 bg-sky-50 px-2 py-1 rounded uppercase tracking-wider">Giáo dục</span>
                         <div class="flex gap-0.5">
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                            <i data-lucide="star" class="w-3 h-3 text-orange-400 fill-current"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug group-hover:text-sky-600 transition-colors">
                        <a href="#">Hệ thống đào tạo trực tuyến EduPro</a>
                    </h3>
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 line-through mb-0.5">5.500.000đ</p>
                            <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-blue-600">3.800.000đ</p>
                        </div>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-sky-50 hover:border-sky-200 hover:text-sky-500 transition-all">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-center mt-20 gap-2">
            <button class="w-11 h-11 rounded-xl flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 hover:bg-white transition-all shadow-sm">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <button class="w-11 h-11 rounded-xl flex items-center justify-center bg-gradient-to-r from-orange-500 to-pink-600 text-white font-bold shadow-lg shadow-orange-500/30">1</button>
            <button class="w-11 h-11 rounded-xl flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 hover:bg-white transition-all shadow-sm">2</button>
            <button class="w-11 h-11 rounded-xl flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 hover:bg-white transition-all shadow-sm">3</button>
            <span class="w-11 h-11 flex items-center justify-center text-gray-400 font-bold tracking-widest">...</span>
            <button class="w-11 h-11 rounded-xl flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 hover:bg-white transition-all shadow-sm">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-slate-900 rounded-[2.5rem] p-10 md:p-20 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full mix-blend-screen filter blur-[100px] opacity-20 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-pink-500 rounded-full mix-blend-screen filter blur-[100px] opacity-20 pointer-events-none"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto space-y-8">
                <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight">
                    Không tìm thấy mẫu ưng ý? <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-pink-400">Hãy thiết kế theo cách riêng!</span>
                </h2>
                <p class="text-slate-400 text-xl font-light">
                    Đội ngũ chuyên gia của chúng tôi sẵn sàng hiện thực hóa mọi ý tưởng độc đáo của bạn thành một website hoàn chỉnh.
                </p>
                <div class="flex flex-col sm:flex-row gap-5 justify-center pt-6">
                    <a href="contact.php" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-pink-600 hover:from-orange-600 hover:to-pink-700 text-white px-10 py-4 rounded-full font-bold text-lg transition-all shadow-lg shadow-orange-500/30 hover:-translate-y-1">
                        <i data-lucide="pen-tool" class="w-5 h-5"></i> Yêu cầu thiết kế riêng
                    </a>
                    <a href="tel:0973157932" class="inline-flex items-center justify-center gap-2 bg-slate-800 border border-slate-700 text-white hover:bg-slate-700 px-10 py-4 rounded-full font-bold text-lg transition-all hover:-translate-y-1">
                        <i data-lucide="phone-call" class="w-5 h-5"></i> Gọi 0973.157.932
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>