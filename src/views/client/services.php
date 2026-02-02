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
                <a href="#" class="text-blue-600 font-bold hover:text-blue-700 inline-flex items-center gap-2 group/link">
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
                <a href="#" class="text-purple-600 font-bold hover:text-purple-700 inline-flex items-center gap-2 group/link">
                    Xem bảng giá Hosting <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Dịch vụ bổ trợ</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 mb-4 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i data-lucide="pen-tool" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Thiết kế Logo & Branding</h3>
                <p class="text-sm text-slate-500">Xây dựng bộ nhận diện thương hiệu chuyên nghiệp, ấn tượng ngay từ cái nhìn đầu tiên.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <i data-lucide="settings" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Chăm sóc & Bảo trì Web</h3>
                <p class="text-sm text-slate-500">Cập nhật nội dung, vá lỗi bảo mật, backup dữ liệu định kỳ giúp website luôn tươi mới.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <i data-lucide="code-2" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gia công phần mềm</h3>
                <p class="text-sm text-slate-500">Lập trình các tính năng đặc thù, tích hợp API, cổng thanh toán theo yêu cầu riêng.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white overflow-hidden">
    <div class="container mx-auto px-4 text-center mb-8">
        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Công nghệ chúng tôi sử dụng</p>
    </div>
    <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all">
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="codepen" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">PHP 8</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="database" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">MySQL</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="layout" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">Tailwind</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="server" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">Docker</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="box" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">Laravel</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="globe" class="w-10 h-10 text-slate-800"></i>
            <span class="text-xs font-bold text-slate-600">ReactJS</span>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Bạn chưa biết nên bắt đầu từ đâu?</h2>
        <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">
            Đừng lo lắng, hãy để chuyên gia của chúng tôi tư vấn giải pháp phù hợp nhất với ngân sách và mục tiêu của bạn.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="tel:0973157932" class="px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-full transition-all shadow-lg shadow-orange-600/30 flex items-center justify-center gap-2">
                <i data-lucide="phone" class="w-5 h-5"></i> Tư vấn miễn phí 1:1
            </a>
            <a href="/lien-he" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full backdrop-blur-md border border-white/10 transition-all flex items-center justify-center gap-2">
                <i data-lucide="mail" class="w-5 h-5"></i> Gửi yêu cầu báo giá
            </a>
        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>