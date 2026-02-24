<?php
// Gọi Header
include 'includes/header.php';

// Mảng cấu hình Style tĩnh cho Tailwind (Giải quyết triệt để lỗi mất class khi build)
$srvStyles = [
    'web' => [
        'icon' => 'monitor-smartphone', 'bg_box' => 'bg-orange-500', 'shadow_box' => 'shadow-orange-500/30', 
        'text_link' => 'text-orange-600', 'hover_link' => 'hover:text-orange-700', 'text_check' => 'text-orange-500'
    ],
    'seo' => [
        'icon' => 'bar-chart-2', 'bg_box' => 'bg-blue-600', 'shadow_box' => 'shadow-blue-600/30', 
        'text_link' => 'text-blue-600', 'hover_link' => 'hover:text-blue-700', 'text_check' => 'text-blue-600'
    ],
    'hosting' => [
        'icon' => 'server', 'bg_box' => 'bg-purple-600', 'shadow_box' => 'shadow-purple-600/30', 
        'text_link' => 'text-purple-600', 'hover_link' => 'hover:text-purple-700', 'text_check' => 'text-purple-600'
    ]
];

$auxStyles = [
    'logo' => ['hover_shadow' => 'hover:shadow-orange-500/5', 'hover_text' => 'group-hover:text-orange-600'],
    'maintenance' => ['hover_shadow' => 'hover:shadow-blue-500/5', 'hover_text' => 'group-hover:text-blue-600'],
    'software' => ['hover_shadow' => 'hover:shadow-green-500/5', 'hover_text' => 'group-hover:text-green-600']
];
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
            <span class="text-xs font-bold text-orange-400 uppercase tracking-widest"><?= htmlspecialchars($c['hero']['badge'] ?? 'Hệ sinh thái dịch vụ') ?></span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            <?= htmlspecialchars($c['hero']['title_line_1'] ?? 'Giải pháp toàn diện cho') ?> <br>
            <span class="text-gradient"><?= htmlspecialchars($c['hero']['title_highlight'] ?? 'Doanh nghiệp số') ?></span>
        </h1>
        
        <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10">
            <?= htmlspecialchars($c['hero']['description'] ?? 'Từ thiết kế website, hạ tầng hosting đến marketing online. Chúng tôi cung cấp mọi thứ bạn cần để vận hành doanh nghiệp trên Internet.') ?>
        </p>

        <div class="flex justify-center gap-4">
            <a href="<?= htmlspecialchars($c['hero']['btn_primary_link'] ?? '#dich-vu-chinh') ?>" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-orange-50 transition-colors flex items-center gap-2">
                <?= htmlspecialchars($c['hero']['btn_primary_text'] ?? 'Khám phá dịch vụ') ?> <i data-lucide="arrow-down" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-24 bg-white relative" id="dich-vu-chinh">
    <div class="absolute inset-0 bg-grid-slate [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <?php if (!empty($c['main_services'])): ?>
            <?php 
            $i = 0;
            foreach ($c['main_services'] as $key => $service): 
                // Xử lý layout xen kẽ (Trái - Phải)
                $isEven = ($i % 2 === 0);
                $imgOrder = $isEven ? 'order-2 lg:order-1' : 'order-2';
                $txtOrder = $isEven ? 'order-1 lg:order-2' : 'order-1';
                $st = $srvStyles[$key] ?? $srvStyles['web']; // Fallback style
            ?>
            <div id="service-<?= htmlspecialchars($key) ?>" class="flex flex-col lg:flex-row items-center gap-12 mb-24 group">
                <div class="w-full lg:w-1/2 <?= $imgOrder ?>">
                    <?php if ($key === 'web'): ?>
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
                    <?php elseif ($key === 'seo'): ?>
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
                    <?php elseif ($key === 'hosting'): ?>
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
                    <?php endif; ?>
                </div>

                <div class="w-full lg:w-1/2 <?= $txtOrder ?>">
                    <div class="w-14 h-14 <?= $st['bg_box'] ?> rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg <?= $st['shadow_box'] ?>">
                        <i data-lucide="<?= $st['icon'] ?>" class="w-7 h-7"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-4"><?= htmlspecialchars($service['title']) ?></h2>
                    <p class="text-slate-500 text-lg leading-relaxed mb-6">
                        <?= $service['desc'] // Giữ nguyên html/markdown nếu có ?>
                    </p>
                    
                    <?php if (!empty($service['features'])): ?>
                    <ul class="space-y-3 mb-8">
                        <?php foreach ($service['features'] as $feature): ?>
                        <li class="flex items-center gap-3 text-slate-700 font-medium">
                            <i data-lucide="check-circle-2" class="w-5 h-5 <?= $st['text_check'] ?>"></i> 
                            <?= htmlspecialchars($feature) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($service['btn_text'])): ?>
                    <a href="<?= htmlspecialchars($service['btn_url'] ?? '#') ?>" class="<?= $st['text_link'] ?> font-bold <?= $st['hover_link'] ?> inline-flex items-center gap-2 group/link">
                        <?= htmlspecialchars($service['btn_text']) ?> <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
                $i++;
            endforeach; 
            ?>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($c['aux_services'])): ?>
<section class="py-24 bg-slate-50 border-t border-slate-200" id="dich-vu-bo-tro">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 max-w-2xl mx-auto">
            <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block"><?= htmlspecialchars($c['aux_intro']['subtitle'] ?? 'Mở rộng tiềm năng') ?></span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?= htmlspecialchars($c['aux_intro']['title'] ?? 'Hệ sinh thái dịch vụ bổ trợ') ?></h2>
            <p class="text-slate-500"><?= htmlspecialchars($c['aux_intro']['desc'] ?? 'Giải pháp toàn diện giúp doanh nghiệp vận hành trơn tru và phát triển thương hiệu đồng bộ.') ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($c['aux_services'] as $key => $service): 
                $ast = $auxStyles[$key] ?? $auxStyles['logo'];
            ?>
            <div id="service-<?= htmlspecialchars($key) ?>" class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl <?= $ast['hover_shadow'] ?> hover:-translate-y-2 transition-all duration-300 group">
                <div class="h-24 mb-6 flex items-center justify-start">
                    <?php if ($key === 'logo'): ?>
                        <svg width="80" height="80" viewBox="0 0 100 100" fill="none" class="transform group-hover:scale-110 transition-transform duration-500">
                            <circle cx="50" cy="50" r="40" fill="#FFF7ED"/>
                            <path d="M30 60 C 20 50, 20 30, 40 25 C 50 20, 70 20, 80 35 C 90 50, 80 70, 60 75 C 50 80, 40 70, 30 60" fill="#FFEDD5" stroke="#F97316" stroke-width="2"/>
                            <circle cx="40" cy="40" r="3" fill="#F97316"/> <circle cx="55" cy="35" r="3" fill="#F97316"/> <circle cx="70" cy="45" r="3" fill="#F97316"/>
                            <path d="M60 60 L 25 90 L 20 80 L 50 45" fill="white" stroke="#EA580C" stroke-width="2"/>
                            <path d="M50 45 L 65 30 C 70 25, 75 30, 70 35 L 55 50" fill="#F97316"/>
                            <path d="M25 90 C 15 95, 10 80, 15 75" stroke="#FDBA74" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    <?php elseif ($key === 'maintenance'): ?>
                        <svg width="80" height="80" viewBox="0 0 100 100" fill="none" class="transform group-hover:rotate-6 transition-transform duration-500">
                            <circle cx="50" cy="50" r="40" fill="#EFF6FF"/>
                            <circle cx="50" cy="50" r="15" stroke="#3B82F6" stroke-width="8" stroke-dasharray="10 4"/>
                            <circle cx="50" cy="50" r="8" fill="#DBEAFE"/>
                            <path d="M35 65 L 25 75 C 20 80, 25 85, 30 80 L 40 70" stroke="#2563EB" stroke-width="6" stroke-linecap="round"/>
                            <path d="M60 40 L 40 60" stroke="#60A5FA" stroke-width="6" stroke-linecap="round"/>
                            <path d="M70 20 C 70 20, 80 25, 80 35 C 80 50, 70 60, 70 60 C 70 60, 60 50, 60 35 C 60 25, 70 20, 70 20 Z" fill="#3B82F6" stroke="white" stroke-width="2"/>
                            <path d="M68 35 L 72 40 L 76 30" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($key === 'software'): ?>
                        <svg width="80" height="80" viewBox="0 0 100 100" fill="none" class="transform group-hover:scale-105 transition-transform duration-500">
                            <circle cx="50" cy="50" r="40" fill="#F0FDF4"/>
                            <rect x="20" y="25" width="60" height="45" rx="4" fill="white" stroke="#16A34A" stroke-width="2"/>
                            <rect x="20" y="25" width="60" height="10" rx="4" fill="#DCFCE7"/>
                            <circle cx="28" cy="30" r="2" fill="#16A34A"/> <circle cx="34" cy="30" r="2" fill="#16A34A" opacity="0.5"/>
                            <rect x="28" y="45" width="20" height="4" rx="2" fill="#86EFAC"/>
                            <rect x="28" y="55" width="30" height="4" rx="2" fill="#BBF7D0"/>
                            <rect x="28" y="65" width="15" height="4" rx="2" fill="#BBF7D0"/>
                            <path d="M65 60 H 75 V 70 H 65 V 60 Z" fill="#16A34A" class="drop-shadow-md"/>
                            <circle cx="70" cy="60" r="3" fill="#16A34A"/> <circle cx="75" cy="65" r="3" fill="#16A34A"/> 
                        </svg>
                    <?php endif; ?>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 <?= $ast['hover_text'] ?> transition-colors"><?= htmlspecialchars($service['title']) ?></h3>
                <p class="text-slate-500 text-sm leading-relaxed"><?= htmlspecialchars($service['desc']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="py-16 bg-white border-t border-slate-100 overflow-hidden">
    </section>

<?php 
$cta_title = $c['cta']['title'] ?? "Bạn chưa biết nên bắt đầu từ đâu?";
$cta_desc = $c['cta']['desc'] ?? "Đừng lo lắng, hãy để chuyên gia của chúng tôi tư vấn giải pháp phù hợp nhất với ngân sách và mục tiêu của bạn.";
$cta_note = $c['cta']['note'] ?? "Tư vấn miễn phí 1:1 • Hoàn toàn không phát sinh chi phí";
include 'includes/cta-section.php'; 
?>

<?php
// Gọi Footer
include 'includes/footer.php';
?>

<script>
// Handle hash scroll for services
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a hash in the URL
    if (window.location.hash) {
        const targetId = window.location.hash.substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            // Wait a bit for page to fully load
            setTimeout(function() {
                const headerHeight = 80; // Adjust based on your header height
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }, 100);
        }
    }
    
    // Handle clicks on service links from other pages
    const serviceLinks = document.querySelectorAll('a[href*="#service-"]');
    serviceLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('/dich-vu#service-')) {
                // If we're not on services page, let the normal navigation happen
                if (!window.location.pathname.includes('/dich-vu')) {
                    return;
                }
                
                e.preventDefault();
                const targetId = href.split('#service-')[1];
                const targetElement = document.getElementById('service-' + targetId);
                
                if (targetElement) {
                    const headerHeight = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});
</script>