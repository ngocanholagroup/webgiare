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
    /* Hiệu ứng Grid nền */
    .bg-grid-slate {
        background-image: linear-gradient(to right, #f1f5f9 1px, transparent 1px),
                          linear-gradient(to bottom, #f1f5f9 1px, transparent 1px);
        background-size: 40px 40px;
    }
</style>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 mix-blend-overlay"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 border border-orange-500/20 mb-6 backdrop-blur-md">
            <span class="text-xs font-bold text-orange-400 uppercase tracking-widest">Hệ sinh thái dịch vụ</span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Giải pháp toàn diện cho <br>
            <span class="text-gradient">Doanh nghiệp số</span>
        </h1>
        
        <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10">
            Từ thiết kế website, hạ tầng hosting đến marketing online. Chúng tôi cung cấp mọi thứ bạn cần để vận hành doanh nghiệp trên Internet.
        </p>

        <div class="flex justify-center gap-4">
            <a href="#dich-vu-chinh" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-orange-50 transition-colors flex items-center gap-2">
                Khám phá dịch vụ <i data-lucide="arrow-down" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-24 bg-white relative" id="dich-vu-chinh">
    <div class="absolute inset-0 bg-grid-slate [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="flex flex-col lg:flex-row items-center gap-12 mb-24 group">
            <div class="w-full lg:w-1/2 order-2 lg:order-1">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 aspect-[4/3] group-hover:-translate-y-2 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-orange-100"></div>
                    <div class="absolute top-10 left-10 right-0 bottom-0 bg-white rounded-tl-xl shadow-xl border-l border-t border-slate-200 overflow-hidden">
                        <div class="h-8 bg-slate-50 border-b border-slate-100 flex items-center px-4 gap-2">
                            <div class="w-2 h-2 rounded-full bg-red-400"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex gap-4">
                                <div class="w-1/3 h-32 bg-slate-100 rounded-lg animate-pulse"></div>
                                <div class="w-2/3 space-y-3">
                                    <div class="h-4 bg-slate-100 rounded w-3/4"></div>
                                    <div class="h-4 bg-slate-100 rounded w-1/2"></div>
                                    <div class="h-10 bg-orange-100 rounded w-1/3 mt-4"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-24 bg-slate-50 rounded-lg border border-slate-100"></div>
                                <div class="h-24 bg-slate-50 rounded-lg border border-slate-100"></div>
                                <div class="h-24 bg-slate-50 rounded-lg border border-slate-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 order-1 lg:order-2">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-orange-500/30">
                    <i data-lucide="monitor-smartphone" class="w-7 h-7"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Thiết kế Website Trọn gói</h2>
                <p class="text-slate-500 text-lg leading-relaxed mb-6">
                    Không chỉ đẹp, website của chúng tôi được tối ưu hóa để **bán hàng**. Giao diện chuẩn UX/UI, tương thích mọi thiết bị và tốc độ tải trang dưới 1s.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500"></i> Website Bán hàng / Thương mại điện tử
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500"></i> Website Giới thiệu công ty / Landing Page
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-orange-500"></i> Web App / Hệ thống quản lý (SaaS)
                    </li>
                </ul>
                <a href="/kho-giao-dien" class="text-orange-600 font-bold hover:text-orange-700 inline-flex items-center gap-2 group/link">
                    Xem kho giao diện mẫu <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-12 mb-24 group">
            <div class="w-full lg:w-1/2 order-1">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-600/30">
                    <i data-lucide="bar-chart-2" class="w-7 h-7"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 mb-4">SEO & Marketing Online</h2>
                <p class="text-slate-500 text-lg leading-relaxed mb-6">
                    Website đẹp mà không ai biết đến thì vô nghĩa. Chúng tôi đưa website của bạn lên **Top Google**, tiếp cận đúng khách hàng mục tiêu và gia tăng tỷ lệ chuyển đổi.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-600"></i> Dịch vụ SEO tổng thể (Từ khóa & Traffic)
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-600"></i> Tối ưu Google Maps (Local SEO)
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-600"></i> Viết bài chuẩn SEO & Chăm sóc Fanpage
                    </li>
                </ul>
                <a href="/lien-he" class="text-blue-600 font-bold hover:text-blue-700 inline-flex items-center gap-2 group/link">
                    Nhận kế hoạch SEO miễn phí <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
            <div class="w-full lg:w-1/2 order-2">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 aspect-[4/3] group-hover:-translate-y-2 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-bl from-blue-50 to-indigo-100"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-3/4 h-3/4 bg-white rounded-xl shadow-lg p-6 relative">
                            <div class="absolute top-4 right-4 text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded">+128% Traffic</div>
                            <div class="mt-8 flex items-end gap-2 h-32">
                                <div class="w-1/6 bg-blue-100 rounded-t h-1/3"></div>
                                <div class="w-1/6 bg-blue-200 rounded-t h-1/2"></div>
                                <div class="w-1/6 bg-blue-300 rounded-t h-2/3"></div>
                                <div class="w-1/6 bg-blue-400 rounded-t h-3/4"></div>
                                <div class="w-1/6 bg-blue-500 rounded-t h-5/6"></div>
                                <div class="w-1/6 bg-blue-600 rounded-t h-full relative">
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded">Top 1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-12 group">
            <div class="w-full lg:w-1/2 order-2 lg:order-1">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 aspect-[4/3] group-hover:-translate-y-2 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-tr from-slate-800 to-slate-900"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="w-48 h-64 bg-slate-800 border border-slate-700 rounded-lg shadow-2xl flex flex-col p-4 gap-4">
                                <div class="h-2 bg-slate-700 rounded w-1/3"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-2 bg-green-500/20 rounded w-full flex items-center px-1"><div class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></div></div>
                                    <div class="h-2 bg-green-500/20 rounded w-full flex items-center px-1"><div class="w-1 h-1 bg-green-500 rounded-full animate-pulse delay-75"></div></div>
                                    <div class="h-2 bg-green-500/20 rounded w-full flex items-center px-1"><div class="w-1 h-1 bg-green-500 rounded-full animate-pulse delay-150"></div></div>
                                </div>
                            </div>
                            <div class="absolute -inset-4 bg-orange-500/20 blur-2xl -z-10 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 order-1 lg:order-2">
                <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-purple-600/30">
                    <i data-lucide="server" class="w-7 h-7"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Tên miền & Hosting Cao cấp</h2>
                <p class="text-slate-500 text-lg leading-relaxed mb-6">
                    Hạ tầng mạnh mẽ là nền tảng của một website thành công. Chúng tôi cung cấp Hosting tốc độ cao, ổn định 99.9% và bảo mật tuyệt đối.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600"></i> Đăng ký Tên miền Quốc tế & Việt Nam
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600"></i> Cloud Hosting SSD NVMe siêu tốc
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600"></i> Email Doanh nghiệp theo tên miền
                    </li>
                </ul>
                <a href="/lien-he" class="text-purple-600 font-bold hover:text-purple-700 inline-flex items-center gap-2 group/link">
                    Liên hệ báo giá Hosting <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<section class="py-24 bg-slate-50 border-t border-slate-200" id="dich-vu-bo-tro">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 max-w-2xl mx-auto">
            <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block">Mở rộng tiềm năng</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Hệ sinh thái dịch vụ bổ trợ</h2>
            <p class="text-slate-500">Giải pháp toàn diện giúp doanh nghiệp vận hành trơn tru và phát triển thương hiệu đồng bộ.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-orange-500/5 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-start">
                    <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="transform group-hover:scale-110 transition-transform duration-500">
                        <circle cx="50" cy="50" r="40" fill="#FFF7ED"/>
                        
                        <path d="M30 60 C 20 50, 20 30, 40 25 C 50 20, 70 20, 80 35 C 90 50, 80 70, 60 75 C 50 80, 40 70, 30 60" fill="#FFEDD5" stroke="#F97316" stroke-width="2"/>
                        <circle cx="40" cy="40" r="3" fill="#F97316"/>
                        <circle cx="55" cy="35" r="3" fill="#F97316"/>
                        <circle cx="70" cy="45" r="3" fill="#F97316"/>
                        
                        <path d="M60 60 L 25 90 L 20 80 L 50 45" fill="white" stroke="#EA580C" stroke-width="2"/>
                        <path d="M50 45 L 65 30 C 70 25, 75 30, 70 35 L 55 50" fill="#F97316"/>
                        
                        <path d="M25 90 C 15 95, 10 80, 15 75" stroke="#FDBA74" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">Thiết kế Logo & Branding</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Xây dựng bộ nhận diện thương hiệu chuyên nghiệp (Logo, Card, Banner...), tạo ấn tượng thị giác mạnh mẽ ngay từ cái nhìn đầu tiên.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-start">
                    <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="transform group-hover:rotate-6 transition-transform duration-500">
                        <circle cx="50" cy="50" r="40" fill="#EFF6FF"/>
                        
                        <circle cx="50" cy="50" r="15" stroke="#3B82F6" stroke-width="8" stroke-dasharray="10 4"/>
                        <circle cx="50" cy="50" r="8" fill="#DBEAFE"/>
                        
                        <path d="M35 65 L 25 75 C 20 80, 25 85, 30 80 L 40 70" stroke="#2563EB" stroke-width="6" stroke-linecap="round"/>
                        <path d="M60 40 L 40 60" stroke="#60A5FA" stroke-width="6" stroke-linecap="round"/>
                        
                        <path d="M70 20 C 70 20, 80 25, 80 35 C 80 50, 70 60, 70 60 C 70 60, 60 50, 60 35 C 60 25, 70 20, 70 20 Z" fill="#3B82F6" stroke="white" stroke-width="2"/>
                        <path d="M68 35 L 72 40 L 76 30" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">Chăm sóc & Bảo trì Web</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Dịch vụ "Bảo hiểm" cho website: Cập nhật nội dung, vá lỗi bảo mật, backup dữ liệu định kỳ giúp website luôn an toàn và tươi mới.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-green-500/5 hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-start">
                    <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="transform group-hover:scale-105 transition-transform duration-500">
                        <circle cx="50" cy="50" r="40" fill="#F0FDF4"/>
                        
                        <rect x="20" y="25" width="60" height="45" rx="4" fill="white" stroke="#16A34A" stroke-width="2"/>
                        <rect x="20" y="25" width="60" height="10" rx="4" fill="#DCFCE7"/>
                        <circle cx="28" cy="30" r="2" fill="#16A34A"/>
                        <circle cx="34" cy="30" r="2" fill="#16A34A" opacity="0.5"/>
                        
                        <rect x="28" y="45" width="20" height="4" rx="2" fill="#86EFAC"/>
                        <rect x="28" y="55" width="30" height="4" rx="2" fill="#BBF7D0"/>
                        <rect x="28" y="65" width="15" height="4" rx="2" fill="#BBF7D0"/>
                        
                        <path d="M65 60 H 75 V 70 H 65 V 60 Z" fill="#16A34A" class="drop-shadow-md"/>
                        <circle cx="70" cy="60" r="3" fill="#16A34A"/> <circle cx="75" cy="65" r="3" fill="#16A34A"/> </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-green-600 transition-colors">Gia công phần mềm</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Lập trình các tính năng đặc thù (CRM, HRM...), tích hợp API, cổng thanh toán hoặc viết tool tự động hóa theo yêu cầu riêng.</p>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-white border-t border-slate-100 overflow-hidden">
    <div class="container mx-auto px-4 text-center mb-12">
        <p class="text-sm font-bold text-orange-500 uppercase tracking-widest mb-2">Nền tảng kỹ thuật</p>
        <h3 class="text-2xl font-bold text-slate-900">Công nghệ tối ưu & Tiên tiến</h3>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 max-w-5xl mx-auto">

        <div class="group flex flex-col items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors duration-300">
            <div class="w-16 h-16 relative flex items-center justify-center">
                <svg class="w-full h-full text-slate-300 group-hover:text-orange-500 transition-colors duration-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="12" y="12" width="40" height="40" rx="4" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 20H8 M12 32H8 M12 44H8 M52 20H56 M52 32H56 M52 44H56 M20 12V8 M32 12V8 M44 12V8 M20 52V56 M32 52V56 M44 52V56" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <rect x="22" y="22" width="20" height="20" rx="2" fill="currentColor" opacity="0.1"/>
                    <path d="M32 22V42 M22 32H42" stroke="currentColor" stroke-width="1.5"/>
                    <circle cx="32" cy="32" r="3" fill="currentColor"/>
                </svg>
            </div>
            <div class="text-center">
                <h4 class="text-sm font-bold text-slate-700 group-hover:text-slate-900">High Performance Core</h4>
                <p class="text-[10px] text-slate-400 mt-1">Xử lý nhanh & ổn định</p>
            </div>
        </div>

        <div class="group flex flex-col items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors duration-300">
            <div class="w-16 h-16 relative flex items-center justify-center">
                <svg class="w-full h-full text-slate-300 group-hover:text-blue-500 transition-colors duration-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="14" width="44" height="36" rx="3" stroke="currentColor" stroke-width="2"/>
                    <path d="M26 56H38 M32 50V56" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <rect x="16" y="22" width="14" height="20" rx="1" fill="currentColor" opacity="0.2"/>
                    <rect x="34" y="22" width="14" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                    <rect x="34" y="30" width="10" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                    <rect x="40" y="38" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.5" fill="white" class="group-hover:-translate-y-1 transition-transform duration-500"/>
                </svg>
            </div>
            <div class="text-center">
                <h4 class="text-sm font-bold text-slate-700 group-hover:text-slate-900">Modern UI/UX</h4>
                <p class="text-[10px] text-slate-400 mt-1">Giao diện tương tác cao</p>
            </div>
        </div>

        <div class="group flex flex-col items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors duration-300">
            <div class="w-16 h-16 relative flex items-center justify-center">
                <svg class="w-full h-full text-slate-300 group-hover:text-green-500 transition-colors duration-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 44C16 48.4183 23.1634 52 32 52C40.8366 52 48 48.4183 48 44V36C48 40.4183 40.8366 44 32 44C23.1634 44 16 40.4183 16 36V44Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 36C16 40.4183 23.1634 44 32 44C40.8366 44 48 40.4183 48 36V28C48 32.4183 40.8366 36 32 36C23.1634 36 16 32.4183 16 28V36Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <ellipse cx="32" cy="20" rx="16" ry="8" stroke="currentColor" stroke-width="2"/>
                    <path d="M16 20V28" stroke="currentColor" stroke-width="2"/>
                    <path d="M48 20V28" stroke="currentColor" stroke-width="2"/>
                    <path d="M40 40 L44 44 L52 36" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-hover:opacity-100 transition-opacity"/>
                </svg>
            </div>
            <div class="text-center">
                <h4 class="text-sm font-bold text-slate-700 group-hover:text-slate-900">Secure Data</h4>
                <p class="text-[10px] text-slate-400 mt-1">Bảo mật & Backup định kỳ</p>
            </div>
        </div>

        <div class="group flex flex-col items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors duration-300">
            <div class="w-16 h-16 relative flex items-center justify-center">
                <svg class="w-full h-full text-slate-300 group-hover:text-purple-500 transition-colors duration-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M46 44C52.6274 44 58 38.6274 58 32C58 25.3726 52.6274 20 46 20C45.3976 20 44.8081 20.0409 44.2343 20.1205C42.8423 13.7846 37.2435 9 30.5 9C22.4919 9 16 15.4919 16 23.5C16 24.3164 16.0673 25.1147 16.1969 25.892C11.5367 27.2396 8 31.5458 8 36.5C8 42.299 12.701 47 18.5 47H32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="20" cy="36" r="2" fill="currentColor"/>
                    <circle cx="32" cy="28" r="2" fill="currentColor"/>
                    <circle cx="48" cy="32" r="2" fill="currentColor"/>
                    <path d="M38 42L42 38L38 34" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42 38H32" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="text-center">
                <h4 class="text-sm font-bold text-slate-700 group-hover:text-slate-900">Cloud Architecture</h4>
                <p class="text-[10px] text-slate-400 mt-1">Linh hoạt & Mở rộng</p>
            </div>
        </div>

    </div>
</section>

<?php 
$cta_title = "Bạn chưa biết nên bắt đầu từ đâu?";
$cta_desc = "Đừng lo lắng, hãy để chuyên gia của chúng tôi tư vấn giải pháp phù hợp nhất với ngân sách và mục tiêu của bạn.";
$cta_note = "Tư vấn miễn phí 1:1 • Hoàn toàn không phát sinh chi phí";
include 'includes/cta-section.php'; 
?>

<?php
// Gọi Footer
include 'includes/footer.php';
?>