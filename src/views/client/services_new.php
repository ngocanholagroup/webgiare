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
            <span class="text-xs font-bold text-orange-400 uppercase tracking-widest"><?= htmlspecialchars($c['hero']['badge'] ?? 'Hệ sinh thái dịch vụ') ?></span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            <?= htmlspecialchars($c['hero']['title_line_1'] ?? 'Giải pháp toàn diện cho') ?> <br>
            <span class="text-gradient"><?= htmlspecialchars($c['hero']['title_highlight'] ?? 'Doanh nghiệp số') ?></span>
        </h1>
        
        <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10">
            <?= $c['hero']['description'] ?? 'Từ thiết kế website, hạ tầng hosting đến marketing online. Chúng tôi cung cấp mọi thứ bạn cần để vận hành doanh nghiệp trên Internet.' ?>
        </p>

        <div class="flex justify-center gap-4">
            <a href="<?= htmlspecialchars($c['hero']['btn_primary_link'] ?? '#dich-vu-chinh') ?>" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-orange-50 transition-colors flex items-center gap-2">
                <?= htmlspecialchars($c['hero']['btn_primary_text'] ?? 'Khám phá dịch vụ') ?> <i data-lucide="arrow-down" class="w-4 h-4"></i>
            </a>
            <?php if (!empty($c['hero']['btn_secondary_text'])): ?>
            <a href="<?= htmlspecialchars($c['hero']['btn_secondary_link'] ?? '#') ?>" class="px-8 py-3 bg-orange-500 text-white font-bold rounded-full hover:bg-orange-600 transition-colors flex items-center gap-2">
                <?= htmlspecialchars($c['hero']['btn_secondary_text']) ?> <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-24 bg-white relative" id="dich-vu-chinh">
    <div class="absolute inset-0 bg-grid-slate [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <!-- Service Intro -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block">
                <?= htmlspecialchars($c['service_intro']['title_prefix'] ?? 'Không chỉ là dịch vụ, đó là') ?>
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                <?= htmlspecialchars($c['service_intro']['title_highlight'] ?? 'Giải pháp chiến lược') ?>
            </h2>
            <p class="text-slate-500 text-lg">
                <?= htmlspecialchars($c['service_intro']['desc'] ?? 'Mỗi dịch vụ được thiết kế riêng để giải quyết các thách thức cụ thể của doanh nghiệp bạn.') ?>
            </p>
        </div>

        <!-- Services List -->
        <?php if (!empty($c['services'])): ?>
            <?php $serviceIcons = ['web_design' => 'monitor-smartphone', 'seo_optimization' => 'bar-chart-2', 'digital_marketing' => 'megaphone', 'maintenance' => 'wrench']; ?>
            <?php $serviceColors = ['web_design' => 'orange', 'seo_optimization' => 'blue', 'digital_marketing' => 'purple', 'maintenance' => 'green']; ?>
            
            <?php foreach ($c['services'] as $serviceKey => $service): ?>
                <div class="flex flex-col lg:flex-row items-center gap-12 mb-24 group">
                    <div class="w-full lg:w-1/2 order-2 lg:order-1">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 aspect-[4/3] group-hover:-translate-y-2 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-br from-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-50 to-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-100"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <i data-lucide="<?= $serviceIcons[$serviceKey] ?? 'briefcase' ?>" class="w-24 h-24 text-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-500 opacity-20"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                        <div class="w-14 h-14 bg-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-600/30">
                            <i data-lucide="<?= $serviceIcons[$serviceKey] ?? 'briefcase' ?>" class="w-7 h-7"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4"><?= htmlspecialchars($service['title']) ?></h2>
                        <p class="text-slate-500 text-lg leading-relaxed mb-6">
                            <?= $service['desc'] ?>
                        </p>
                        <?php if (!empty($service['features'])): ?>
                            <ul class="space-y-3 mb-8">
                                <?php foreach ($service['features'] as $feature): ?>
                                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                                        <i data-lucide="check-circle-2" class="w-5 h-5 text-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-600"></i> 
                                        <?= htmlspecialchars($feature) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!empty($service['price'])): ?>
                            <div class="mb-6">
                                <span class="text-2xl font-bold text-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-600"><?= htmlspecialchars($service['price']) ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($service['btn_text'])): ?>
                            <a href="<?= htmlspecialchars($service['btn_url'] ?? '/lien-he') ?>" class="text-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-600 font-bold hover:text-<?= $serviceColors[$serviceKey] ?? 'gray' ?>-700 inline-flex items-center gap-2 group/link">
                                <?= htmlspecialchars($service['btn_text']) ?> <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Process Section -->
<?php if (!empty($c['process'])): ?>
<section class="py-24 bg-slate-50" id="process">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                <?= htmlspecialchars($c['process']['title'] ?? 'Quy trình làm việc') ?>
            </h2>
            <p class="text-slate-500 text-lg">
                <?= htmlspecialchars($c['process']['subtitle'] ?? 'Chúng tôi làm việc khoa học để đảm bảo chất lượng tốt nhất') ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if (!empty($c['process']['steps'])): ?>
                <?php foreach ($c['process']['steps'] as $stepKey => $step): ?>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-orange-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 group-hover:bg-orange-600 transition-colors">
                            <?= htmlspecialchars($step['number']) ?>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">
                            <?= htmlspecialchars($step['title']) ?>
                        </h3>
                        <p class="text-slate-500">
                            <?= htmlspecialchars($step['desc']) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Why Choose Us Section -->
<?php if (!empty($c['why_choose_us'])): ?>
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                <?= htmlspecialchars($c['why_choose_us']['title'] ?? 'Tại sao chọn Web Giá Rẻ?') ?>
            </h2>
        </div>

        <?php if (!empty($c['why_choose_us']['reasons'])): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($c['why_choose_us']['reasons'] as $reasonKey => $reason): ?>
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="star" class="w-10 h-10 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">
                            <?= htmlspecialchars($reason['title']) ?>
                        </h3>
                        <p class="text-slate-500">
                            <?= htmlspecialchars($reason['desc']) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

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
// Use CTA data from database if available, otherwise fallback to static content
$cta_title = $c['cta']['title'] ?? "Bạn chưa biết nên bắt đầu từ đâu?";
$cta_desc = $c['cta']['desc'] ?? "Đừng lo lắng, hãy để chuyên gia của chúng tôi tư vấn giải pháp phù hợp nhất với ngân sách và mục tiêu của bạn.";
$cta_note = $c['cta']['note'] ?? "Tư vấn miễn phí 1:1 • Hoàn toàn không phát sinh chi phí";
include 'includes/cta-section.php'; 
?>

<?php
// Gọi Footer
include 'includes/footer.php';
?>
