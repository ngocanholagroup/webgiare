<?php
require_once 'config/database.php';
$pageTitle = "Blog Công nghệ & Marketing - HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-20 bg-slate-50 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-orange-200 rounded-full blur-[100px] opacity-50 translate-x-1/3 -translate-y-1/3"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-white border border-gray-200 text-gray-500 text-xs font-bold uppercase tracking-widest mb-4 shadow-sm">
            Knowledge Hub
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
            Chia sẻ <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">Kiến thức số</span>
        </h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">
            Cập nhật xu hướng thiết kế Website, thủ thuật SEO và chiến lược Marketing Online mới nhất từ đội ngũ chuyên gia của HolaGroup.
        </p>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl group cursor-pointer">
            <div class="absolute inset-0 bg-slate-900/40 group-hover:bg-slate-900/30 transition-colors z-10"></div>
            <div class="aspect-[21/9] bg-cover bg-center group-hover:scale-105 transition-transform duration-700" 
                 style="background-image: url('https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
            </div>
            
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-12 z-20">
                <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block">
                    Mới nhất
                </span>
                <h2 class="text-2xl md:text-4xl font-bold text-white mb-4 leading-tight group-hover:text-orange-200 transition-colors">
                    5 Xu hướng thiết kế Website "lên ngôi" trong năm 2026
                </h2>
                <div class="flex items-center gap-4 text-white/80 text-sm">
                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-4 h-4"></i> 27/01/2026</span>
                    <span class="flex items-center gap-1"><i data-lucide="user" class="w-4 h-4"></i> Admin</span>
                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i> 5 phút đọc</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">

            <div class="w-full lg:w-8/12">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video">
                            <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                                 style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                            </div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-blue-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Marketing
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                Hướng dẫn SEO On-page chi tiết từ A-Z cho người mới bắt đầu
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                                Tối ưu hóa SEO On-page là bước đầu tiên và quan trọng nhất để đưa website lên top Google. Bài viết này sẽ hướng dẫn bạn từng bước...
                            </p>
                            <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-4">
                                <span class="text-xs text-gray-400">20/01/2026</span>
                                <a href="/blog-detail.php" class="text-sm font-bold text-orange-500 hover:text-orange-600 flex items-center gap-1 group/link">
                                    Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video">
                             <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                                 style="background-image: url('https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                            </div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-purple-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Design
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                Tại sao Website của bạn tải chậm? 5 Nguyên nhân & Cách khắc phục
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                                Tốc độ tải trang ảnh hưởng trực tiếp đến trải nghiệm người dùng và thứ hạng SEO. Cùng tìm hiểu nguyên nhân website bị chậm...
                            </p>
                            <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-4">
                                <span class="text-xs text-gray-400">18/01/2026</span>
                                <a href="/blog-detail.php" class="text-sm font-bold text-orange-500 hover:text-orange-600 flex items-center gap-1 group/link">
                                    Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video">
                             <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                                 style="background-image: url('https://images.unsplash.com/photo-1555421689-d68471e189f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                            </div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-green-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Tech
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                WordPress vs Custom Code: Đâu là lựa chọn tốt nhất cho doanh nghiệp?
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                                So sánh ưu nhược điểm giữa việc sử dụng CMS WordPress và Website Code tay để bạn có quyết định đúng đắn nhất.
                            </p>
                            <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-4">
                                <span class="text-xs text-gray-400">15/01/2026</span>
                                <a href="/blog-detail.php" class="text-sm font-bold text-orange-500 hover:text-orange-600 flex items-center gap-1 group/link">
                                    Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video">
                             <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                                 style="background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                            </div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-orange-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Business
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                Bùng nổ doanh số với Landing Page chuyển đổi cao
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                                Landing Page là gì? Tại sao chạy quảng cáo bắt buộc phải có Landing Page? Bí quyết thiết kế Landing Page chốt đơn mỏi tay.
                            </p>
                            <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-4">
                                <span class="text-xs text-gray-400">12/01/2026</span>
                                <a href="/blog-detail.php" class="text-sm font-bold text-orange-500 hover:text-orange-600 flex items-center gap-1 group/link">
                                    Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                </div>

                <div class="flex justify-center gap-2">
                    <button class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 bg-white transition-colors">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-orange-500 text-white font-bold shadow-lg shadow-orange-500/30">1</button>
                    <button class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 bg-white transition-colors">2</button>
                    <span class="w-10 h-10 flex items-center justify-center text-gray-400">...</span>
                    <button class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-200 text-gray-500 hover:border-orange-500 hover:text-orange-500 bg-white transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>

            </div>

            <aside class="w-full lg:w-4/12 space-y-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Tìm kiếm</h3>
                    <form class="relative">
                        <input type="text" placeholder="Nhập từ khóa..." class="w-full pl-4 pr-10 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                        <button class="absolute right-3 top-3 text-gray-400 hover:text-orange-500">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-lucide="folder" class="w-5 h-5 text-orange-500"></i> Danh mục
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-orange-600 hover:bg-orange-50 px-3 py-2 rounded-lg transition-all">
                                <span>Kiến thức Website</span>
                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full text-gray-500">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-orange-600 hover:bg-orange-50 px-3 py-2 rounded-lg transition-all">
                                <span>Digital Marketing</span>
                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full text-gray-500">08</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-orange-600 hover:bg-orange-50 px-3 py-2 rounded-lg transition-all">
                                <span>Thủ thuật SEO</span>
                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full text-gray-500">15</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-orange-600 hover:bg-orange-50 px-3 py-2 rounded-lg transition-all">
                                <span>Tin tức công nghệ</span>
                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full text-gray-500">05</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="relative rounded-2xl overflow-hidden text-center group">
                    <div class="absolute inset-0 bg-slate-900/80 z-10 transition-colors group-hover:bg-slate-900/70"></div>
                    <div class="aspect-[3/4] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80');"></div>
                    
                    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center p-6 text-white">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mb-4 shadow-lg animate-bounce">
                            <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Cần Website Gấp?</h3>
                        <p class="text-sm text-gray-300 mb-6">Sở hữu website chuyên nghiệp chỉ trong 3 ngày. Tặng Hosting & Tên miền.</p>
                        <a href="contact.php" class="bg-white text-orange-600 px-6 py-2.5 rounded-full font-bold text-sm hover:bg-orange-50 transition-colors shadow-lg">
                            Nhận báo giá
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-2xl text-white shadow-lg">
                    <h3 class="font-bold text-lg mb-2">Đăng ký nhận tin</h3>
                    <p class="text-blue-100 text-sm mb-4">Nhận bài viết mới nhất qua email hàng tuần. Không spam.</p>
                    <form class="space-y-2">
                        <input type="email" placeholder="Email của bạn" class="w-full px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:bg-white/20 outline-none">
                        <button class="w-full bg-white text-blue-600 font-bold py-2.5 rounded-lg hover:bg-blue-50 transition-colors">Đăng ký</button>
                    </form>
                </div>

            </aside>

        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>