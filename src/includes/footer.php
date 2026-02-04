</main>

<footer class="bg-slate-900 text-slate-300 pt-20 pb-10 relative overflow-hidden font-sans border-t border-slate-800">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-900/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-orange-900/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <div class="space-y-6">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-900/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-tight"><?= setting('company_name', 'HolaGroup') ?></span>
                </a>
                <p class="text-sm leading-relaxed text-slate-400">
                    Đối tác tin cậy cung cấp giải pháp chuyển đổi số toàn diện. Chúng tôi biến ý tưởng kinh doanh của bạn thành hiện thực trên môi trường số với chi phí tối ưu nhất.
                </p>
            </div>

            <div>
                <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-8 h-1 bg-orange-500 rounded-full"></span> Dịch vụ
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="/kho-giao-dien" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Kho giao diện mẫu
                        </a>
                    </li>
                    <li>
                        <a href="/dich-vu" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Thiết kế Website trọn gói
                        </a>
                    </li>
                    <li>
                        <a href="/dich-vu" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Dịch vụ SEO tổng thể
                        </a>
                    </li>
                    <li>
                        <a href="/dich-vu" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Hosting & Tên miền
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-8 h-1 bg-orange-500 rounded-full"></span> Hỗ trợ
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="/chinh-sach" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="shield-check" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Chính sách bảo mật
                        </a>
                    </li>
                    <li>
                        <a href="/chinh-sach" class="flex items-center gap-2 hover:text-orange-500 hover:translate-x-1 transition-all duration-300 group">
                            <i data-lucide="file-text" class="w-4 h-4 text-slate-600 group-hover:text-orange-500"></i> Điều khoản dịch vụ
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-8 h-1 bg-orange-500 rounded-full"></span> Liên hệ
                </h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3 group cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-orange-500 transition-colors">
                            <i data-lucide="map-pin" class="w-4 h-4 text-orange-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-slate-400 group-hover:text-white transition-colors">
                            <?= setting('company_address', 'Đang cập nhật địa chỉ...') ?>
                        </span>
                    </li>
                    <li class="flex items-center gap-3 group cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-orange-500 transition-colors">
                            <i data-lucide="phone" class="w-4 h-4 text-orange-500 group-hover:text-white"></i>
                        </div>
                        <span class="font-bold text-white group-hover:text-orange-500 transition-colors">
                            <?= setting('company_phone', 'Hotline...') ?>
                        </span>
                    </li>
                    <li class="flex items-center gap-3 group cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center shrink-0 group-hover:bg-orange-500 transition-colors">
                            <i data-lucide="mail" class="w-4 h-4 text-orange-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-slate-400 group-hover:text-white transition-colors">
                            <?= setting('company_email', 'Email...') ?>
                        </span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <div>
                &copy; <?php echo date("Y"); ?> <strong class="text-white"><?= setting('company_name', 'HolaGroup') ?></strong>. All rights reserved.
            </div>
            <div class="flex items-center gap-2">
                <span>Designed with</span>
                <i data-lucide="heart" class="w-3 h-3 text-red-500 fill-current animate-pulse"></i>
                <span>by <a href="#" class="text-orange-500 hover:text-white hover:underline transition-colors">HolaGroup Team</a></span>
            </div>
        </div>

    </div>
</footer>

<div class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-4 group-fab">

    <button id="scrollToTopBtn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" 
        class="w-10 h-10 bg-white text-slate-600 rounded-full shadow-xl border border-gray-100 flex items-center justify-center transform translate-y-10 opacity-0 pointer-events-none transition-all duration-300 hover:bg-orange-500 hover:text-white hover:-translate-y-1 hover:shadow-orange-500/30 z-40"
        title="Lên đầu trang">
        <i data-lucide="arrow-up" class="w-5 h-5"></i>
    </button>

    <?php if(setting('social_facebook')): ?>
    <a href="<?= setting('social_facebook') ?>" target="_blank" class="relative flex items-center group/btn z-50">
        <span class="absolute right-14 bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-xl opacity-0 translate-x-4 group-hover/btn:opacity-100 group-hover/btn:translate-x-0 transition-all duration-300 whitespace-nowrap pointer-events-none border border-slate-700">
            Chat Facebook
            <span class="absolute right-[-4px] top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45 border-r border-t border-slate-700"></span>
        </span>
        <div class="w-12 h-12 bg-[#0084FF] text-white rounded-full shadow-lg shadow-blue-500/30 flex items-center justify-center hover:scale-110 transition-transform duration-300">
            <i data-lucide="facebook" class="w-5 h-5 fill-current"></i>
        </div>
    </a>
    <?php endif; ?>

    <?php if(setting('social_zalo')): ?>
    <a href="<?= setting('social_zalo') ?>" target="_blank" class="relative flex items-center group/btn z-50">
        <span class="absolute right-14 bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-xl opacity-0 translate-x-4 group-hover/btn:opacity-100 group-hover/btn:translate-x-0 transition-all duration-300 whitespace-nowrap pointer-events-none border border-slate-700">
            Chat Zalo
            <span class="absolute right-[-4px] top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45 border-r border-t border-slate-700"></span>
        </span>
        <div class="w-12 h-12 bg-[#0068FF] text-white rounded-full shadow-lg shadow-blue-600/30 flex items-center justify-center hover:scale-110 transition-transform duration-300 overflow-hidden border-2 border-white ring-2 ring-blue-100">
             <span class="font-extrabold text-[10px] font-sans">Zalo</span>
        </div>
    </a>
    <?php endif; ?>

    <?php if(setting('company_phone')): ?>
    <a href="tel:<?= setting('company_phone') ?>" class="relative flex items-center group/btn z-50">
        <span class="absolute right-14 bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-xl opacity-0 translate-x-4 group-hover/btn:opacity-100 group-hover/btn:translate-x-0 transition-all duration-300 whitespace-nowrap pointer-events-none border border-slate-700">
            <?= setting('company_phone') ?>
            <span class="absolute right-[-4px] top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45 border-r border-t border-slate-700"></span>
        </span>
        
        <span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75 animate-ping"></span>
        
        <div class="relative w-12 h-12 bg-gradient-to-br from-red-500 to-orange-600 text-white rounded-full shadow-lg shadow-orange-500/40 flex items-center justify-center hover:scale-110 transition-transform duration-300 border-2 border-white ring-2 ring-orange-200">
            <i data-lucide="phone-call" class="w-5 h-5 fill-current animate-tada"></i>
        </div>
    </a>
    <?php endif; ?>

</div>

<style>
    @keyframes tada {
        0% { transform: scale(1); }
        10%, 20% { transform: scale(0.9) rotate(-3deg); }
        30%, 50%, 70%, 90% { transform: scale(1.1) rotate(3deg); }
        40%, 60%, 80% { transform: scale(1.1) rotate(-3deg); }
        100% { transform: scale(1) rotate(0); }
    }
    .animate-tada {
        animation: tada 1.5s infinite;
    }
</style>

<script>
    // 1. Script Scroll To Top
    const scrollBtn = document.getElementById('scrollToTopBtn');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove('translate-y-10', 'opacity-0', 'pointer-events-none');
            scrollBtn.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
        } else {
            scrollBtn.classList.add('translate-y-10', 'opacity-0', 'pointer-events-none');
            scrollBtn.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
        }
    });

    // 2. Kích hoạt Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Script Mobile Menu (Giữ nguyên của bạn)
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('mobile-backdrop');
    const body = document.body;

    if(menuBtn && mobileMenu && backdrop) {
        function openMenu() {
            backdrop.classList.remove('hidden');
            setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            mobileMenu.classList.remove('translate-x-full');
            body.style.overflow = 'hidden';
        }

        function closeMenu() {
            backdrop.classList.add('opacity-0');
            setTimeout(() => backdrop.classList.add('hidden'), 300);
            mobileMenu.classList.add('translate-x-full');
            body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);
        closeBtn.addEventListener('click', closeMenu);
        backdrop.addEventListener('click', closeMenu);
    }
</script>

</body>
</html>