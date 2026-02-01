<?php
require_once 'config/database.php';
$pageTitle = "Chi tiết giao diện: TechZone Pro - HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-12 overflow-hidden bg-slate-50">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-orange-100 rounded-full blur-3xl opacity-50 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="index.php" class="hover:text-orange-500 transition">Trang chủ</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <a href="products.php" class="hover:text-orange-500 transition">Kho giao diện</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-gray-900 font-medium">TechZone E-commerce</span>
        </div>

        <div class="max-w-4xl">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i> E-commerce
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="trending-up" class="w-3.5 h-3.5"></i> Bán chạy nhất
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                Siêu thị điện máy & công nghệ <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">TechZone Pro</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl leading-relaxed">
                Giao diện bán hàng chuyên nghiệp, tối ưu trải nghiệm người dùng (UX/UI), chuẩn SEO và tốc độ tải trang vượt trội. Phù hợp cho cửa hàng điện máy, kỹ thuật số.
            </p>
        </div>
    </div>
</section>

<section class="py-12 bg-white relative z-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">

            <div class="w-full lg:w-7/12 space-y-10">
                
                <div class="relative group">
                    <div class="relative bg-gray-800 rounded-t-3xl p-2 pb-0 shadow-2xl mx-4 md:mx-8 z-10">
                        <div class="bg-black rounded-t-2xl overflow-hidden relative aspect-[16/10]">
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center text-gray-400">
                                <i data-lucide="layout-template" class="w-24 h-24 opacity-50 mb-4"></i>
                                <p class="font-medium">Ảnh Demo Giao Diện</p>
                            </div>
                             <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                <a href="#" target="_blank" class="bg-white text-gray-900 px-8 py-4 rounded-full font-bold shadow-2xl hover:scale-105 hover:bg-orange-500 hover:text-white transition-all flex items-center gap-3">
                                    <i data-lucide="eye" class="w-6 h-6"></i> Xem Demo Trực Tiếp
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-700 h-4 md:h-6 rounded-b-3xl shadow-xl relative z-0 mx-auto w-full max-w-[95%]">
                        <div class="bg-gray-600 w-1/3 h-1 md:h-2 mx-auto rounded-b-xl opacity-50"></div>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 px-4 md:px-8">
                    <div class="aspect-video rounded-xl border-2 border-orange-500 p-1 cursor-pointer ring-4 ring-orange-100 transition-all"><div class="w-full h-full bg-gray-200 rounded-lg"></div></div>
                    <div class="aspect-video rounded-xl border-2 border-transparent p-1 cursor-pointer hover:border-gray-300 transition-all"><div class="w-full h-full bg-gray-200 rounded-lg"></div></div>
                    <div class="aspect-video rounded-xl border-2 border-transparent p-1 cursor-pointer hover:border-gray-300 transition-all"><div class="w-full h-full bg-gray-200 rounded-lg"></div></div>
                    <div class="aspect-video rounded-xl border-2 border-transparent p-1 cursor-pointer hover:border-gray-300 transition-all"><div class="w-full h-full bg-gray-200 rounded-lg"></div></div>
                </div>

                <div class="pt-8">
                    <div class="flex items-center gap-2 mb-8 p-1 bg-gray-100 rounded-full max-w-md">
                        <button class="flex-1 py-3 px-6 rounded-full bg-white text-gray-900 font-bold shadow-sm transition-all">
                            Mô tả chi tiết
                        </button>
                        <button class="flex-1 py-3 px-6 rounded-full text-gray-500 font-medium hover:text-gray-900 transition-all">
                            Tính năng nổi bật
                        </button>
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="sparkles" class="w-6 h-6 text-orange-500"></i> Tổng quan giao diện
                        </h3>
                        <p class="mb-6">
                            <strong>TechZone Pro</strong> là sự kết hợp hoàn hảo giữa thẩm mỹ hiện đại và công nghệ web tiên tiến nhất. Được xây dựng trên nền tảng Tailwind CSS, giao diện này đảm bảo tốc độ tải trang cực nhanh và khả năng tùy biến vô tận.
                        </p>
                        <p>Thích hợp cho các mô hình kinh doanh:</p>
                        <ul class="grid grid-cols-2 gap-2 list-none pl-0 mt-4">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i> Cửa hàng Điện thoại / Laptop</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i> Phụ kiện công nghệ</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i> Camera & Thiết bị số</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i> Điện máy gia dụng</li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-5/12 relative">
                <div class="sticky top-24 space-y-6">
                    
                    <div class="bg-white rounded-3xl p-8 border border-orange-100 shadow-2xl shadow-orange-500/10 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-400 to-pink-500 opacity-10 blur-2xl rounded-full -mr-10 -mt-10"></div>
                        
                        <div class="relative z-10">
                            <p class="text-sm text-gray-500 font-medium mb-1">Giá trọn gói (Giao diện + Cài đặt)</p>
                            <div class="flex items-end gap-4 mb-8">
                                <span class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight">3.500k</span>
                                <div class="mb-1">
                                    <span class="block text-lg text-gray-400 line-through decoration-2">5.000.000đ</span>
                                    <span class="inline-block bg-red-50 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">-30% Hôm nay</span>
                                </div>
                            </div>

                            <div class="space-y-4 mb-6">
                                <button class="w-full bg-gradient-to-r from-gray-900 to-gray-800 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all flex items-center justify-center gap-3 text-lg">
                                    <i data-lucide="shopping-cart" class="w-6 h-6"></i> Mua ngay bây giờ
                                </button>
                                <a href="tel:0973157932" class="w-full bg-white border-2 border-gray-200 text-gray-700 font-bold py-4 rounded-xl hover:border-orange-500 hover:text-orange-500 transition-all flex items-center justify-center gap-3">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i> Tư vấn: 0973.157.932
                                </a>
                            </div>
                            
                            <div class="flex items-center justify-center gap-2 text-sm text-gray-500 bg-gray-50 py-2 rounded-lg">
                                <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i> Thanh toán an toàn & Bảo mật thông tin
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i data-lucide="cpu" class="w-5 h-5 text-blue-500"></i> Thông số kỹ thuật
                        </h3>
                        <div class="space-y-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                        <i data-lucide="code-2" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Công nghệ</p>
                                        <p class="font-bold text-gray-900">PHP / Laravel / Tailwind</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-500">
                                        <i data-lucide="smartphone" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Responsive</p>
                                        <p class="font-bold text-gray-900">Tất cả thiết bị</p>
                                    </div>
                                </div>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500"></i>
                            </div>
                             <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-500">
                                        <i data-lucide="gauge" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Tốc độ (Google)</p>
                                        <p class="font-bold text-gray-900">95/100 Điểm</p>
                                    </div>
                                </div>
                                <span class="flex h-3 w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500">
                                        <i data-lucide="search-check" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Chuẩn SEO</p>
                                        <p class="font-bold text-gray-900">Schema Pro</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100 shadow-inner">
                        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                            <i data-lucide="gift" class="w-5 h-5 text-blue-500"></i> Ưu đãi đặc biệt
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-blue-800 text-sm font-medium">
                                <i data-lucide="check" class="w-5 h-5 text-blue-500 shrink-0"></i>
                                <span>Tặng <strong>Hosting 2GB NVMe</strong> tốc độ cao (1 Năm)</span>
                            </li>
                            <li class="flex items-start gap-3 text-blue-800 text-sm font-medium">
                                <i data-lucide="check" class="w-5 h-5 text-blue-500 shrink-0"></i>
                                <span>Miễn phí <strong>SSL</strong> bảo mật trọn đời</span>
                            </li>
                            <li class="flex items-start gap-3 text-blue-800 text-sm font-medium">
                                <i data-lucide="check" class="w-5 h-5 text-blue-500 shrink-0"></i>
                                <span>Hỗ trợ nhập liệu demo 20 sản phẩm</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>