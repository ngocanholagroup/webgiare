<?php
// Gọi Header (Đã chỉnh ở bước trước)
include 'includes/header.php';
?>

<style>
    /* Hiệu ứng nền Gradient chuyển động */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    /* Text Gradient sang trọng */
    .text-gradient {
        background: linear-gradient(to right, #f97316, #fbbf24);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<section class="relative bg-white overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-28">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-50 border border-orange-100 mb-8 animate-fade-in-up">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
            </span>
            <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">Công nghệ Web 2026</span>
        </div>

        <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
            Biến ý tưởng kinh doanh <br>
            thành <span class="text-gradient">Cỗ máy in tiền</span>
        </h1>

        <p class="text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto mb-10 leading-relaxed">
            Chúng tôi không chỉ thiết kế website. Chúng tôi xây dựng nền tảng kỹ thuật số giúp bạn <strong class="text-slate-800">bán hàng tự động</strong>, tối ưu SEO và nâng tầm thương hiệu.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="#bao-gia" class="group relative px-8 py-4 bg-orange-600 rounded-full text-white font-bold shadow-xl shadow-orange-500/30 hover:bg-orange-700 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                <span class="flex items-center gap-2">
                    Bắt đầu ngay <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </span>
            </a>
            <a href="#kho-giao-dien" class="px-8 py-4 bg-white border border-slate-200 rounded-full text-slate-700 font-bold hover:border-orange-500 hover:text-orange-600 transition-all duration-300 flex items-center gap-2">
                <i data-lucide="layout-grid" class="w-5 h-5"></i> Xem mẫu giao diện
            </a>
        </div>

        <div class="mt-16 relative mx-auto max-w-5xl">
            <div class="relative rounded-2xl bg-slate-900 p-2 shadow-2xl ring-1 ring-slate-900/10">
                <div class="absolute -top-px left-20 right-11 h-px bg-gradient-to-r from-orange-400/0 via-orange-400/70 to-orange-400/0"></div>
                <div class="rounded-xl bg-slate-800 overflow-hidden border border-slate-700/50">
                    <div class="flex items-center gap-2 px-4 py-3 bg-slate-900 border-b border-slate-700">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="mx-auto bg-slate-800 text-slate-400 text-xs px-3 py-1 rounded-md flex items-center gap-2">
                            <i data-lucide="lock" class="w-3 h-3"></i> your-business.com
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-0 h-[300px] md:h-[500px] bg-slate-900">
                        <div class="hidden md:block col-span-2 border-r border-slate-700 p-4 space-y-4">
                            <div class="h-8 w-8 bg-orange-500 rounded-lg mb-6"></div>
                            <div class="h-2 w-20 bg-slate-700 rounded"></div>
                            <div class="h-2 w-16 bg-slate-700 rounded"></div>
                            <div class="h-2 w-24 bg-slate-700 rounded"></div>
                        </div>
                        <div class="col-span-12 md:col-span-10 p-6">
                            <div class="flex justify-between items-end mb-6">
                                <div>
                                    <div class="h-2 w-32 bg-slate-700 rounded mb-2"></div>
                                    <div class="h-8 w-48 bg-white/10 rounded"></div>
                                </div>
                                <div class="px-4 py-2 bg-orange-600 rounded-lg text-xs text-white">Export Report</div>
                            </div>
                            <div class="grid grid-cols-3 gap-6 mb-6">
                                <div class="h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex flex-col justify-between">
                                    <div class="h-8 w-8 bg-orange-500/20 rounded-lg text-orange-500 flex items-center justify-center"><i data-lucide="dollar-sign" class="w-4 h-4"></i></div>
                                    <div class="text-2xl font-bold text-white">45.2M <span class="text-xs text-green-500">+12%</span></div>
                                </div>
                                <div class="h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex flex-col justify-between">
                                    <div class="h-8 w-8 bg-blue-500/20 rounded-lg text-blue-500 flex items-center justify-center"><i data-lucide="users" class="w-4 h-4"></i></div>
                                    <div class="text-2xl font-bold text-white">1,205 <span class="text-xs text-green-500">+5%</span></div>
                                </div>
                                <div class="hidden md:flex h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex-col justify-between">
                                    <div class="h-8 w-8 bg-purple-500/20 rounded-lg text-purple-500 flex items-center justify-center"><i data-lucide="shopping-cart" class="w-4 h-4"></i></div>
                                    <div class="text-2xl font-bold text-white">320 <span class="text-xs text-green-500">+8%</span></div>
                                </div>
                            </div>
                            <div class="h-48 bg-slate-800 rounded-xl border border-slate-700 w-full relative overflow-hidden">
                                <svg class="absolute bottom-0 left-0 w-full h-full text-orange-500/20 fill-current" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,20 L0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8 L100,20 Z" />
                                </svg>
                                <svg class="absolute bottom-0 left-0 w-full h-full text-orange-500 stroke-current stroke-2 fill-none" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-20 pt-10 border-t border-slate-100">
            <p class="text-sm text-slate-400 mb-6 font-medium">Được tin dùng bởi hơn 1,000+ doanh nghiệp</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-xl font-bold text-slate-800 flex items-center gap-2"><i data-lucide="triangle" class="fill-slate-800"></i> ACME Corp</span>
                <span class="text-xl font-bold text-slate-800 flex items-center gap-2"><i data-lucide="circle" class="fill-slate-800"></i> GlobalTech</span>
                <span class="text-xl font-bold text-slate-800 flex items-center gap-2"><i data-lucide="square" class="fill-slate-800"></i> NextGen</span>
                <span class="text-xl font-bold text-slate-800 flex items-center gap-2"><i data-lucide="hexagon" class="fill-slate-800"></i> Infinity</span>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Không chỉ là Website, đó là <br><span class="text-orange-500">Vũ khí cạnh tranh</span></h2>
            <p class="text-slate-500">Chúng tôi trang bị cho bạn những công nghệ mới nhất để vượt mặt đối thủ.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 md:p-12 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-50 rounded-full blur-3xl -mr-16 -mt-16 transition-all duration-500 group-hover:bg-orange-100"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-start gap-8">
                    <div class="flex-1">
                        <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white mb-6 rotate-3 group-hover:rotate-6 transition-transform">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Tốc độ tải trang < 0.5s</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">
                            Google yêu thích website nhanh. Khách hàng ghét chờ đợi. Chúng tôi tối ưu hóa Core Web Vitals để website của bạn nhanh như chớp, giữ chân khách hàng ngay từ giây đầu tiên.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-slate-700 font-medium"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> Hosting SSD NVMe cao cấp</li>
                            <li class="flex items-center gap-2 text-sm text-slate-700 font-medium"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> Công nghệ Caching đa tầng</li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/3 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <div class="space-y-3">
                            <div class="h-2 bg-slate-200 rounded w-3/4"></div>
                            <div class="h-2 bg-slate-200 rounded w-full"></div>
                            <div class="h-32 bg-orange-100 rounded-xl w-full flex items-center justify-center text-orange-500 font-bold text-4xl">
                                99<span class="text-sm mt-2">/100</span>
                            </div>
                            <div class="text-center text-xs text-slate-400">Google PageSpeed</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 mb-6">
                    <i data-lucide="search" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Chuẩn SEO từ gốc</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                    Cấu trúc HTML Semantic, Schema Markup, Meta Tags tự động... giúp bot Google dễ dàng đọc hiểu và xếp hạng website của bạn.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-500 mb-6">
                    <i data-lucide="smartphone" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Mobile First</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                    Giao diện hiển thị hoàn hảo trên mọi thiết bị: iPhone, iPad, Android. Trải nghiệm vuốt chạm mượt mà như dùng App.
                </p>
            </div>

            <div class="lg:col-span-2 bg-slate-900 rounded-3xl p-8 md:p-12 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1 text-white">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-orange-400 mb-6 border border-white/10">
                            <i data-lucide="shield-check" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Bảo mật cấp ngân hàng</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            Đừng để hacker phá hoại công việc kinh doanh của bạn. Chúng tôi tích hợp tường lửa WAF, SSL miễn phí và Backup tự động mỗi ngày.
                        </p>
                        <a href="#" class="text-orange-400 font-bold hover:text-orange-300 inline-flex items-center gap-2">Tìm hiểu thêm <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    </div>
                     <div class="w-full md:w-1/3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-orange-500 blur-2xl opacity-20"></div>
                            <div class="relative bg-slate-800 border border-slate-700 rounded-xl p-4">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-xs text-green-500 font-mono">System Secure</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-1 bg-slate-700 rounded w-full overflow-hidden">
                                        <div class="h-full bg-green-500 w-full animate-pulse"></div>
                                    </div>
                                    <div class="flex justify-between text-[10px] text-slate-500 font-mono">
                                        <span>Scan: 100%</span>
                                        <span>Threats: 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white" id="kho-giao-dien">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Giao diện <span class="text-orange-500">Đẳng cấp</span></h2>
                <p class="text-slate-500">Hàng trăm mẫu thiết kế chuẩn chỉnh cho đa ngành nghề.</p>
            </div>
            <a href="/kho-giao-dien" class="group px-6 py-3 bg-slate-100 text-slate-700 rounded-full font-bold hover:bg-orange-100 hover:text-orange-600 transition-all flex items-center gap-2">
                Xem tất cả mẫu <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/60 z-10 transition-all duration-300"></div>
                
                <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden">
                     <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-slate-100 to-slate-300"></div>
                    <div class="absolute top-4 left-4 right-4 h-4 bg-white/50 rounded-full"></div>
                    <div class="absolute top-12 left-4 right-4 bottom-4 bg-white shadow-lg rounded-t-lg mx-auto w-3/4"></div>
                </div>

                <div class="absolute bottom-0 left-0 w-full p-6 z-20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <span class="text-orange-400 text-xs font-bold uppercase tracking-wider mb-2 block">Thương mại điện tử</span>
                    <h3 class="text-white text-xl font-bold mb-4">Shop Thời Trang Modern</h3>
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 w-full">Xem Demo</button>
                </div>
            </div>

            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/60 z-10 transition-all duration-300"></div>
                <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-orange-50 to-orange-100"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 bg-orange-200 rounded-full blur-xl"></div>
                </div>
                <div class="absolute bottom-0 left-0 w-full p-6 z-20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <span class="text-orange-400 text-xs font-bold uppercase tracking-wider mb-2 block">Doanh nghiệp</span>
                    <h3 class="text-white text-xl font-bold mb-4">Corporate Pro</h3>
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 w-full">Xem Demo</button>
                </div>
            </div>

            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/60 z-10 transition-all duration-300"></div>
                <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-50 to-indigo-100"></div>
                </div>
                <div class="absolute bottom-0 left-0 w-full p-6 z-20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <span class="text-orange-400 text-xs font-bold uppercase tracking-wider mb-2 block">Landing Page</span>
                    <h3 class="text-white text-xl font-bold mb-4">Bất Động Sản Luxury</h3>
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 w-full">Xem Demo</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 relative overflow-hidden" id="bao-gia">
    <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-orange-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Đầu tư nhỏ <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">Hiệu quả lớn</span></h2>
            <div class="inline-flex bg-slate-800 rounded-full p-1 border border-slate-700">
                <button class="px-6 py-2 rounded-full bg-orange-500 text-white font-bold text-sm shadow-lg">Trọn gói</button>
                <button class="px-6 py-2 rounded-full text-slate-400 font-medium text-sm hover:text-white">Theo yêu cầu</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center max-w-6xl mx-auto">
            
            <div class="bg-slate-800/50 backdrop-blur-lg border border-slate-700 rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2">Khởi nghiệp</h3>
                <div class="text-3xl font-bold text-white mb-6">2.500.000 <span class="text-sm text-slate-500 font-normal">vnđ</span></div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8">
                    Website giới thiệu cơ bản, phù hợp cho cá nhân hoặc shop nhỏ.
                </p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-slate-500"></i> Giao diện theo mẫu</li>
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-slate-500"></i> Hosting 1GB</li>
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-slate-500"></i> Bảo mật SSL</li>
                </ul>
                <button class="w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all">Chọn gói này</button>
            </div>

            <div class="relative bg-gradient-to-b from-orange-500 to-orange-700 rounded-3xl p-8 shadow-2xl transform md:scale-110 z-10">
                <div class="absolute top-0 right-0 bg-white/20 text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase backdrop-blur-md">Khuyên dùng</div>
                <h3 class="text-orange-100 font-medium mb-2">Kinh doanh</h3>
                <div class="text-4xl font-bold text-white mb-6">4.900.000 <span class="text-sm text-orange-200 font-normal">vnđ</span></div>
                <p class="text-orange-100 text-sm mb-8 border-b border-orange-400/30 pb-8">
                    Đầy đủ tính năng bán hàng, tối ưu SEO nâng cao, tốc độ cao.
                </p>
                <ul class="space-y-4 mb-8 text-white text-sm font-medium">
                    <li class="flex items-center gap-3"><div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> Giao diện Premium</li>
                    <li class="flex items-center gap-3"><div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> Chuẩn SEO Pro</li>
                    <li class="flex items-center gap-3"><div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> Hosting NVMe 5GB</li>
                    <li class="flex items-center gap-3"><div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> Backup hàng ngày</li>
                </ul>
                <button class="w-full py-4 rounded-xl bg-white text-orange-600 font-bold hover:shadow-lg transition-all">Đăng ký ngay</button>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-lg border border-slate-700 rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2">Doanh nghiệp lớn</h3>
                <div class="text-3xl font-bold text-white mb-6">Liên hệ</div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8">
                    Thiết kế riêng độc quyền, tính năng phức tạp (Web App, CRM).
                </p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> Thiết kế UI/UX riêng</li>
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> Server riêng (VPS)</li>
                    <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> Code tính năng riêng</li>
                </ul>
                <button class="w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all">Chat tư vấn</button>
            </div>

        </div>
    </div>
</section>

<section class="relative py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="max-w-4xl mx-auto bg-orange-50 rounded-[3rem] p-12 md:p-20 border border-orange-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-orange-200 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-200 rounded-full blur-3xl opacity-50"></div>
            
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6">Đừng để đối thủ <br> vượt mặt bạn trên Google</h2>
            <p class="text-lg text-slate-600 mb-10 max-w-xl mx-auto">
                Mỗi giây bạn chần chừ là một khách hàng tiềm năng đang rơi vào tay đối thủ. Hãy để chúng tôi giúp bạn chiếm lĩnh thị trường ngay hôm nay.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:0973157932" class="px-8 py-4 bg-orange-600 text-white text-lg font-bold rounded-full shadow-xl shadow-orange-500/30 hover:bg-orange-700 transition-all transform hover:-translate-y-1">
                    Gọi ngay: 0973.157.932
                </a>
                <a href="https://zalo.me/0973157932" class="px-8 py-4 bg-white text-slate-800 border border-slate-200 text-lg font-bold rounded-full hover:border-blue-500 hover:text-blue-600 transition-all">
                    Chat Zalo
                </a>
            </div>
            
            <p class="mt-6 text-sm text-slate-400">Tư vấn miễn phí 100% • Không mua không sao</p>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>