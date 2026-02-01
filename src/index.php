<?php
// 1. Gọi kết nối DB
require_once 'config/database.php';
// 2. Gọi Header
include 'includes/header.php';
?>

<!-- ======================= HERO ======================= -->
<section class="relative bg-gradient-to-br from-white via-blue-50 to-white overflow-hidden py-16 lg:py-24">
    <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            <div class="w-full lg:w-1/2 space-y-8">
                
                <div class="inline-flex items-center gap-2 bg-white border border-gray-100 shadow-sm px-4 py-1.5 rounded-full">
                    <i data-lucide="rocket" class="w-4 h-4 text-pink-500"></i>
                    <span class="text-sm font-semibold text-gray-600 tracking-wide">Giải pháp Website & Hosting trọn gói</span>
                </div>

                <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-[1.15]">
                    Thiết kế Website chuyên nghiệp <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-indigo-600">
                        Uy tín – Nhanh chóng
                    </span>
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed max-w-xl">
                    Chúng tôi là đơn vị chuyên cung cấp dịch vụ thiết kế website chuẩn SEO, tốc độ cao và dễ quản trị, phù hợp cho cá nhân, shop online, doanh nghiệp nhỏ đến lớn. Chúng tôi cam kết mang đến giải pháp website tối ưu nhất cho nhu cầu kinh doanh của bạn.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="#" class="group flex items-center gap-2 bg-gradient-to-r from-orange-500 to-pink-500 text-white px-8 py-3.5 rounded-full font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/40 hover:-translate-y-0.5 transition-all duration-300">
                        <i data-lucide="zap" class="w-5 h-5 fill-current"></i>
                        <span>Nhận tư vấn ngay</span>
                    </a>
                    
                    <a href="#" class="flex items-center gap-2 bg-white text-orange-500 border-2 border-orange-500 px-8 py-3.5 rounded-full font-bold hover:bg-orange-50 transition-colors duration-300">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                        <span>Xem bảng giá</span>
                    </a>
                </div>

                <div class="flex items-center gap-6 pt-4 text-sm font-medium text-gray-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4 text-green-500 fill-green-500"></i> Tốc độ cao
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i> Bảo mật mạnh
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-500"></i> Chuẩn SEO
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-100 to-pink-100 rounded-full blur-3xl opacity-60 -z-10 transform scale-90"></div>

                <div class="relative bg-slate-900 rounded-2xl shadow-2xl p-4 border border-slate-800 rotate-1 hover:rotate-0 transition-transform duration-500">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <div class="ml-4 text-xs text-slate-500 font-mono">HolaGroup</div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 flex flex-col items-center gap-4 py-2">
                            <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center text-white font-bold">H</div>
                            <div class="w-6 h-1 bg-slate-700 rounded-full"></div>
                            <div class="w-6 h-1 bg-slate-700 rounded-full"></div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div class="h-24 bg-gradient-to-r from-orange-200 to-pink-200 rounded-xl w-full opacity-90"></div>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="h-16 bg-orange-500/80 rounded-lg"></div>
                                <div class="h-16 bg-red-500/80 rounded-lg"></div>
                                <div class="h-16 bg-pink-600/80 rounded-lg"></div>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <span class="px-2 py-1 bg-slate-800 text-slate-400 text-[10px] rounded">Chuẩn SEO</span>
                                <span class="px-2 py-1 bg-slate-800 text-slate-400 text-[10px] rounded">Tối ưu tốc độ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -top-6 -right-4 bg-white p-4 rounded-xl shadow-xl border border-gray-100 animate-bounce hover:pause">
                    <div class="flex items-start gap-3">
                        <div>
                            <p class="text-xs text-gray-500">Doanh thu từ website</p>
                            <p class="text-lg font-bold text-gray-800">+145% <i data-lucide="arrow-up-right" class="inline w-4 h-4 text-green-500"></i></p>
                            <div class="flex gap-1 mt-1">
                                <div class="w-1 h-3 bg-green-500 rounded-full"></div>
                                <div class="w-1 h-5 bg-green-500 rounded-full"></div>
                                <div class="w-1 h-4 bg-green-500 rounded-full"></div>
                                <div class="w-1 h-6 bg-green-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-6 -left-4 bg-white p-3 pr-6 rounded-xl shadow-xl border border-gray-100 flex items-center gap-3">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-blue-200 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-purple-200 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-pink-200 border-2 border-white"></div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">+38 lead/ngày</p>
                        <p class="text-xs text-gray-500">HolaGroup</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ======================= STATS ======================= -->
<section class="py-24 bg-white relative overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none opacity-30" 
         style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h6 class="text-orange-500 font-bold tracking-widest uppercase text-sm mb-2">Thành tựu ấn tượng</h6>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                Những con số <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">biết nói</span>
            </h2>
            <p class="text-gray-500 text-lg">
                Hành trình 10 năm khẳng định vị thế với sự tin tưởng của hàng ngàn doanh nghiệp lớn nhỏ trên toàn quốc.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-2xl hover:border-orange-200 hover:-translate-y-2 transition-all duration-300 text-center">
                <div class="w-16 h-16 mx-auto bg-orange-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-orange-500 transition-colors duration-300">
                    <i data-lucide="award" class="w-8 h-8 text-orange-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <div class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors counter" data-target="10">10</div>
                <p class="text-gray-500 font-medium uppercase tracking-wider text-sm">Năm kinh nghiệm</p>
                <div class="w-10 h-1 bg-orange-200 mx-auto mt-4 rounded-full group-hover:w-20 group-hover:bg-orange-500 transition-all duration-300"></div>
            </div>

            <div class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-2 transition-all duration-300 text-center">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-blue-500 transition-colors duration-300">
                    <i data-lucide="users" class="w-8 h-8 text-blue-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <div class="flex justify-center items-center gap-1 text-4xl lg:text-5xl font-extrabold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                    <span class="counter" data-target="1732">1732</span><span>+</span>
                </div>
                <p class="text-gray-500 font-medium uppercase tracking-wider text-sm">Khách hàng</p>
                <div class="w-10 h-1 bg-blue-200 mx-auto mt-4 rounded-full group-hover:w-20 group-hover:bg-blue-500 transition-all duration-300"></div>
            </div>

            <div class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-2xl hover:border-purple-200 hover:-translate-y-2 transition-all duration-300 text-center">
                <div class="w-16 h-16 mx-auto bg-purple-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-purple-500 transition-colors duration-300">
                    <i data-lucide="briefcase" class="w-8 h-8 text-purple-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <div class="flex justify-center items-center gap-1 text-4xl lg:text-5xl font-extrabold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                    <span class="counter" data-target="1200">1200</span><span>+</span>
                </div>
                <p class="text-gray-500 font-medium uppercase tracking-wider text-sm">Dự án hoàn thành</p>
                <div class="w-10 h-1 bg-purple-200 mx-auto mt-4 rounded-full group-hover:w-20 group-hover:bg-purple-500 transition-all duration-300"></div>
            </div>

            <div class="group relative bg-white rounded-2xl p-8 border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-2xl hover:border-green-200 hover:-translate-y-2 transition-all duration-300 text-center">
                <div class="w-16 h-16 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-500 transition-colors duration-300">
                    <i data-lucide="smile-plus" class="w-8 h-8 text-green-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <div class="flex justify-center items-center gap-1 text-4xl lg:text-5xl font-extrabold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                    <span class="counter" data-target="96">96</span><span>%</span>
                </div>
                <p class="text-gray-500 font-medium uppercase tracking-wider text-sm">Hài lòng tuyệt đối</p>
                <div class="w-10 h-1 bg-green-200 mx-auto mt-4 rounded-full group-hover:w-20 group-hover:bg-green-500 transition-all duration-300"></div>
            </div>

        </div>
    </div>
</section>

<!-- ======================= BENEFITS ======================= -->
<section class="py-20 bg-gray-50 relative overflow-hidden">
    
    <div class="absolute inset-0" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 32px 32px; opacity: 0.3;"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Lợi ích của việc <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Sở hữu Website chuyên nghiệp</span>
            </h2>
            <p class="text-gray-600 text-lg">
                Những giá trị cốt lõi khi sở hữu một website được thiết kế bài bản, chuẩn SEO và tối ưu trải nghiệm người dùng.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-blue-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="monitor-smartphone" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Giao diện hiện đại</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Thiết kế đẹp mắt, bố cục thông minh, tối ưu hóa trải nghiệm người dùng (UX/UI) trên mọi thiết bị.
                    </p>
                    <div class="flex items-center text-blue-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-green-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="trending-up" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Chuẩn SEO Google</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Cấu trúc code tối ưu giúp website dễ dàng leo top tìm kiếm, tiếp cận khách hàng tiềm năng tự nhiên.
                    </p>
                    <div class="flex items-center text-green-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-purple-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="zap" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">Tốc độ cao & Bảo mật</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Hệ thống load trang siêu tốc dưới 1s và các lớp bảo mật SSL/Firewall an toàn tuyệt đối.
                    </p>
                    <div class="flex items-center text-purple-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-orange-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-amber-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="layout-dashboard" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">Quản trị dễ dàng</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Giao diện trang Admin trực quan, tiếng Việt hóa 100%, ai cũng có thể sử dụng mà không cần biết code.
                    </p>
                    <div class="flex items-center text-orange-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-red-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-red-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="heart-handshake" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors">Hỗ trợ trọn đời</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Cam kết bảo hành kỹ thuật vĩnh viễn, đội ngũ support 24/7 sẵn sàng giải quyết mọi vấn đề phát sinh.
                    </p>
                    <div class="flex items-center text-red-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 hover:border-teal-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-cyan-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-teal-500/30 mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="settings-2" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-teal-600 transition-colors">Tùy chỉnh linh hoạt</h3>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Thiết kế module linh động, dễ dàng nâng cấp tính năng theo đặc thù từng ngành nghề kinh doanh.
                    </p>
                    <div class="flex items-center text-teal-600 font-medium text-sm cursor-pointer group/link">
                        Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ======================= PROCESSING ======================= -->

<section class="py-20 bg-white relative overflow-hidden">
    
    <div class="container mx-auto px-4 mb-16 text-center">
        <h6 class="text-orange-500 font-bold tracking-widest uppercase text-sm mb-2">Quy trình làm việc</h6>
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
            Quy trình thiết kế <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-500">Website</span>
        </h2>
        <p class="text-gray-500 max-w-2xl mx-auto">
            Chúng tôi đồng hành cùng bạn qua 5 bước tiêu chuẩn, đảm bảo minh bạch, đúng tiến độ và chất lượng cao nhất.
        </p>
    </div>

    <div class="container mx-auto px-4 relative">
        
        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gradient-to-b from-orange-100 via-orange-300 to-orange-100"></div>
        
        <div class="md:hidden absolute left-8 top-0 h-full w-0.5 bg-gray-200"></div>

        <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group">
            <div class="order-2 md:order-1 md:w-5/12 md:text-right pl-16 md:pl-0 md:pr-12">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">Bước 1: Tư vấn & Báo giá</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Lắng nghe nhu cầu, phân tích đối thủ và tư vấn giải pháp phù hợp nhất. Thống nhất chi phí và ký hợp đồng tạm ứng.
                </p>
            </div>
            
            <div class="absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-white border-4 border-orange-100 rounded-full shadow-lg z-10 group-hover:scale-110 group-hover:border-orange-500 transition-all duration-300">
                <i data-lucide="message-square-dashed" class="w-5 h-5 text-orange-500"></i>
            </div>
            
            <div class="order-1 md:order-2 md:w-5/12"></div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group">
            <div class="order-2 md:order-1 md:w-5/12"></div>
            
            <div class="absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-white border-4 border-blue-100 rounded-full shadow-lg z-10 group-hover:scale-110 group-hover:border-blue-500 transition-all duration-300">
                <i data-lucide="pen-tool" class="w-5 h-5 text-blue-500"></i>
            </div>
            
            <div class="order-1 md:order-2 md:w-5/12 pl-16 md:pl-12">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Bước 2: Chốt giao diện (Demo)</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Thiết kế bản vẽ giao diện (UI/UX). Gửi khách hàng xem và chỉnh sửa đến khi bạn hoàn toàn hài lòng mới chuyển sang code.
                </p>
            </div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group">
            <div class="order-2 md:order-1 md:w-5/12 md:text-right pl-16 md:pl-0 md:pr-12">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">Bước 3: Lập trình tính năng</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Đội ngũ kỹ thuật tiến hành cắt HTML/CSS và lập trình chức năng. Đảm bảo code sạch, tối ưu tốc độ và chuẩn SEO.
                </p>
            </div>
            
            <div class="absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-white border-4 border-purple-100 rounded-full shadow-lg z-10 group-hover:scale-110 group-hover:border-purple-500 transition-all duration-300">
                <i data-lucide="code-2" class="w-5 h-5 text-purple-500"></i>
            </div>
            
            <div class="order-1 md:order-2 md:w-5/12"></div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group">
            <div class="order-2 md:order-1 md:w-5/12"></div>
            
            <div class="absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-white border-4 border-pink-100 rounded-full shadow-lg z-10 group-hover:scale-110 group-hover:border-pink-500 transition-all duration-300">
                <i data-lucide="monitor-play" class="w-5 h-5 text-pink-500"></i>
            </div>
            
            <div class="order-1 md:order-2 md:w-5/12 pl-16 md:pl-12">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors">Bước 4: Kiểm thử & Feedback</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Đưa website lên môi trường chạy thử. Khách hàng kiểm tra, gửi phản hồi để chúng tôi tinh chỉnh lần cuối.
                </p>
            </div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between group">
            <div class="order-2 md:order-1 md:w-5/12 md:text-right pl-16 md:pl-0 md:pr-12">
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Bước 5: Bàn giao & Hướng dẫn</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Bàn giao toàn bộ mã nguồn, tài khoản quản trị. Quay video hướng dẫn sử dụng và kích hoạt chế độ bảo hành trọn đời.
                </p>
            </div>
            
            <div class="absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-white border-4 border-green-100 rounded-full shadow-lg z-10 group-hover:scale-110 group-hover:border-green-500 transition-all duration-300">
                <i data-lucide="package-check" class="w-5 h-5 text-green-500"></i>
            </div>
            
            <div class="order-1 md:order-2 md:w-5/12"></div>
        </div>

    </div>
</section>

<!-- ======================= PRICING ======================= -->
<section class="py-24 bg-slate-50 relative overflow-hidden" id="bang-gia">
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-orange-100/40 rounded-full blur-3xl -z-10 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Bảng giá <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">Thiết kế Website</span>
            </h2>
            <p class="text-gray-500 text-lg">
                Được hơn <span class="font-bold text-gray-800">1732+</span> khách hàng tin tưởng & lựa chọn với chất lượng và chi phí tối ưu nhất.
            </p>
            
            <div class="flex justify-center items-center mt-6">
                <span class="text-sm font-medium text-gray-500 mr-3">Thanh toán theo năm</span>
                <div class="w-12 h-6 bg-orange-500 rounded-full flex items-center p-1 cursor-pointer">
                    <div class="w-4 h-4 bg-white rounded-full shadow-md transform translate-x-6"></div>
                </div>
                <span class="text-sm font-bold text-gray-900 ml-3">Tiết kiệm 20%</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            
            <div class="relative bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <h3 class="text-lg font-semibold text-gray-500 uppercase tracking-wider mb-4">Mẫu có sẵn</h3>
                <div class="flex items-baseline gap-2 mb-6">
                    <span class="text-4xl font-extrabold text-gray-900">2.000.000đ</span>
                    <span class="text-sm text-gray-400 line-through">3.000.000đ</span>
                </div>
                <p class="text-gray-500 text-sm mb-6 pb-6 border-b border-gray-100">
                    Phù hợp cho cá nhân, Landing Page giới thiệu sản phẩm đơn giản.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500 mr-3 shrink-0"></i>
                        Phân tích định hướng kinh doanh
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500 mr-3 shrink-0"></i>
                        Thiết kế website theo kho mẫu
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500 mr-3 shrink-0"></i>
                        Đề xuất cấu trúc website chuẩn SEO
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500 mr-3 shrink-0"></i>
                        Hỗ trợ kỹ thuật trọn đời
                    </li>
                </ul>
                <a href="#" class="block w-full py-3 px-6 text-center rounded-xl border-2 border-orange-100 text-orange-600 font-bold hover:bg-orange-50 hover:border-orange-500 transition-all duration-300">
                    Chọn gói này
                </a>
            </div>

            <div class="relative bg-white rounded-2xl p-8 shadow-2xl border-2 border-orange-500 transform md:scale-105 z-10 overflow-hidden">
                <div class="absolute top-0 right-0">
                    <div class="bg-gradient-to-r from-orange-500 to-pink-500 text-white text-xs font-bold px-3 py-1 rounded-bl-xl uppercase tracking-wide">
                        Phổ biến nhất
                    </div>
                </div>

                <h3 class="text-lg font-bold text-orange-600 uppercase tracking-wider mb-4">Theo yêu cầu</h3>
                <div class="flex items-baseline gap-2 mb-6">
                    <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-pink-600">
                        4.500.000đ
                    </span>
                    <span class="text-sm text-gray-400 line-through">6.500.000đ</span>
                </div>
                <p class="text-gray-500 text-sm mb-6 pb-6 border-b border-gray-100">
                    Giải pháp toàn diện cho doanh nghiệp, shop bán hàng chuyên nghiệp.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-gray-700 font-medium text-sm">
                        <div class="bg-orange-100 rounded-full p-0.5 mr-3 shrink-0"><i data-lucide="check" class="w-3 h-3 text-orange-600"></i></div>
                        Thiết kế giao diện độc quyền (UI/UX)
                    </li>
                    <li class="flex items-start text-gray-700 font-medium text-sm">
                        <div class="bg-orange-100 rounded-full p-0.5 mr-3 shrink-0"><i data-lucide="check" class="w-3 h-3 text-orange-600"></i></div>
                        Phân tích kinh doanh chuyên sâu
                    </li>
                    <li class="flex items-start text-gray-700 font-medium text-sm">
                        <div class="bg-orange-100 rounded-full p-0.5 mr-3 shrink-0"><i data-lucide="check" class="w-3 h-3 text-orange-600"></i></div>
                        <span class="text-orange-600 font-bold mr-1">Tặng</span> Hosting tốc độ cao 1GB
                    </li>
                    <li class="flex items-start text-gray-700 font-medium text-sm">
                        <div class="bg-orange-100 rounded-full p-0.5 mr-3 shrink-0"><i data-lucide="check" class="w-3 h-3 text-orange-600"></i></div>
                        <span class="text-orange-600 font-bold mr-1">Free</span> Chứng chỉ bảo mật SSL
                    </li>
                    <li class="flex items-start text-gray-700 font-medium text-sm">
                        <div class="bg-orange-100 rounded-full p-0.5 mr-3 shrink-0"><i data-lucide="check" class="w-3 h-3 text-orange-600"></i></div>
                        Backup dữ liệu hàng tháng
                    </li>
                </ul>
                <a href="#" class="block w-full py-4 px-6 text-center rounded-xl bg-gradient-to-r from-orange-500 to-pink-600 text-white font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                    Đăng ký tư vấn ngay
                </a>
            </div>

            <div class="relative bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <h3 class="text-lg font-semibold text-gray-500 uppercase tracking-wider mb-4">Yêu cầu đặc biệt</h3>
                <div class="flex items-baseline gap-2 mb-6">
                    <span class="text-4xl font-extrabold text-gray-900">Liên hệ</span>
                </div>
                <p class="text-gray-500 text-sm mb-6 pb-6 border-b border-gray-100">
                    Dành cho dự án lớn, hệ thống quản lý phức tạp (SaaS, ERP, CRM).
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-500 mr-3 shrink-0"></i>
                        Kiến trúc hệ thống riêng biệt
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-500 mr-3 shrink-0"></i>
                        Tích hợp API, CRM, ERP, Payment
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-500 mr-3 shrink-0"></i>
                        Tùy chỉnh chức năng nâng cao
                    </li>
                    <li class="flex items-start text-gray-600 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-500 mr-3 shrink-0"></i>
                        Bảo mật cấp cao & chịu tải lớn
                    </li>
                </ul>
                <a href="#" class="block w-full py-3 px-6 text-center rounded-xl border-2 border-gray-200 text-gray-700 font-bold hover:bg-gray-800 hover:text-white hover:border-gray-800 transition-all duration-300">
                    Liên hệ báo giá
                </a>
            </div>

        </div>
        
        <div class="mt-12 text-center">
            <p class="text-gray-400 text-sm">
                * Bảng giá chưa bao gồm VAT. Cam kết không phát sinh chi phí ẩn.
            </p>
        </div>

    </div>
</section>

<!-- ======================= WHY CHOOSE US ======================= -->
 <section class="py-24 bg-white relative overflow-hidden">
    
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-orange-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h6 class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-2">Giá trị cốt lõi</h6>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                Tại sao chọn <span class="relative inline-block">
                    <span class="relative z-10">HolaGroup</span>
                    <span class="absolute bottom-1 left-0 w-full h-3 bg-yellow-200 -z-0 opacity-60"></span>
                </span>?
            </h2>
            <p class="text-gray-500 text-lg">
                5 lý do khiến hơn 1700+ khách hàng tin tưởng giao phó xây dựng hệ thống Online cho doanh nghiệp của họ.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            
            <div class="group p-8 rounded-2xl bg-white border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:border-orange-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-orange-50 flex items-center justify-center mb-6 group-hover:bg-orange-500 transition-colors duration-300">
                    <i data-lucide="palette" class="w-7 h-7 text-orange-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Thiết kế theo yêu cầu</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Không sử dụng mẫu đại trà. Chúng tôi sáng tạo giao diện độc bản, phù hợp với nhận diện thương hiệu và gu thẩm mỹ riêng của bạn.
                </p>
            </div>

            <div class="group p-8 rounded-2xl bg-white border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:border-blue-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center mb-6 group-hover:bg-blue-500 transition-colors duration-300">
                    <i data-lucide="headset" class="w-7 h-7 text-blue-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Hỗ trợ tận tâm 24/7</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Đội ngũ tư vấn chuyên nghiệp luôn sẵn sàng đồng hành, giải đáp thắc mắc từ giai đoạn ý tưởng đến khi vận hành thực tế.
                </p>
            </div>

            <div class="group p-8 rounded-2xl bg-white border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:border-yellow-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-yellow-50 flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition-colors duration-300">
                    <i data-lucide="sparkles" class="w-7 h-7 text-yellow-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Chất lượng vượt trội</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Website chuẩn UX/UI, tối ưu hiệu suất (Core Web Vitals), tương thích mọi thiết bị, xứng đáng với từng đồng chi phí đầu tư.
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <div class="group p-8 rounded-2xl bg-white border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:border-purple-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center mb-6 group-hover:bg-purple-500 transition-colors duration-300">
                    <i data-lucide="box" class="w-7 h-7 text-purple-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Giải pháp trọn gói</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Từ giao diện, nội dung, hosting, tên miền đến bảo mật SSL – tất cả được triển khai đồng bộ trong một quy trình khép kín.
                </p>
            </div>

            <div class="group p-8 rounded-2xl bg-white border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:border-green-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center mb-6 group-hover:bg-green-500 transition-colors duration-300">
                    <i data-lucide="line-chart" class="w-7 h-7 text-green-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kinh nghiệm SEO thực chiến</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Cấu trúc code chuẩn SEO Google ngay từ đầu, giúp website dễ dàng leo top tìm kiếm và tăng trưởng lưu lượng truy cập bền vững.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ======================= FAQ ======================= -->
 <section class="py-24 bg-slate-50 relative overflow-hidden">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full z-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                Câu hỏi <span class="text-orange-500">thường gặp</span>
            </h2>
            <p class="text-gray-500 text-lg">
                Giải đáp những thắc mắc phổ biến nhất của khách hàng về quy trình, chi phí và bảo hành dịch vụ.
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">

            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 open:border-orange-300 open:shadow-md transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none text-gray-800 font-bold hover:text-orange-600 transition-colors">
                    <span>Thời gian hoàn thiện một website là bao lâu?</span>
                    <span class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:text-orange-500 group-open:bg-orange-100 group-open:text-orange-600 group-open:rotate-180 transition-all duration-300">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-500 leading-relaxed border-t border-gray-50 pt-4 animate-fadeIn">
                    <p>Thời gian phụ thuộc vào độ phức tạp của dự án:</p>
                    <ul class="list-disc ml-5 mt-2 space-y-1">
                        <li><strong>Website mẫu sẵn:</strong> Hoàn thiện trong 3 - 5 ngày làm việc.</li>
                        <li><strong>Website theo yêu cầu:</strong> Từ 15 - 25 ngày (bao gồm thời gian thiết kế UI/UX và lập trình).</li>
                    </ul>
                    <p class="mt-2">Chúng tôi luôn cam kết đúng tiến độ đã ký trong hợp đồng.</p>
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 open:border-orange-300 open:shadow-md transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none text-gray-800 font-bold hover:text-orange-600 transition-colors">
                    <span>Chi phí thiết kế đã bao gồm Hosting và Tên miền chưa?</span>
                    <span class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:text-orange-500 group-open:bg-orange-100 group-open:text-orange-600 group-open:rotate-180 transition-all duration-300">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-500 leading-relaxed border-t border-gray-50 pt-4">
                    Thông thường, các gói thiết kế của chúng tôi <strong>đã bao gồm miễn phí</strong> Tên miền quốc tế (.com/.net) và Hosting chất lượng cao trong năm đầu tiên. Từ năm thứ 2, bạn chỉ cần gia hạn phí duy trì Hosting và Tên miền theo bảng giá niêm yết, không phát sinh phí thiết kế nào khác.
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 open:border-orange-300 open:shadow-md transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none text-gray-800 font-bold hover:text-orange-600 transition-colors">
                    <span>Website có chuẩn SEO và hiển thị tốt trên di động không?</span>
                    <span class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:text-orange-500 group-open:bg-orange-100 group-open:text-orange-600 group-open:rotate-180 transition-all duration-300">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-500 leading-relaxed border-t border-gray-50 pt-4">
                    Chắc chắn rồi! 100% sản phẩm của HolaGroup đều được lập trình theo tiêu chuẩn <strong>Responsive Design</strong> (tương thích mọi thiết bị Mobile, Tablet, Desktop). Cấu trúc code được tối ưu hóa theo các tiêu chí của Google (Core Web Vitals) giúp website dễ dàng leo Top tìm kiếm.
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 open:border-orange-300 open:shadow-md transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none text-gray-800 font-bold hover:text-orange-600 transition-colors">
                    <span>Sau khi bàn giao, tôi có tự chỉnh sửa nội dung được không?</span>
                    <span class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:text-orange-500 group-open:bg-orange-100 group-open:text-orange-600 group-open:rotate-180 transition-all duration-300">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-500 leading-relaxed border-t border-gray-50 pt-4">
                    Có. Chúng tôi bàn giao hệ thống quản trị (CMS) trực quan, hoàn toàn bằng tiếng Việt. Bạn có thể dễ dàng thêm/sửa/xóa bài viết, sản phẩm, hình ảnh chỉ với vài thao tác kéo thả mà không cần biết về kỹ thuật lập trình. Ngoài ra, chúng tôi có video hướng dẫn chi tiết đi kèm.
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 open:border-orange-300 open:shadow-md transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none text-gray-800 font-bold hover:text-orange-600 transition-colors">
                    <span>Chế độ bảo hành và hỗ trợ kỹ thuật như thế nào?</span>
                    <span class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:text-orange-500 group-open:bg-orange-100 group-open:text-orange-600 group-open:rotate-180 transition-all duration-300">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-500 leading-relaxed border-t border-gray-50 pt-4">
                    Chúng tôi cam kết <strong>bảo hành trọn đời</strong> đối với các website sử dụng Hosting do chúng tôi cung cấp. Mọi lỗi kỹ thuật phát sinh từ mã nguồn sẽ được xử lý miễn phí trong vòng 24h. Đội ngũ support luôn túc trực để hỗ trợ bạn qua Zalo/Hotline bất cứ khi nào cần.
                </div>
            </details>

        </div>

        <div class="mt-12 text-center text-gray-500">
            Bạn còn câu hỏi khác? <a href="#" class="text-orange-600 font-bold hover:underline">Liên hệ tư vấn viên ngay</a>
        </div>

    </div>
</section>

<!-- ======================= CONTACT ======================= -->

<section class="py-24 bg-white relative overflow-hidden" id="lien-he">
    
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-gradient-to-br from-orange-100 to-pink-100 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-0 left-0 -translate-x-1/4 translate-y-1/4 w-[400px] h-[400px] bg-blue-50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
            
            <div class="w-full lg:w-5/12 space-y-8">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-100 text-orange-600 text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="zap" class="w-3 h-3"></i> Kết nối với HolaGroup
                </div>

                <div class="space-y-4">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                        Liên hệ tư vấn & <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">báo giá chi tiết</span>
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        Hãy để lại thông tin, đội ngũ WebPro Hub sẽ gợi ý gói <strong>website + hosting</strong> phù hợp với ngân sách, công nghệ và mục tiêu kinh doanh của bạn.
                    </p>
                </div>

                <div class="space-y-6 pt-4">
                    
                    <div class="flex items-start gap-4 group cursor-pointer">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 mb-1">Hotline / Zalo</p>
                            <p class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">0973157932</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 group cursor-pointer">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 mb-1">Email hỗ trợ</p>
                            <p class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">sale@holagroup.com.vn</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 group-hover:bg-gray-800 group-hover:text-white transition-all duration-300">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 mb-1">Địa chỉ văn phòng</p>
                            <p class="text-lg font-medium text-gray-900 leading-snug">
                                119 Đường Lê Bôi, Phường 7, Quận 8, TP. HCM
                            </p>
                        </div>
                    </div>

                </div>

                <div class="flex items-center gap-6 pt-6 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i data-lucide="clock" class="w-4 h-4 text-green-500"></i>
                        Phản hồi trong <strong>15-30 phút</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i>
                        Bảo mật thông tin 100%
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-7/12">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 md:p-10 border border-gray-100 relative">
                    
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Form liên hệ nhanh</h3>
                            <p class="text-gray-500 text-sm mt-1">Điền vài dòng, chúng tôi sẽ gọi lại để tư vấn chi tiết.</p>
                        </div>
                        <span class="hidden md:inline-flex items-center gap-1 bg-gradient-to-r from-orange-500 to-pink-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-lg shadow-orange-500/30 animate-pulse">
                            <i data-lucide="zap" class="w-3 h-3"></i> Ưu tiên hỗ trợ
                        </span>
                    </div>

                    <form action="#" method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" placeholder="VD: Nguyễn Văn A" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300 placeholder-gray-400">
                                    <i data-lucide="user" class="w-5 h-5 text-gray-400 absolute left-3 top-3.5"></i>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Số điện thoại <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="tel" placeholder="Số Zalo/Phone" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300 placeholder-gray-400">
                                    <i data-lucide="phone" class="w-5 h-5 text-gray-400 absolute left-3 top-3.5"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                             <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <div class="relative">
                                    <input type="email" placeholder="example@gmail.com" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300 placeholder-gray-400">
                                    <i data-lucide="mail" class="w-5 h-5 text-gray-400 absolute left-3 top-3.5"></i>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Bạn quan tâm tới <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select class="w-full pl-10 pr-10 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300 appearance-none text-gray-600">
                                        <option>Thiết kế Website trọn gói</option>
                                        <option>Chăm sóc & Quản trị Website</option>
                                        <option>Dịch vụ SEO tổng thể</option>
                                        <option>Khác</option>
                                    </select>
                                    <i data-lucide="layers" class="w-5 h-5 text-gray-400 absolute left-3 top-3.5"></i>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 absolute right-4 top-4"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700">Mô tả nhu cầu của bạn</label>
                            <textarea rows="4" placeholder="VD: Web bán hàng thời trang, cần tích hợp thanh toán online, kết nối Facebook..." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300 placeholder-gray-400 resize-none"></textarea>
                        </div>

                        <button type="submit" class="group w-full bg-gradient-to-r from-orange-500 to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Gửi yêu cầu tư vấn miễn phí</span>
                            <i data-lucide="send" class="w-5 h-5 transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </button>
                        
                        <p class="text-center text-xs text-gray-400 mt-4">
                            Bằng cách gửi form, bạn đồng ý cho HolaGroup liên hệ lại qua điện thoại/Zalo để tư vấn giải pháp phù hợp.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
// 3. Gọi Footer
include 'includes/footer.php';
?>