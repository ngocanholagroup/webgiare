<?php
require_once 'config/database.php';
$pageTitle = "Dịch vụ Website & Marketing Online - HolaGroup";
include 'includes/header.php';
?>

<section class="relative pt-32 pb-20 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-overlay filter blur-[120px] opacity-20 animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500 rounded-full mix-blend-overlay filter blur-[120px] opacity-20 animate-pulse animation-delay-2000"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
            Giải pháp số <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Toàn diện</span>
        </h1>
        <p class="text-slate-400 text-lg max-w-3xl mx-auto leading-relaxed">
            Không chỉ thiết kế Website, chúng tôi cung cấp hệ sinh thái các dịch vụ đi kèm giúp doanh nghiệp của bạn vận hành trơn tru và tăng trưởng bền vững trên Internet.
        </p>
    </div>
</section>

<section class="py-20 bg-white border-b border-gray-100" id="seo">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2 order-2 lg:order-1">
                <div class="relative bg-blue-50 rounded-[3rem] p-8 md:p-12">
                    <div class="bg-white rounded-2xl shadow-xl p-6 relative z-10">
                        <div class="flex items-end justify-between gap-2 h-32 mb-4">
                            <div class="w-full bg-blue-100 rounded-t-lg h-[40%]"></div>
                            <div class="w-full bg-blue-200 rounded-t-lg h-[60%]"></div>
                            <div class="w-full bg-blue-300 rounded-t-lg h-[50%]"></div>
                            <div class="w-full bg-blue-400 rounded-t-lg h-[80%]"></div>
                            <div class="w-full bg-blue-600 rounded-t-lg h-[100%] relative group">
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">Top 1</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i data-lucide="trending-up" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Tăng trưởng Traffic</p>
                                <p class="text-xs text-gray-500">+150% lượt truy cập tự nhiên</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-5 -left-5 w-20 h-20 bg-orange-400 rounded-full mix-blend-multiply filter blur-xl opacity-50"></div>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 order-1 lg:order-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-4">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i> Dịch vụ SEO
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Đưa Website lên Top 1 Google bền vững</h2>
                <p class="text-gray-500 text-lg mb-8 leading-relaxed">
                    Website đẹp mà không ai tìm thấy thì cũng như cửa hàng nằm trong ngõ cụt. Dịch vụ SEO của HolaGroup giúp từ khóa lên Top an toàn, tiếp cận đúng khách hàng đang có nhu cầu.
                </p>
                
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0 mt-0.5"><i data-lucide="check" class="w-3.5 h-3.5"></i></div>
                        <span class="text-gray-700"><strong>SEO Tổng thể:</strong> Phủ sóng hàng trăm từ khóa ngành.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0 mt-0.5"><i data-lucide="check" class="w-3.5 h-3.5"></i></div>
                        <span class="text-gray-700"><strong>SEO Audit:</strong> Tối ưu kỹ thuật On-page chuẩn Google.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0 mt-0.5"><i data-lucide="check" class="w-3.5 h-3.5"></i></div>
                        <span class="text-gray-700"><strong>Content Marketing:</strong> Viết bài chuẩn SEO, thu hút người đọc.</span>
                    </li>
                </ul>

                <div class="mt-8">
                    <a href="contact.php" class="text-blue-600 font-bold hover:underline inline-flex items-center gap-2">
                        Nhận kế hoạch SEO miễn phí <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50 border-b border-gray-200" id="care">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wider mb-4">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Bảo trì & Chăm sóc
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Chăm sóc Website chuyên nghiệp</h2>
                <p class="text-gray-500 text-lg mb-8 leading-relaxed">
                    Bạn quá bận rộn để viết bài? Web bị lỗi mà không biết gọi ai? Hãy để chúng tôi trở thành "quản gia" cho ngôi nhà số của bạn.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <i data-lucide="file-edit" class="w-8 h-8 text-orange-500 mb-3"></i>
                        <h4 class="font-bold text-gray-900">Cập nhật nội dung</h4>
                        <p class="text-sm text-gray-500 mt-1">Đăng bài viết, sản phẩm, hình ảnh mới định kỳ.</p>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <i data-lucide="bug" class="w-8 h-8 text-red-500 mb-3"></i>
                        <h4 class="font-bold text-gray-900">Xử lý sự cố</h4>
                        <p class="text-sm text-gray-500 mt-1">Quét virus, fix lỗi code, backup dữ liệu hàng tuần.</p>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <i data-lucide="image" class="w-8 h-8 text-purple-500 mb-3"></i>
                        <h4 class="font-bold text-gray-900">Thiết kế Banner</h4>
                        <p class="text-sm text-gray-500 mt-1">Làm banner quảng cáo, popup khuyến mãi ngày lễ.</p>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <i data-lucide="activity" class="w-8 h-8 text-blue-500 mb-3"></i>
                        <h4 class="font-bold text-gray-900">Báo cáo chỉ số</h4>
                        <p class="text-sm text-gray-500 mt-1">Gửi báo cáo traffic, hiệu quả website hàng tháng.</p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <div class="relative bg-green-50 rounded-[3rem] p-8 md:p-12">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-2xl shadow-lg p-4 animate-bounce hover:pause">
                            <div class="w-8 h-8 rounded-full bg-red-100 mb-2"></div>
                            <div class="h-2 w-16 bg-gray-200 rounded mb-1"></div>
                            <div class="h-2 w-10 bg-gray-200 rounded"></div>
                        </div>
                        <div class="bg-white rounded-2xl shadow-lg p-4 translate-y-8">
                             <div class="w-8 h-8 rounded-full bg-blue-100 mb-2"></div>
                            <div class="h-2 w-16 bg-gray-200 rounded mb-1"></div>
                            <div class="h-2 w-10 bg-gray-200 rounded"></div>
                        </div>
                        <div class="bg-white rounded-2xl shadow-lg p-4 -translate-y-4">
                             <div class="w-8 h-8 rounded-full bg-yellow-100 mb-2"></div>
                            <div class="h-2 w-16 bg-gray-200 rounded mb-1"></div>
                            <div class="h-2 w-10 bg-gray-200 rounded"></div>
                        </div>
                        <div class="bg-white rounded-2xl shadow-lg p-4 translate-y-4">
                             <div class="w-8 h-8 rounded-full bg-purple-100 mb-2"></div>
                            <div class="h-2 w-16 bg-gray-200 rounded mb-1"></div>
                            <div class="h-2 w-10 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                     <div class="absolute -bottom-5 -right-5 w-24 h-24 bg-green-400 rounded-full mix-blend-multiply filter blur-xl opacity-50"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white" id="hosting">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold uppercase tracking-wider mb-4">
                <i data-lucide="server" class="w-3.5 h-3.5"></i> Cloud Hosting
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Hosting tốc độ cao NVMe</h2>
            <p class="text-gray-500">
                Server đặt tại Việt Nam, sử dụng ổ cứng NVMe Enterprise giúp website tải nhanh gấp 10 lần so với hosting thường.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
            
            <div class="border border-gray-200 rounded-3xl p-8 hover:shadow-xl transition-all hover:border-purple-300 group">
                <h3 class="text-lg font-bold text-gray-500 mb-2">Cơ bản</h3>
                <div class="flex items-baseline gap-1 mb-6">
                    <span class="text-4xl font-bold text-gray-900">99k</span>
                    <span class="text-gray-400">/tháng</span>
                </div>
                <ul class="space-y-4 mb-8 text-sm text-gray-600">
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> <strong>2GB</strong> SSD NVMe</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> <strong>01</strong> Website</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> Băng thông không giới hạn</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> Miễn phí SSL</li>
                </ul>
                <a href="contact.php" class="block w-full py-3 rounded-xl border border-gray-200 text-center font-bold text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:border-purple-200 transition-all">Đăng ký ngay</a>
            </div>

            <div class="border-2 border-purple-500 rounded-3xl p-8 shadow-2xl relative overflow-hidden transform md:-translate-y-4 bg-white z-10">
                <div class="absolute top-0 right-0 bg-purple-500 text-white text-xs font-bold px-3 py-1 rounded-bl-xl uppercase">Khuyên dùng</div>
                <h3 class="text-lg font-bold text-purple-600 mb-2">Tiêu chuẩn</h3>
                <div class="flex items-baseline gap-1 mb-6">
                    <span class="text-5xl font-extrabold text-gray-900">199k</span>
                    <span class="text-gray-400">/tháng</span>
                </div>
                <ul class="space-y-4 mb-8 text-sm text-gray-700 font-medium">
                    <li class="flex gap-3"><div class="bg-purple-100 p-0.5 rounded-full"><i data-lucide="check" class="w-4 h-4 text-purple-600"></i></div> <strong>5GB</strong> SSD NVMe</li>
                    <li class="flex gap-3"><div class="bg-purple-100 p-0.5 rounded-full"><i data-lucide="check" class="w-4 h-4 text-purple-600"></i></div> <strong>03</strong> Website</li>
                    <li class="flex gap-3"><div class="bg-purple-100 p-0.5 rounded-full"><i data-lucide="check" class="w-4 h-4 text-purple-600"></i></div> <strong>Free</strong> Backup hàng ngày</li>
                    <li class="flex gap-3"><div class="bg-purple-100 p-0.5 rounded-full"><i data-lucide="check" class="w-4 h-4 text-purple-600"></i></div> Tăng tốc LiteSpeed</li>
                </ul>
                <a href="contact.php" class="block w-full py-4 rounded-xl bg-purple-600 text-center font-bold text-white shadow-lg shadow-purple-500/30 hover:bg-purple-700 transition-all">Đăng ký ngay</a>
            </div>

            <div class="border border-gray-200 rounded-3xl p-8 hover:shadow-xl transition-all hover:border-purple-300 group">
                <h3 class="text-lg font-bold text-gray-500 mb-2">Doanh nghiệp</h3>
                <div class="flex items-baseline gap-1 mb-6">
                    <span class="text-4xl font-bold text-gray-900">399k</span>
                    <span class="text-gray-400">/tháng</span>
                </div>
                <ul class="space-y-4 mb-8 text-sm text-gray-600">
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> <strong>15GB</strong> SSD NVMe</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> <strong>10</strong> Website</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> IP Riêng (Dedicated IP)</li>
                    <li class="flex gap-3"><i data-lucide="check" class="w-5 h-5 text-purple-500"></i> Ưu tiên hỗ trợ 24/7</li>
                </ul>
                <a href="contact.php" class="block w-full py-3 rounded-xl border border-gray-200 text-center font-bold text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:border-purple-200 transition-all">Đăng ký ngay</a>
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-slate-900 text-white text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-6">Bạn chưa biết gói nào phù hợp?</h2>
        <p class="text-slate-400 mb-8 max-w-2xl mx-auto">
            Đừng ngần ngại liên hệ với đội ngũ kỹ thuật của chúng tôi. Chúng tôi sẽ phân tích nhu cầu và tư vấn giải pháp tiết kiệm nhất cho bạn.
        </p>
        <div class="flex justify-center gap-4">
            <a href="tel:0973157932" class="bg-orange-500 hover:bg-orange-600 px-8 py-3 rounded-full font-bold transition-colors">Gọi tư vấn</a>
            <a href="https://zalo.me/0973157932" class="bg-white text-slate-900 hover:bg-gray-100 px-8 py-3 rounded-full font-bold transition-colors">Chat Zalo</a>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>