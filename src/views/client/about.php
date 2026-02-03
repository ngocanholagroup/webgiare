<?php
// Gọi Header
include 'includes/header.php';
?>

<style>
    .text-gradient {
        background: linear-gradient(to right, #f97316, #fbbf24);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-grid-pattern {
        background-image: radial-gradient(#334155 1px, transparent 1px);
        background-size: 24px 24px;
    }
</style>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900">
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-500/20 rounded-full blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
            <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">Về chúng tôi</span>
        </div>
        
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight leading-tight">
            Chúng tôi kiến tạo <br>
            <span class="text-gradient">Tương lai số</span> của bạn
        </h1>
        
        <p class="text-lg md:text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
            HolaGroup không chỉ là một công ty thiết kế website. Chúng tôi là đối tác chiến lược giúp doanh nghiệp chuyển đổi số, tối ưu vận hành và bùng nổ doanh thu trên môi trường Internet.
        </p>
    </div>
</section>

<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2 relative">
                <div class="absolute -inset-4 bg-orange-100 rounded-3xl transform -rotate-2"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <div class="aspect-[4/3] bg-slate-200 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                            <i data-lucide="image" class="w-12 h-12 text-slate-500"></i>
                            <span class="ml-2 text-slate-400 font-medium">Ảnh Team/Văn phòng</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-xl border border-slate-100 max-w-xs hidden md:block">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white">
                            <i data-lucide="trophy" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Top</p>
                            <p class="text-sm font-bold text-slate-900">Các công ty công nghệ 2025</p>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 w-3/4 rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                    Hành trình từ đam mê đến <span class="text-orange-600">vị thế dẫn đầu</span>
                </h2>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p>
                        Được thành lập vào năm 2016, xuất phát điểm từ một nhóm lập trình viên đam mê công nghệ tại TP.HCM. Chúng tôi nhận thấy rào cản lớn nhất của các doanh nghiệp vừa và nhỏ (SMEs) là chi phí chuyển đổi số quá cao và quy trình phức tạp.
                    </p>
                    <p>
                        Với sứ mệnh <strong>"Bình dân hóa công nghệ"</strong>, HolaGroup ra đời để cung cấp các giải pháp website chất lượng cao nhưng với mức chi phí hợp lý nhất.
                    </p>
                    <p>
                        Sau 10 năm, từ một văn phòng nhỏ 20m2, chúng tôi đã phát triển thành đội ngũ hơn 50 chuyên gia, phục vụ 1700+ khách hàng trên toàn quốc và quốc tế.
                    </p>
                </div>
                
                <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 gap-8">
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">10+</div>
                        <div class="text-sm text-slate-500 font-medium">Năm kinh nghiệm</div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">50+</div>
                        <div class="text-sm text-slate-500 font-medium">Nhân sự tài năng</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 right-0 w-96 h-96 bg-orange-200/50 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Tầm nhìn & Sứ mệnh</h2>
            <p class="text-slate-500 text-lg">Kim chỉ nam cho mọi hoạt động và quyết định của chúng tôi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                    <i data-lucide="telescope" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Tầm nhìn</h3>
                <p class="text-slate-500 leading-relaxed">
                    Trở thành đơn vị cung cấp giải pháp Website & Marketing số 1 tại Việt Nam dành cho khối doanh nghiệp SME vào năm 2030.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md border-b-4 border-orange-500 hover:-translate-y-2 transition-transform duration-300 relative z-10 scale-105">
                <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-6 text-orange-600">
                    <i data-lucide="target" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Sứ mệnh</h3>
                <p class="text-slate-500 leading-relaxed">
                    Giúp các doanh nghiệp Việt Nam tiếp cận công nghệ tiên tiến nhất để tối ưu hóa quy trình kinh doanh và gia tăng lợi nhuận bền vững.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center mb-6 text-purple-600">
                    <i data-lucide="heart-handshake" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Giá trị cốt lõi</h3>
                <p class="text-slate-500 leading-relaxed">
                    <strong>Tận tâm</strong> với khách hàng - <strong>Trung thực</strong> trong cam kết - <strong>Sáng tạo</strong> trong giải pháp.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
            <div class="max-w-2xl">
                <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block">Đội ngũ chuyên gia</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Những người kiến tạo</h2>
                <p class="text-slate-500 text-lg">
                    Sự kết hợp giữa kinh nghiệm dày dặn và sức trẻ đầy nhiệt huyết.
                </p>
            </div>
            <a href="/tuyen-dung" class="flex items-center gap-2 font-bold text-orange-600 hover:text-orange-700 transition-colors">
                Gia nhập đội ngũ <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="group">
                <div class="relative overflow-hidden rounded-2xl mb-4 bg-slate-100 aspect-[3/4]">
                    <div class="absolute inset-0 bg-slate-200 flex items-center justify-center text-slate-400">
                        <i data-lucide="user" class="w-12 h-12"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition-colors"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition-colors"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Nguyễn Văn A</h3>
                <p class="text-sm text-orange-500 font-medium">Founder & CEO</p>
            </div>

            <div class="group">
                <div class="relative overflow-hidden rounded-2xl mb-4 bg-slate-100 aspect-[3/4]">
                     <div class="absolute inset-0 bg-slate-200 flex items-center justify-center text-slate-400">
                        <i data-lucide="user" class="w-12 h-12"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition-colors"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Trần Thị B</h3>
                <p class="text-sm text-orange-500 font-medium">Creative Director</p>
            </div>

            <div class="group">
                <div class="relative overflow-hidden rounded-2xl mb-4 bg-slate-100 aspect-[3/4]">
                     <div class="absolute inset-0 bg-slate-200 flex items-center justify-center text-slate-400">
                        <i data-lucide="user" class="w-12 h-12"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition-colors"><i data-lucide="github" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Lê Văn C</h3>
                <p class="text-sm text-orange-500 font-medium">Head of Technology</p>
            </div>

            <div class="group">
                <div class="relative overflow-hidden rounded-2xl mb-4 bg-slate-100 aspect-[3/4]">
                     <div class="absolute inset-0 bg-slate-200 flex items-center justify-center text-slate-400">
                        <i data-lucide="user" class="w-12 h-12"></i>
                    </div>
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition-colors"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Phạm Thị D</h3>
                <p class="text-sm text-orange-500 font-medium">Customer Success Lead</p>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Sẵn sàng để bứt phá?</h2>
        <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">
            Hãy để chúng tôi giúp bạn xây dựng nền tảng vững chắc cho sự phát triển trong tương lai. Tư vấn miễn phí, không ràng buộc.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/lien-he" class="px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-full transition-all transform hover:-translate-y-1 shadow-lg shadow-orange-500/20">
                Liên hệ ngay
            </a>
            <a href="tel:0973157932" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full backdrop-blur-md border border-white/10 transition-all">
                Gọi 0973.157.932
            </a>
        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>