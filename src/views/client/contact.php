<?php
// views/client/contact.php
include 'includes/header.php';

// Kiểm tra tham số template từ URL
$selected_template = isset($_GET['template']) ? $_GET['template'] : '';
?>

<style>
    .text-gradient {
        background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* CSS cho Map: Áp dụng cho mọi thẻ iframe bên trong section map */
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
        filter: grayscale(100%) invert(0%);
        transition: filter 0.3s;
    }

    .map-container iframe:hover {
        filter: none;
    }
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
            Dù bạn đang có ý tưởng khởi nghiệp hay muốn nâng cấp hệ thống hiện tại. Đội ngũ chuyên gia của <?= setting('company_name', 'HolaGroup') ?> luôn sẵn sàng tư vấn giải pháp tối ưu nhất.
        </p>
    </div>
</section>

<section class="relative -mt-32 pb-24 z-20">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-900/10 overflow-hidden flex flex-col lg:flex-row">
            
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
                            <p class="text-slate-400 text-sm mt-1">
                                <?= setting('company_address', 'Đang cập nhật...') ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Hotline / Zalo</h4>
                            <p class="text-slate-400 text-sm mt-1">
                                <a href="tel:<?= setting('company_phone') ?>" class="hover:text-white transition-colors">
                                    <?= setting('company_phone', 'Đang cập nhật...') ?>
                                </a>
                            </p>
                            <p class="text-xs text-slate-500 mt-1">(Hỗ trợ: 8:00 - 22:00)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Email</h4>
                            <p class="text-slate-400 text-sm mt-1">
                                <a href="mailto:<?= setting('company_email') ?>" class="hover:text-white transition-colors">
                                    <?= setting('company_email', 'contact@domain.com') ?>
                                </a>
                            </p>
                            <?php if(setting('company_email_support')): ?>
                            <p class="text-slate-400 text-sm">
                                <a href="mailto:<?= setting('company_email_support') ?>" class="hover:text-white transition-colors">
                                    <?= setting('company_email_support') ?>
                                </a>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-white/10">
                    <p class="text-sm text-slate-400 mb-4">Kết nối với chúng tôi:</p>
                    <div class="flex gap-4">
                        <?php if(setting('social_facebook')): ?>
                        <a href="<?= setting('social_facebook') ?>" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 flex items-center justify-center transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(setting('social_zalo')): ?>
                        <a href="<?= setting('social_zalo') ?>" target="_blank" class="w-10 h-10 text-sm rounded-full bg-white/5 hover:bg-orange-500 flex items-center justify-center transition-all">Zalo</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/5 p-8 md:p-12 bg-white">
                <form action="/lien-he/submit" method="POST" class="space-y-6">
                    
                    <input type="hidden" name="template_sku" value="<?= htmlspecialchars($selected_template) ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Họ và tên <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required placeholder="Nguyễn Văn A" class="w-full px-4 py-3 rounded-xl bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" required placeholder="09xx xxx xxx" class="w-full px-4 py-3 rounded-xl bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Email (Nếu có)</label>
                        <input type="email" name="email" placeholder="example@gmail.com" class="w-full px-4 py-3 rounded-xl bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Dịch vụ quan tâm</label>
                        <div class="relative">
                            <select name="service_type" class="w-full px-4 py-3 rounded-xl bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all appearance-none text-slate-600">
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
                        <textarea name="message" rows="4" placeholder="Mô tả sơ qua về nhu cầu của bạn..." class="w-full px-4 py-3 rounded-xl bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                        <span>Gửi yêu cầu tư vấn</span>
                        <i data-lucide="send" class="w-5 h-5"></i>
                    </button>

                    <p class="text-center text-xs text-slate-400 mt-4">
                        Chúng tôi cam kết bảo mật thông tin cá nhân của bạn.
                    </p>
                </form>
            </div>

        </div>
    </div>
</section>

<section class="h-96 w-full relative z-10 bg-slate-100 map-container">
    
    <?= setting('map_iframe') ?>
    
    <div class="hidden md:block absolute top-10 left-10 bg-white p-6 rounded-2xl shadow-2xl max-w-xs">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold">H</div>
            <span class="font-bold text-slate-900"><?= setting('company_name', 'HolaGroup') ?> Office</span>
        </div>
        <p class="text-sm text-slate-500 mb-4">Mời bạn ghé thăm văn phòng để trao đổi trực tiếp.</p>
        
        <a href="https://maps.google.com" target="_blank" class="text-xs font-bold text-orange-600 flex items-center gap-1 hover:underline">
            Xem chỉ đường <i data-lucide="external-link" class="w-3 h-3"></i>
        </a>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>