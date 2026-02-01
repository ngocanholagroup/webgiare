<?php
require_once 'config/database.php';
$pageTitle = "Dự án tiêu biểu - Khách hàng của HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-20 bg-white overflow-hidden">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 skew-x-12 translate-x-20 z-0"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full blur-[80px] z-0"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="md:w-1/2 space-y-6">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="briefcase" class="w-3.5 h-3.5"></i> Hồ sơ năng lực
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Chúng tôi nói bằng <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">Kết quả thực tế</span>
                </h1>
                <p class="text-gray-500 text-lg leading-relaxed max-w-lg">
                    Khám phá những dự án Website và Marketing mà HolaGroup đã triển khai thành công cho các đối tác trong và ngoài nước.
                </p>
                
                <div class="flex gap-8 pt-4">
                    <div>
                        <div class="text-3xl font-bold text-gray-900">1.2k+</div>
                        <div class="text-sm text-gray-400">Dự án hoàn thành</div>
                    </div>
                    <div class="w-px bg-gray-200"></div>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">98%</div>
                        <div class="text-sm text-gray-400">Khách hàng hài lòng</div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 grid grid-cols-2 gap-4">
                <div class="space-y-4 translate-y-8">
                    <div class="bg-gray-200 rounded-2xl aspect-[3/4] overflow-hidden shadow-lg hover:-translate-y-2 transition-transform duration-500">
                        <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');"></div>
                    </div>
                    <div class="bg-gray-200 rounded-2xl aspect-square overflow-hidden shadow-lg hover:-translate-y-2 transition-transform duration-500">
                         <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');"></div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-gray-200 rounded-2xl aspect-square overflow-hidden shadow-lg hover:-translate-y-2 transition-transform duration-500">
                         <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');"></div>
                    </div>
                    <div class="bg-gray-200 rounded-2xl aspect-[3/4] overflow-hidden shadow-lg hover:-translate-y-2 transition-transform duration-500">
                         <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <div class="flex justify-center mb-12">
            <div class="inline-flex bg-white p-1.5 rounded-full border border-gray-200 shadow-sm overflow-x-auto max-w-full">
                <button class="px-6 py-2 rounded-full bg-slate-900 text-white text-sm font-bold shadow-md">Tất cả</button>
                <button class="px-6 py-2 rounded-full text-gray-500 hover:bg-gray-50 text-sm font-medium transition-colors">E-commerce</button>
                <button class="px-6 py-2 rounded-full text-gray-500 hover:bg-gray-50 text-sm font-medium transition-colors">Bất động sản</button>
                <button class="px-6 py-2 rounded-full text-gray-500 hover:bg-gray-50 text-sm font-medium transition-colors">Doanh nghiệp</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col">
                <div class="relative aspect-video overflow-hidden">
                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors z-10"></div>
                    <div class="w-full h-full bg-gray-200 group-hover:scale-110 transition-transform duration-700 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1481487484168-9b930d5b7d9f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="absolute bottom-4 left-4 z-20 bg-white p-2 rounded-lg shadow-lg">
                        <i data-lucide="flower" class="w-6 h-6 text-pink-500"></i>
                    </div>
                </div>
                
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold text-pink-600 bg-pink-50 px-2 py-1 rounded uppercase tracking-wider">Mỹ phẩm</span>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded">2023</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                        Thương hiệu Mỹ phẩm Organic Nature
                    </h3>
                    <p class="text-gray-500 mb-6 line-clamp-2">
                        Xây dựng hệ thống bán hàng đa kênh, tích hợp thanh toán online và quản lý kho hàng tự động.
                    </p>
                    
                    <div class="mt-auto grid grid-cols-2 gap-4 border-t border-gray-100 pt-6">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">+150%</p>
                            <p class="text-xs text-gray-400 uppercase">Doanh thu Online</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">0.8s</p>
                            <p class="text-xs text-gray-400 uppercase">Tốc độ tải trang</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col">
                <div class="relative aspect-video overflow-hidden">
                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors z-10"></div>
                     <div class="w-full h-full bg-gray-200 group-hover:scale-110 transition-transform duration-700 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="absolute bottom-4 left-4 z-20 bg-white p-2 rounded-lg shadow-lg">
                        <i data-lucide="building-2" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded uppercase tracking-wider">Bất động sản</span>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded">2024</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                        Sàn Giao dịch Địa ốc Luxury Home
                    </h3>
                    <p class="text-gray-500 mb-6 line-clamp-2">
                        Thiết kế Landing Page giới thiệu dự án với trải nghiệm xem nhà 360 độ (Virtual Tour) mượt mà.
                    </p>
                    <div class="mt-auto grid grid-cols-2 gap-4 border-t border-gray-100 pt-6">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">Top 1</p>
                            <p class="text-xs text-gray-400 uppercase">Từ khóa Google</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">500+</p>
                            <p class="text-xs text-gray-400 uppercase">Leads mỗi tháng</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col">
                <div class="relative aspect-video overflow-hidden">
                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors z-10"></div>
                     <div class="w-full h-full bg-gray-200 group-hover:scale-110 transition-transform duration-700 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="absolute bottom-4 left-4 z-20 bg-white p-2 rounded-lg shadow-lg">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded uppercase tracking-wider">Giáo dục</span>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded">2023</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                        Trung tâm Anh ngữ English Star
                    </h3>
                    <p class="text-gray-500 mb-6 line-clamp-2">
                        Hệ thống học trực tuyến (LMS) tích hợp thi thử, chấm điểm tự động và quản lý học viên.
                    </p>
                    <div class="mt-auto grid grid-cols-2 gap-4 border-t border-gray-100 pt-6">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">3.000</p>
                            <p class="text-xs text-gray-400 uppercase">Học viên Online</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">99.9%</p>
                            <p class="text-xs text-gray-400 uppercase">Uptime Server</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-16">
            <button class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500 px-8 py-3 rounded-full font-bold transition-all">
                Xem thêm dự án khác <i data-lucide="arrow-down" class="w-4 h-4"></i>
            </button>
        </div>

    </div>
</section>

<section class="py-20 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4 text-center">
        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-10">Được tin tưởng bởi 500+ Doanh nghiệp</p>
        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <div class="w-8 h-8 bg-blue-600 rounded"></div> TechCorp
            </div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <div class="w-8 h-8 bg-green-600 rounded-full"></div> EcoLife
            </div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <div class="w-8 h-8 bg-purple-600 rounded-tl-xl rounded-br-xl"></div> CreativeAds
            </div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <div class="w-8 h-8 bg-red-600 rounded-full border-4 border-red-200"></div> Foody
            </div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <div class="w-8 h-8 bg-orange-500 rounded-tr-xl rounded-bl-xl"></div> BuildPro
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
    <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-orange-900/20 to-transparent"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Bạn đã sẵn sàng cho dự án tiếp theo?</h2>
        <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">
            Hãy để chúng tôi giúp bạn xây dựng một website không chỉ đẹp mà còn mang lại hiệu quả kinh doanh thực tế.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="contact.php" class="bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-full font-bold transition-all shadow-lg shadow-orange-500/30">
                Liên hệ tư vấn miễn phí
            </a>
            <a href="products.php" class="bg-transparent border border-slate-600 text-white hover:bg-slate-800 px-10 py-4 rounded-full font-bold transition-all">
                Xem kho giao diện mẫu
            </a>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>