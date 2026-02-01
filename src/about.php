<?php
require_once 'config/database.php';
$pageTitle = "Về chúng tôi - Câu chuyện HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-20 overflow-hidden bg-white">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-100/40 rounded-full blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-widest mb-4">
                Since 2020
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Chúng tôi kiến tạo <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">Trải nghiệm số khác biệt</span>
            </h1>
            <p class="text-xl text-gray-500 font-light leading-relaxed">
                HolaGroup không chỉ là một công ty lập trình. Chúng tôi là những người kể chuyện bằng công nghệ, biến những dòng code khô khan thành công cụ kinh doanh đắc lực cho doanh nghiệp của bạn.
            </p>
        </div>

        <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[21/9] bg-gray-200 group">
            <div class="absolute inset-0 bg-slate-900/20 group-hover:bg-slate-900/10 transition-colors"></div>
            <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                <div class="text-center">
                    <i data-lucide="users" class="w-20 h-20 text-white/20 mx-auto mb-4"></i>
                    <span class="text-white/40 font-medium">Hình ảnh đội ngũ HolaGroup</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold mb-4 flex items-center gap-3">
                        <i data-lucide="target" class="w-8 h-8 text-orange-500"></i>
                        Tầm nhìn
                    </h2>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        Trở thành đơn vị cung cấp giải pháp Website & Chuyển đổi số tin cậy nhất cho các doanh nghiệp vừa và nhỏ (SMEs) tại Việt Nam vào năm 2030.
                    </p>
                </div>
                <div class="w-full h-px bg-slate-800"></div>
                <div>
                    <h2 class="text-3xl font-bold mb-4 flex items-center gap-3">
                        <i data-lucide="flag" class="w-8 h-8 text-blue-500"></i>
                        Sứ mệnh
                    </h2>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        Đơn giản hóa công nghệ. Chúng tôi tin rằng mọi doanh nghiệp đều xứng đáng sở hữu một website chuyên nghiệp mà không cần phải am hiểu sâu về kỹ thuật hay tốn kém chi phí khổng lồ.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-orange-500 transition-colors">
                    <div class="text-4xl font-extrabold text-white mb-2">5+</div>
                    <div class="text-sm text-slate-400 uppercase tracking-wider">Năm hình thành</div>
                </div>
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition-colors">
                    <div class="text-4xl font-extrabold text-white mb-2">1.2k</div>
                    <div class="text-sm text-slate-400 uppercase tracking-wider">Dự án hoàn thành</div>
                </div>
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-green-500 transition-colors">
                    <div class="text-4xl font-extrabold text-white mb-2">20+</div>
                    <div class="text-sm text-slate-400 uppercase tracking-wider">Nhân sự tài năng</div>
                </div>
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-purple-500 transition-colors">
                    <div class="text-4xl font-extrabold text-white mb-2">24/7</div>
                    <div class="text-sm text-slate-400 uppercase tracking-wider">Hỗ trợ kỹ thuật</div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Giá trị cốt lõi</h2>
            <div class="w-20 h-1 bg-orange-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group p-8 bg-gray-50 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform text-orange-500">
                    <i data-lucide="heart-handshake" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Tận tâm với khách hàng</h3>
                <p class="text-gray-500 leading-relaxed">
                    Chúng tôi coi sản phẩm của khách hàng như sản phẩm của chính mình. Sự hài lòng của bạn là thước đo thành công duy nhất.
                </p>
            </div>
             <div class="group p-8 bg-gray-50 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform text-blue-500">
                    <i data-lucide="lightbulb" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Đổi mới sáng tạo</h3>
                <p class="text-gray-500 leading-relaxed">
                    Không ngừng cập nhật những công nghệ mới nhất (AI, Cloud, Big Data) để mang lại giải pháp tối ưu và hiện đại nhất.
                </p>
            </div>
             <div class="group p-8 bg-gray-50 rounded-3xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform text-green-500">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Uy tín & Trách nhiệm</h3>
                <p class="text-gray-500 leading-relaxed">
                    Nói đi đôi với làm. Cam kết đúng tiến độ, bảo hành trọn đời và minh bạch trong mọi chi phí.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-gray-400 uppercase tracking-widest mb-12">Công nghệ chúng tôi sử dụng</h2>
        
        <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20 opacity-70">
            <div class="group flex flex-col items-center gap-2 hover:opacity-100 transition-opacity cursor-pointer">
                <i data-lucide="file-code-2" class="w-12 h-12 text-slate-600 group-hover:text-[#777BB4] transition-colors"></i>
                <span class="font-bold text-slate-600 group-hover:text-[#777BB4]">PHP</span>
            </div>
            <div class="group flex flex-col items-center gap-2 hover:opacity-100 transition-opacity cursor-pointer">
                <i data-lucide="codepen" class="w-12 h-12 text-slate-600 group-hover:text-[#61DAFB] transition-colors"></i>
                <span class="font-bold text-slate-600 group-hover:text-[#61DAFB]">ReactJS</span>
            </div>
            <div class="group flex flex-col items-center gap-2 hover:opacity-100 transition-opacity cursor-pointer">
                <i data-lucide="database" class="w-12 h-12 text-slate-600 group-hover:text-[#4479A1] transition-colors"></i>
                <span class="font-bold text-slate-600 group-hover:text-[#4479A1]">MySQL</span>
            </div>
            <div class="group flex flex-col items-center gap-2 hover:opacity-100 transition-opacity cursor-pointer">
                <i data-lucide="server" class="w-12 h-12 text-slate-600 group-hover:text-[#F29111] transition-colors"></i>
                <span class="font-bold text-slate-600 group-hover:text-[#F29111]">AWS</span>
            </div>
            <div class="group flex flex-col items-center gap-2 hover:opacity-100 transition-opacity cursor-pointer">
                <i data-lucide="layout" class="w-12 h-12 text-slate-600 group-hover:text-[#38B2AC] transition-colors"></i>
                <span class="font-bold text-slate-600 group-hover:text-[#38B2AC]">Tailwind</span>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-orange-400 to-pink-500 rounded-3xl p-10 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Bạn muốn gia nhập đội ngũ HolaGroup?</h2>
                <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
                    Chúng tôi luôn tìm kiếm những tài năng đam mê công nghệ để cùng nhau tạo nên những sản phẩm tuyệt vời.
                </p>
                <a href="#" class="inline-flex items-center gap-2 bg-white text-orange-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 hover:scale-105 transition-all shadow-lg">
                    Xem vị trí tuyển dụng <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>