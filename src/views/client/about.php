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

<section class="py-24 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2 relative group">
                <div class="absolute -inset-4 bg-orange-50 rounded-3xl transform -rotate-2 group-hover:rotate-0 transition-transform duration-500"></div>
                
                <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-white border border-slate-100">
                    <div class="aspect-[4/3] w-full relative">
                        <svg class="w-full h-full" viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="800" height="600" fill="#F8FAFC"/>
                            
                            <circle cx="400" cy="300" r="250" fill="#FFF7ED"/>
                            <circle cx="700" cy="100" r="100" fill="#FFEDD5" fill-opacity="0.5"/>
                            <circle cx="100" cy="500" r="80" fill="#DBEAFE" fill-opacity="0.5"/>

                            <rect x="150" y="100" width="500" height="350" rx="12" fill="white" stroke="#E2E8F0" stroke-width="4" class="drop-shadow-xl"/>
                            <path d="M150 112 C150 105.373 155.373 100 162 100 H638 C644.627 100 650 105.373 650 112 V 140 H 150 V 112 Z" fill="#F1F5F9"/>
                            <circle cx="180" cy="120" r="6" fill="#EF4444"/>
                            <circle cx="200" cy="120" r="6" fill="#F59E0B"/>
                            <circle cx="220" cy="120" r="6" fill="#10B981"/>

                            <g transform="translate(200, 180)">
                                <line x1="0" y1="0" x2="0" y2="200" stroke="#E2E8F0" stroke-width="2"/>
                                <line x1="0" y1="200" x2="400" y2="200" stroke="#E2E8F0" stroke-width="2"/>
                                <path d="M0 180 Q 100 150, 200 100 T 400 20 V 200 H 0 Z" fill="url(#chartGradient)" opacity="0.2"/>
                                <path d="M0 180 Q 100 150, 200 100 T 400 20" stroke="#F97316" stroke-width="4" stroke-linecap="round"/>
                                <circle cx="200" cy="100" r="6" fill="white" stroke="#F97316" stroke-width="3"/>
                                <circle cx="400" cy="20" r="8" fill="#F97316"/>
                            </g>

                            <g transform="translate(100, 350)">
                                <rect x="0" y="0" width="160" height="120" rx="10" fill="#334155" class="drop-shadow-lg"/>
                                <text x="20" y="40" font-family="monospace" font-size="12" fill="#22D3EE">&lt;code&gt;</text>
                                <rect x="20" y="55" width="80" height="6" rx="3" fill="#64748B"/>
                                <rect x="20" y="70" width="100" height="6" rx="3" fill="#64748B"/>
                                <rect x="20" y="85" width="60" height="6" rx="3" fill="#F97316"/>
                                <circle cx="80" cy="-30" r="40" fill="#FDBA74"/>
                                <path d="M40 -30 Q 80 20, 120 -30" fill="#1E293B"/> </g>

                             <g transform="translate(550, 380)">
                                <circle cx="50" cy="0" r="40" fill="#FDBA74"/> <path d="M10 -10 Q 50 -60, 90 -10" fill="#B45309"/> <path d="M10 50 Q 50 100, 90 50 L 90 120 H 10 Z" fill="#F97316"/> <rect x="-20" y="40" width="60" height="80" rx="6" fill="#1E293B" transform="rotate(-15)"/>
                            </g>

                            <circle cx="650" cy="250" r="30" fill="white" class="drop-shadow-md"/>
                            <path d="M635 250 L645 260 L665 240" stroke="#10B981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>

                            <defs>
                                <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="200" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F97316"/>
                                    <stop offset="1" stop-color="#F97316" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-6 bg-white p-5 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 max-w-[200px] hidden md:block transform hover:-translate-y-1 transition-transform z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                            <i data-lucide="trophy" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Award</p>
                            <p class="text-xs font-bold text-slate-900">Top SME 2025</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <div class="flex justify-between text-[10px] font-bold">
                            <span class="text-slate-500">Tăng trưởng</span>
                            <span class="text-green-500">+128%</span>
                        </div>
                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 w-full rounded-full animate-[pulse_2s_infinite]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <div class="inline-block px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                    Về HolaGroup
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">
                    Hành trình từ đam mê đến <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">vị thế dẫn đầu</span>
                </h2>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p>
                        Được thành lập vào năm 2016, xuất phát điểm từ một nhóm lập trình viên đam mê công nghệ tại TP.HCM. Chúng tôi nhận thấy rào cản lớn nhất của các doanh nghiệp vừa và nhỏ (SMEs) là chi phí chuyển đổi số quá cao và quy trình phức tạp.
                    </p>
                    <p>
                        Với sứ mệnh <strong>"Bình dân hóa công nghệ"</strong>, HolaGroup ra đời để cung cấp các giải pháp website chất lượng cao nhưng với mức chi phí hợp lý nhất, giúp khách hàng tiếp cận thị trường số dễ dàng.
                    </p>
                    <p>
                        Sau 10 năm, từ một văn phòng nhỏ 20m2, chúng tôi đã phát triển thành đội ngũ hơn 50 chuyên gia, phục vụ 1700+ khách hàng trên toàn quốc và quốc tế.
                    </p>
                </div>
                
                <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 gap-8">
                    <div>
                        <div class="text-4xl font-black text-slate-900 mb-1 tracking-tight">10+</div>
                        <div class="text-sm text-slate-500 font-medium">Năm kinh nghiệm</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-slate-900 mb-1 tracking-tight">50+</div>
                        <div class="text-sm text-slate-500 font-medium">Nhân sự tài năng</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-slate-50 relative overflow-hidden" id="tam-nhin-su-menh">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -right-20 w-96 h-96 bg-orange-200/40 rounded-full blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 -left-20 w-72 h-72 bg-blue-200/30 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                Tầm nhìn & <span class="text-orange-600 border-b-4 border-orange-200">Sứ mệnh</span>
            </h2>
            <p class="text-slate-500 text-lg">Kim chỉ nam cho mọi hoạt động và quyết định của chúng tôi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            
            <div class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full">
                <div class="h-40 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-blue-50 rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-500"></div>
                    <svg class="relative z-10 w-32 h-32 transform group-hover:scale-110 transition-transform duration-500" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="160" cy="50" r="15" fill="#FCD34D" class="animate-pulse"/> <circle cx="40" cy="40" r="4" fill="#93C5FD" fill-opacity="0.5"/>
                        <circle cx="180" cy="100" r="3" fill="#93C5FD" fill-opacity="0.5"/>
                        
                        <path d="M60 160 L90 100" stroke="#3B82F6" stroke-width="6" stroke-linecap="round"/> <path d="M140 160 L110 100" stroke="#3B82F6" stroke-width="6" stroke-linecap="round"/> <path d="M100 100 L100 160" stroke="#3B82F6" stroke-width="6" stroke-linecap="round"/> <rect x="60" y="60" width="100" height="40" rx="5" transform="rotate(-30 110 80)" fill="white" stroke="#1E40AF" stroke-width="4"/>
                        <rect x="55" y="85" width="20" height="45" rx="2" transform="rotate(-30 65 107)" fill="#60A5FA"/>
                        
                        <path d="M125 55 L135 60" stroke="#60A5FA" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-slate-900 mb-3 text-center">Tầm nhìn</h3>
                <p class="text-slate-500 text-sm leading-relaxed text-center">
                    Trở thành đơn vị cung cấp giải pháp Website & Marketing số 1 tại Việt Nam dành cho khối doanh nghiệp SME vào năm 2030.
                </p>
            </div>

            <div class="group bg-white p-8 rounded-3xl shadow-xl border-b-4 border-orange-500 relative z-10 transform md:-translate-y-4 hover:-translate-y-6 transition-all duration-300 h-full">
                <div class="h-40 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-orange-50 rounded-2xl transform -rotate-2 group-hover:-rotate-4 transition-transform duration-500"></div>
                    <svg class="relative z-10 w-32 h-32 transform group-hover:scale-110 transition-transform duration-500" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="70" fill="#FFF7ED" stroke="#FED7AA" stroke-width="2"/>
                        <circle cx="100" cy="100" r="50" fill="white" stroke="#F97316" stroke-width="4"/>
                        <circle cx="100" cy="100" r="30" fill="#F97316" fill-opacity="0.2"/>
                        <circle cx="100" cy="100" r="15" fill="#F97316"/>
                        
                        <path d="M140 60 L105 95" stroke="#9A3412" stroke-width="6" stroke-linecap="round"/>
                        <path d="M150 50 L140 60 L135 55 M150 50 L145 65" stroke="#9A3412" stroke-width="3"/> <path d="M40 140 Q 20 100, 40 60" stroke="#FDBA74" stroke-width="3" stroke-dasharray="8 8"/>
                        <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" stroke-dasharray="4 4" opacity="0.5"/>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-orange-600 mb-3 text-center">Sứ mệnh</h3>
                <p class="text-slate-600 text-base font-medium leading-relaxed text-center">
                    Giúp các doanh nghiệp Việt Nam tiếp cận công nghệ tiên tiến nhất để tối ưu hóa quy trình kinh doanh và gia tăng lợi nhuận bền vững.
                </p>
            </div>

            <div class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full">
                <div class="h-40 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-purple-50 rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-500"></div>
                    <svg class="relative z-10 w-32 h-32 transform group-hover:scale-110 transition-transform duration-500" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 140 C 50 140, 60 180, 100 180 C 140 180, 150 140, 150 140" fill="#F3E8FF" stroke="#9333EA" stroke-width="4" stroke-linecap="round"/>
                        
                        <path d="M100 60 L 125 90 L 100 125 L 75 90 Z" fill="white" stroke="#9333EA" stroke-width="3"/> <path d="M100 75 L 115 90 L 100 110 L 85 90 Z" fill="#9333EA"/> <line x1="100" y1="40" x2="100" y2="20" stroke="#D8B4FE" stroke-width="3" stroke-linecap="round"/>
                        <line x1="140" y1="60" x2="155" y2="50" stroke="#D8B4FE" stroke-width="3" stroke-linecap="round"/>
                        <line x1="60" y1="60" x2="45" y2="50" stroke="#D8B4FE" stroke-width="3" stroke-linecap="round"/>
                        
                        <circle cx="100" cy="100" r="50" stroke="#E9D5FF" stroke-width="1" stroke-dasharray="6 6"/>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-slate-900 mb-3 text-center">Giá trị cốt lõi</h3>
                <p class="text-slate-500 text-sm leading-relaxed text-center">
                    <strong class="text-purple-600">Tận tâm</strong> với khách hàng<br>
                    <strong class="text-purple-600">Trung thực</strong> trong cam kết<br>
                    <strong class="text-purple-600">Sáng tạo</strong> trong giải pháp
                </p>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute right-0 top-0 w-1/3 h-full bg-slate-50 skew-x-12 translate-x-20 z-0"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
            <div class="max-w-2xl">
                <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block">Hiệu quả thực tế</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Con số minh chứng <br><span class="text-orange-500">Năng lực triển khai</span></h2>
                <p class="text-slate-500 text-lg">
                    Chúng tôi không nói về những điều viển vông. Kết quả của khách hàng chính là thước đo chính xác nhất cho chất lượng dịch vụ của HolaGroup.
                </p>
            </div>
            
            <a href="#" class="group flex items-center gap-2 font-bold text-slate-900 hover:text-orange-600 transition-colors">
                Xem hồ sơ năng lực <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-center">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-500">
                        <path d="M20 50 L50 65 L80 50 L50 35 L20 50 Z" fill="#FFEDD5" stroke="#F97316" stroke-width="2"/>
                        <path d="M20 60 L50 75 L80 60" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20 70 L50 85 L80 70" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="50" cy="20" r="3" fill="#F97316" class="animate-bounce"/>
                        <circle cx="85" cy="40" r="2" fill="#F97316" opacity="0.5"/>
                    </svg>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">1,500+</div>
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">Dự án hoàn thành</div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-center">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-500">
                         <circle cx="50" cy="50" r="30" stroke="#E2E8F0" stroke-width="6"/>
                        <circle cx="50" cy="50" r="30" stroke="#F97316" stroke-width="6" stroke-dasharray="180" stroke-dashoffset="10" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                        <path d="M50 58 L45 53 C42 50, 42 46, 45 44 C48 42, 50 44, 50 46 C50 44, 52 42, 55 44 C58 46, 58 50, 55 53 L50 58 Z" fill="#F97316"/>
                        <path d="M20 30 L23 38 L32 38 L25 44 L28 52 L20 46 L12 52 L15 44 L8 38 L17 38 L20 30 Z" fill="#FFD700" transform="scale(0.5)"/>
                    </svg>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">98%</div>
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">Khách hàng hài lòng</div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-center">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-500">
                        <rect x="25" y="30" width="50" height="40" rx="4" fill="#FFF7ED" stroke="#F97316" stroke-width="2"/>
                        <line x1="35" y1="45" x2="65" y2="45" stroke="#FDBA74" stroke-width="2"/>
                        <line x1="35" y1="55" x2="65" y2="55" stroke="#FDBA74" stroke-width="2"/>
                        <circle cx="65" cy="45" r="2" fill="#F97316"/>
                        <circle cx="65" cy="55" r="2" fill="#F97316"/>
                        
                        <path d="M60 20 L50 40 H60 L50 60" fill="#F97316" stroke="white" stroke-width="2"/>
                    </svg>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">99.9%</div>
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">Uptime ổn định</div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-center">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-500">
                        <circle cx="50" cy="50" r="30" stroke="#E2E8F0" stroke-width="2"/>
                        <ellipse cx="50" cy="50" rx="15" ry="30" stroke="#E2E8F0" stroke-width="2" stroke-dasharray="4 4"/>
                        <line x1="20" y1="50" x2="80" y2="50" stroke="#E2E8F0" stroke-width="2" stroke-dasharray="4 4"/>
                        
                        <circle cx="50" cy="50" r="3" fill="#F97316"/>
                        <circle cx="65" cy="40" r="2" fill="#FDBA74"/>
                        <circle cx="35" cy="60" r="2" fill="#FDBA74"/>
                        
                        <path d="M50 50 L65 40 M50 50 L35 60" stroke="#F97316" stroke-width="1"/>
                    </svg>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">12+</div>
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">Quốc gia phục vụ</div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php 
$cta_title = "Sẵn sàng để bứt phá doanh thu?";
$cta_desc = "Hãy để chúng tôi giúp bạn xây dựng nền tảng vững chắc cho sự phát triển trong tương lai. Tư vấn miễn phí, không ràng buộc.";
$cta_note = "Tư vấn miễn phí 100% • Không mua không sao";
include 'includes/cta-section.php'; 
?>

<?php
// Gọi Footer
include 'includes/footer.php';
?>