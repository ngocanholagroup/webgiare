<?php
// views/client/includes/cta-section.php

// 1. Kiểm tra nếu trang cha có truyền biến đè title/desc thì dùng, không thì lấy setting mặc định
$cta_title = $cta_title ?? setting('cta_title', 'Sẵn sàng bứt phá doanh thu?');
$cta_desc  = $cta_desc  ?? setting('cta_desc', 'Đừng để đối thủ vượt mặt. Liên hệ ngay với chúng tôi để được tư vấn giải pháp công nghệ tối ưu nhất cho doanh nghiệp của bạn.');
$cta_note  = $cta_note  ?? setting('cta_note', 'Cam kết phản hồi trong vòng 30 phút.');
?>

<section class="py-24 bg-slate-900 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-[120px] pointer-events-none select-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-600/5 rounded-full blur-[80px] pointer-events-none select-none"></div>

    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none z-0 opacity-60 md:opacity-100">
        <svg width="100%" height="100%" viewBox="0 0 1440 600" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMax slice">
            <defs>
                <linearGradient id="rocketBody" x1="720" y1="100" x2="720" y2="300" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F97316"/>
                    <stop offset="1" stop-color="#C2410C"/>
                </linearGradient>
                <linearGradient id="energyTrail" x1="720" y1="300" x2="720" y2="600" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F97316" stop-opacity="0.8"/>
                    <stop offset="1" stop-color="#F97316" stop-opacity="0"/>
                </linearGradient>
                 <linearGradient id="blueTrail" x1="720" y1="350" x2="720" y2="600" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#3B82F6" stop-opacity="0.5"/>
                    <stop offset="1" stop-color="#1E40AF" stop-opacity="0"/>
                </linearGradient>
            </defs>
            
            <path d="M500 600 C 600 500, 650 400, 720 350 C 790 400, 840 500, 940 600 H 500 Z" fill="url(#blueTrail)" />
            <path d="M600 600 C 650 500, 680 400, 720 300 C 760 400, 790 500, 840 600 H 600 Z" fill="url(#energyTrail)" />
            
            <circle cx="650" cy="500" r="3" fill="#FDBA74" opacity="0.6"><animate attributeName="cy" values="500;450" dur="2s" repeatCount="indefinite" /></circle>
            <circle cx="790" cy="550" r="4" fill="#FDBA74" opacity="0.4"><animate attributeName="cy" values="550;480" dur="2.5s" repeatCount="indefinite" /></circle>
            <circle cx="720" cy="400" r="2" fill="white" opacity="0.8"><animate attributeName="cy" values="400;350" dur="1.5s" repeatCount="indefinite" /></circle>

            <g transform="translate(720, 200)">
                <path d="M-30 80 L-50 120 H-20 L-30 80Z" fill="#9A3412"/>
                <path d="M30 80 L50 120 H20 L30 80Z" fill="#9A3412"/>
                <path d="M0 0 C -20 40, -30 80, -30 120 H 30 C 30 80, 20 40, 0 0 Z" fill="url(#rocketBody)"/>
                <circle cx="0" cy="60" r="12" fill="white" fill-opacity="0.9"/>
                <circle cx="0" cy="60" r="8" fill="#E0F2FE"/>
            </g>

            <g opacity="0.2" stroke="white" stroke-width="1" stroke-dasharray="4 4">
                 <line x1="100" y1="100" x2="300" y2="300" />
                 <line x1="1340" y1="50" x2="1100" y2="250" />
                 <circle cx="200" cy="400" r="50" fill="none"/>
                 <rect x="1200" y="300" width="60" height="60" fill="none" transform="rotate(45 1230 330)"/>
            </g>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight drop-shadow-md">
            <?= $cta_title ?>
        </h2>
        
        <p class="text-slate-300 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
            <?= $cta_desc ?>
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-5">
            <a href="/lien-he" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-full transition-all transform hover:-translate-y-1 shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 flex items-center justify-center gap-3 text-lg">
                <span>Liên hệ tư vấn ngay</span>
                <i data-lucide="rocket" class="w-5 h-5 group-hover:animate-bounce"></i> </a>
            
            <a href="tel:<?= setting('company_phone') ?>" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-white font-bold rounded-full backdrop-blur-md border border-white/20 transition-all flex items-center justify-center gap-3 hover:border-white/40">
                <i data-lucide="phone-call" class="w-5 h-5 text-green-400"></i>
                <span>Gọi <?= setting('company_phone') ?></span>
            </a>
        </div>

        <?php if($cta_note): ?>
        <div class="mt-8 inline-flex items-center gap-2 text-sm text-slate-400 font-medium bg-slate-800/50 px-4 py-2 rounded-full backdrop-blur-sm border border-slate-700/50">
            <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i>
            <?= $cta_note ?>
        </div>
        <?php endif; ?>
    </div>
</section>