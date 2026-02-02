<?php
// Gọi Header
include 'includes/header.php';

// Kiểm tra nếu có tham số template từ trang chi tiết truyền sang
$selected_template = isset($_GET['template']) ? $_GET['template'] : '';
?>

<style>
    .text-gradient {
        background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    /* Bản đồ Grayscale cho đồng bộ (Optional) */
    iframe { filter: grayscale(100%) invert(0%); transition: filter 0.3s; }
    iframe:hover { filter: none; }
</style>

<section class="relative pt-32 pb-48 lg:pt-48 lg:pb-64 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">Hỗ trợ 24/7</span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Hãy để chúng tôi <br>
            <span class="text-gradient">Lắng nghe bạn</span>
        </h1>
        
        <p class="text-lg text-slate-400 max-w-2xl mx-auto">
            Dù bạn đang có ý tưởng khởi nghiệp hay muốn nâng cấp hệ thống hiện tại. Đội ngũ chuyên gia của HolaGroup luôn sẵn sàng tư vấn giải pháp tối ưu nhất.
        </p>
    </div>
</section>

<section class="relative -mt-32 pb-24 z-20">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-900/10 border border-slate-100 overflow-hidden flex flex-col lg:flex-row">
            
            <div class="w-full lg:w-2/5 bg-slate-900 p-8 md:p-12 text-white relative overflow-hidden">
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-orange-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                
                <h2 class="text-2xl font-bold mb-6">Thông tin liên hệ</h2>
                <p class="text-slate-400 mb-12 leading-relaxed">
                    Đừng ngần ngại liên hệ. Chúng tôi phản hồi tin nhắn trong vòng 15 phút (Giờ hành chính).
                </p>

                <div class="space-y-8 relative z-10">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Văn phòng</h4>
                            <p class="text-slate-400 text-sm mt-1">119 Đường Lê Bôi, Phường 7, Quận 8, TP. HCM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Hotline / Zalo</h4>
                            <p class="text-slate-400 text-sm mt-1">0973.157.932</p>
                            <p class="text-xs text-slate-500 mt-1">(Hỗ trợ: 8:00 - 22:00)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Email</h4>
                            <p class="text-slate-400 text-sm mt-1">sale@holagroup.com.vn</p>
                            <p class="text-slate-400 text-sm">support@holagroup.com.vn</p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-white/10">
                    <p class="text-sm text-slate-400 mb-4">Kết nối với chúng tôi:</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 flex items-center justify-center transition-all"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 flex items-center justify-center transition-all"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 flex items-center justify-center transition-all"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/5 p-8 md:p-12 bg-white">
                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Họ và tên <span class="text-red-500">*</span></label>
                            <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="tel" placeholder="09xx xxx xxx" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Email (Nếu có)</label>
                        <input type="email" placeholder="example@gmail.com" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Dịch vụ quan tâm</label>
                        <div class="relative">
                            <select class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all appearance-none text-slate-600">
                                <option value="website" <?= empty($selected_template) ? 'selected' : '' ?>>Thiết kế Website trọn gói</option>
                                <option value="template" <?= !empty($selected_template) ? 'selected' : '' ?>>Mua giao diện mẫu <?= !empty($selected_template) ? "($selected_template)" : "" ?></option>
                                <option value="seo">Dịch vụ SEO / Marketing</option>
                                <option value="custom">Lập trình theo yêu cầu</option>
                                <option value="support">Hỗ trợ kỹ thuật</option>
                            </select>
                            <i data-lucide="chevron-down" class="absolute right-4 top-3.5 w-5 h-5 text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Nội dung chi tiết</label>
                        <textarea rows="4" placeholder="Mô tả sơ qua về nhu cầu của bạn..." class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                        <span>Gửi yêu cầu tư vấn</span>
                        <i data-lucide="send" class="w-5 h-5"></i>
                    </button>

                    <p class="text-center text-xs text-slate-400 mt-4">
                        Chúng tôi cam kết bảo mật thông tin cá nhân của bạn theo <a href="/chinh-sach" class="text-orange-500 hover:underline">Chính sách bảo mật</a>.
                    </p>
                </form>
            </div>

        </div>
    </div>
</section>

<section class="h-96 w-full relative z-10 bg-slate-100">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.669726937899!2d106.66017231474885!3d10.762622292330721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ee50700130d%3A0x6334651336423985!2zMTE5IEzDqiBCw7RpLCBQaMaw4budbmcgNywgUXXhuq1uIDgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1644312345678!5m2!1sen!2s" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    
    <div class="hidden md:block absolute top-10 left-10 bg-white p-6 rounded-2xl shadow-2xl max-w-xs">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold">H</div>
            <span class="font-bold text-slate-900">HolaGroup Office</span>
        </div>
        <p class="text-sm text-slate-500 mb-4">Mời bạn ghé thăm văn phòng để trao đổi trực tiếp.</p>
        <a href="https://goo.gl/maps/xyz" target="_blank" class="text-xs font-bold text-orange-600 flex items-center gap-1 hover:underline">
            Xem chỉ đường <i data-lucide="external-link" class="w-3 h-3"></i>
        </a>
    </div>
</section>

<section class="py-24 bg-slate-50">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Câu hỏi thường gặp</h2>
            <p class="text-slate-500">Giải đáp nhanh những thắc mắc trước khi bạn liên hệ.</p>
        </div>

        <div class="space-y-4">
            <details class="group bg-white rounded-xl shadow-sm border border-slate-200 open:border-orange-300 open:ring-1 open:ring-orange-100 transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-slate-800 marker:content-none hover:text-orange-600">
                    Quy trình thanh toán như thế nào?
                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                    Chúng tôi chia làm 2 đợt thanh toán: <strong>Đợt 1 (50%)</strong> tạm ứng sau khi ký hợp đồng để triển khai dự án. <strong>Đợt 2 (50%)</strong> thanh toán sau khi nghiệm thu và bàn giao website.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-slate-200 open:border-orange-300 open:ring-1 open:ring-orange-100 transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-slate-800 marker:content-none hover:text-orange-600">
                    Tôi ở tỉnh xa thì làm việc thế nào?
                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                    Hoàn toàn được. Chúng tôi làm việc Online qua Zalo/Google Meet/Ultraviewer. Hợp đồng và hóa đơn sẽ được gửi chuyển phát nhanh đến tận tay bạn. Hiện tại HolaGroup đang phục vụ khách hàng trên khắp 63 tỉnh thành.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-slate-200 open:border-orange-300 open:ring-1 open:ring-orange-100 transition-all duration-300">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-slate-800 marker:content-none hover:text-orange-600">
                    Website có được bảo hành không?
                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                    Có. Chúng tôi <strong>bảo hành vĩnh viễn</strong> đối với các lỗi kỹ thuật phát sinh từ mã nguồn do chúng tôi xây dựng, miễn là bạn còn sử dụng Hosting tại HolaGroup hoặc giữ nguyên source code gốc.
                </div>
            </details>
        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>