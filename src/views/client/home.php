<?php
include 'includes/header.php';
$json = file_get_contents('data/home.json');
$c = json_decode($json, true);
?>

<style>
    /* (CSS giữ nguyên như cũ) */
    @keyframes blob { 0% { transform: translate(0px, 0px) scale(1); } 33% { transform: translate(30px, -50px) scale(1.1); } 66% { transform: translate(-20px, 20px) scale(0.9); } 100% { transform: translate(0px, 0px) scale(1); } }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
    .text-gradient { background: linear-gradient(to right, #f97316, #fbbf24); background-clip: text; -webkit-text-fill-color: transparent; }
</style>

<section class="relative bg-white overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-28">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-50 border border-orange-100 mb-8 animate-fade-in-up">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
            </span>
            <span class="text-xs font-bold text-orange-600 uppercase tracking-widest"><?= $c['hero']['badge'] ?></span>
        </div>

        <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
            <?= $c['hero']['title_line_1'] ?> <br>
            thành <span class="text-gradient"><?= $c['hero']['title_highlight'] ?></span>
        </h1>

        <p class="text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto mb-10 leading-relaxed">
            <?= $c['hero']['description'] ?>
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="<?= $c['hero']['btn_primary_link'] ?>" class="group relative px-8 py-4 bg-orange-600 rounded-full text-white font-bold shadow-xl shadow-orange-500/30 hover:bg-orange-700 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                <span class="flex items-center gap-2">
                    <?= $c['hero']['btn_primary_text'] ?> <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </span>
            </a>
            <a href="<?= $c['hero']['btn_secondary_link'] ?>" class="px-8 py-4 bg-white border border-slate-200 rounded-full text-slate-700 font-bold hover:border-orange-500 hover:text-orange-600 transition-all duration-300 flex items-center gap-2">
                <i data-lucide="layout-grid" class="w-5 h-5"></i> <?= $c['hero']['btn_secondary_text'] ?>
            </a>
        </div>
        
        <div class="mt-16 relative mx-auto max-w-5xl">
            <div class="relative rounded-2xl bg-slate-900 p-2 shadow-2xl ring-1 ring-slate-900/10">
                <div class="absolute -top-px left-20 right-11 h-px bg-gradient-to-r from-orange-400/0 via-orange-400/70 to-orange-400/0"></div>
                <div class="rounded-xl bg-slate-800 overflow-hidden border border-slate-700/50">
                    <div class="grid grid-cols-12 gap-0 h-[300px] md:h-[500px] bg-slate-900">
                        <div class="hidden md:block col-span-2 border-r border-slate-700 p-4 space-y-4">
                            <div class="h-8 w-8 bg-orange-500 rounded-lg mb-6"></div><div class="h-2 w-20 bg-slate-700 rounded"></div><div class="h-2 w-16 bg-slate-700 rounded"></div>
                        </div>
                        <div class="col-span-12 md:col-span-10 p-6">
                            <div class="flex justify-between items-end mb-6"><div><div class="h-2 w-32 bg-slate-700 rounded mb-2"></div><div class="h-8 w-48 bg-white/10 rounded"></div></div><div class="px-4 py-2 bg-orange-600 rounded-lg text-xs text-white">Export Report</div></div>
                            <div class="grid grid-cols-3 gap-6 mb-6">
                                <div class="h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex flex-col justify-between"><div class="h-8 w-8 bg-orange-500/20 rounded-lg text-orange-500 flex items-center justify-center"><i data-lucide="dollar-sign" class="w-4 h-4"></i></div><div class="text-2xl font-bold text-white">45.2M <span class="text-xs text-green-500">+12%</span></div></div>
                                <div class="h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex flex-col justify-between"><div class="h-8 w-8 bg-blue-500/20 rounded-lg text-blue-500 flex items-center justify-center"><i data-lucide="users" class="w-4 h-4"></i></div><div class="text-2xl font-bold text-white">1,205 <span class="text-xs text-green-500">+5%</span></div></div>
                                <div class="hidden md:flex h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex-col justify-between"><div class="h-8 w-8 bg-purple-500/20 rounded-lg text-purple-500 flex items-center justify-center"><i data-lucide="shopping-cart" class="w-4 h-4"></i></div><div class="text-2xl font-bold text-white">320 <span class="text-xs text-green-500">+8%</span></div></div>
                            </div>
                            <div class="h-48 bg-slate-800 rounded-xl border border-slate-700 w-full relative overflow-hidden"><svg class="absolute bottom-0 left-0 w-full h-full text-orange-500/20 fill-current" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,20 L0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8 L100,20 Z" /></svg><svg class="absolute bottom-0 left-0 w-full h-full text-orange-500 stroke-current stroke-2 fill-none" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8" vector-effect="non-scaling-stroke" /></svg></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                <?= $c['feature_intro']['title_prefix'] ?> <br>
                <span class="text-orange-500"><?= $c['feature_intro']['title_highlight'] ?></span>
            </h2>
            <p class="text-slate-500"><?= $c['feature_intro']['desc'] ?></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 md:p-12 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-50 rounded-full blur-3xl -mr-16 -mt-16 transition-all duration-500 group-hover:bg-orange-100"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-start gap-8">
                    <div class="flex-1">
                        <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white mb-6 rotate-3 group-hover:rotate-6 transition-transform">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= $c['feature_items']['speed']['title'] ?></h3>
                        <p class="text-slate-500 leading-relaxed mb-6"><?= $c['feature_items']['speed']['desc'] ?></p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-slate-700 font-medium"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> <?= $c['feature_items']['speed']['sub_1'] ?></li>
                            <li class="flex items-center gap-2 text-sm text-slate-700 font-medium"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> <?= $c['feature_items']['speed']['sub_2'] ?></li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/3 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <div class="space-y-3">
                            <div class="h-2 bg-slate-200 rounded w-3/4"></div>
                            <div class="h-32 bg-orange-100 rounded-xl w-full flex items-center justify-center text-orange-500 font-bold text-4xl">99<span class="text-sm mt-2">/100</span></div>
                            <div class="text-center text-xs text-slate-400">Google PageSpeed</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 mb-6"><i data-lucide="search" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= $c['feature_items']['seo']['title'] ?></h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-4"><?= $c['feature_items']['seo']['desc'] ?></p>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-500 mb-6"><i data-lucide="smartphone" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= $c['feature_items']['mobile']['title'] ?></h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-4"><?= $c['feature_items']['mobile']['desc'] ?></p>
            </div>

            <div class="lg:col-span-2 bg-slate-900 rounded-3xl p-8 md:p-12 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1 text-white">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-orange-400 mb-6 border border-white/10"><i data-lucide="shield-check" class="w-7 h-7"></i></div>
                        <h3 class="text-2xl font-bold mb-4"><?= $c['security']['title'] ?></h3>
                        <p class="text-slate-400 leading-relaxed mb-6"><?= $c['security']['desc'] ?></p>
                        <a href="<?= $c['security']['link_url'] ?>" class="text-orange-400 font-bold hover:text-orange-300 inline-flex items-center gap-2">
                            <?= $c['security']['link_text'] ?> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div class="relative bg-slate-800 border border-slate-700 rounded-xl p-4">
                             <div class="flex items-center gap-3 mb-3"><div class="w-2 h-2 rounded-full bg-green-500"></div><span class="text-xs text-green-500 font-mono">System Secure</span></div>
                             <div class="h-1 bg-slate-700 rounded w-full overflow-hidden"><div class="h-full bg-green-500 w-full animate-pulse"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white" id="kho-giao-dien">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    <?= $c['template_intro']['title'] ?> <span class="text-orange-500"><?= $c['template_intro']['highlight'] ?></span>
                </h2>
                <p class="text-slate-500"><?= $c['template_intro']['desc'] ?></p>
            </div>
            <a href="<?= $c['template_intro']['btn_all_link'] ?>" class="group px-6 py-3 bg-slate-100 text-slate-700 rounded-full font-bold hover:bg-orange-100 hover:text-orange-600 transition-all flex items-center gap-2">
                <?= $c['template_intro']['btn_all_text'] ?> <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
    <a href="<?= $c['template_items']['item_1']['btn_url'] ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 bg-white border border-slate-100">
        <div class="aspect-[4/3] w-full relative">
            <svg class="w-full h-full" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="400" height="300" fill="#F1F5F9"/>
                
                <rect x="20" y="20" width="360" height="260" rx="8" fill="white" class="drop-shadow-xl"/>
                
                <rect x="20" y="20" width="360" height="40" rx="8" fill="#F8FAFC"/>
                <rect x="20" y="50" width="360" height="10" fill="#F8FAFC"/> <circle cx="45" cy="40" r="5" fill="#CBD5E1"/>
                <circle cx="65" cy="40" r="5" fill="#CBD5E1"/>
                
                <rect x="40" y="80" width="320" height="120" rx="4" fill="#FFEDD5" class="group-hover:fill-orange-100 transition-colors duration-500"/>
                
                <rect x="150" y="95" width="100" height="20" rx="10" fill="white" fill-opacity="0.8"/>
                <text x="200" y="109" font-family="Arial, sans-serif" font-size="10" fill="#F97316" font-weight="bold" text-anchor="middle" letter-spacing="1">
                    <?= mb_strtoupper($c['template_items']['item_1']['cat']) ?>
                </text>
                
                <text x="200" y="150" font-family="Arial, sans-serif" font-size="20" fill="#9A3412" font-weight="bold" text-anchor="middle">
                    <?= $c['template_items']['item_1']['name'] ?>
                </text>

                <rect x="160" y="170" width="80" height="24" rx="4" fill="#F97316" class="group-hover:fill-orange-600 transition-colors"/>
                <text x="200" y="186" font-family="Arial, sans-serif" font-size="10" fill="white" font-weight="bold" text-anchor="middle">XEM NGAY</text>

                <rect x="40" y="220" width="90" height="40" rx="2" fill="#E2E8F0"/>
                <rect x="155" y="220" width="90" height="40" rx="2" fill="#E2E8F0"/>
                <rect x="270" y="220" width="90" height="40" rx="2" fill="#E2E8F0"/>
            </svg>
        </div>
    </a>

    <a href="<?= $c['template_items']['item_2']['btn_url'] ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 bg-white border border-slate-100">
        <div class="aspect-[4/3] w-full relative">
            <svg class="w-full h-full" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="400" height="300" fill="#FFF7ED"/>
                
                <rect x="40" y="30" width="320" height="240" rx="8" fill="white" class="drop-shadow-xl"/>
                
                <path d="M40 38C40 33.5817 43.5817 30 48 30H100V270H48C43.5817 270 40 266.418 40 262V38Z" fill="#1E293B"/>
                <rect x="55" y="50" width="30" height="30" rx="6" fill="#F97316"/>
                <rect x="55" y="100" width="30" height="4" rx="2" fill="#475569"/>
                <rect x="55" y="120" width="30" height="4" rx="2" fill="#475569"/>
                <rect x="55" y="140" width="30" height="4" rx="2" fill="#475569"/>

                <text x="120" y="70" font-family="Arial, sans-serif" font-size="10" fill="#94A3B8" font-weight="bold" letter-spacing="1">
                    <?= mb_strtoupper($c['template_items']['item_2']['cat']) ?>
                </text>
                
                <text x="120" y="100" font-family="Arial, sans-serif" font-size="18" fill="#1E293B" font-weight="bold">
                    <?= $c['template_items']['item_2']['name'] ?>
                </text>
                
                <rect x="120" y="130" width="220" height="80" rx="4" fill="#F1F5F9"/>
                <rect x="140" y="150" width="20" height="40" rx="2" fill="#CBD5E1"/>
                <rect x="170" y="140" width="20" height="50" rx="2" fill="#CBD5E1"/>
                <rect x="200" y="160" width="20" height="30" rx="2" fill="#CBD5E1"/>
                <rect x="230" y="145" width="20" height="45" rx="2" fill="#F97316" class="group-hover:fill-orange-500 transition-colors"/> <rect x="260" y="155" width="20" height="35" rx="2" fill="#CBD5E1"/>

                <rect x="120" y="225" width="100" height="30" rx="4" fill="#E2E8F0"/>
                <rect x="240" y="225" width="100" height="30" rx="4" fill="#E2E8F0"/>
            </svg>
        </div>
    </a>

    <a href="<?= $c['template_items']['item_3']['btn_url'] ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 bg-white border border-slate-100">
        <div class="aspect-[4/3] w-full relative">
            <svg class="w-full h-full" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="400" height="300" fill="#EFF6FF"/>
                
                <rect x="0" y="0" width="400" height="20" fill="#DBEAFE"/>
                <circle cx="20" cy="10" r="3" fill="#60A5FA"/>
                <circle cx="30" cy="10" r="3" fill="#60A5FA"/>

                <rect x="0" y="20" width="400" height="280" fill="#2563EB" fill-opacity="0.1"/>
                
                <rect x="50" y="60" width="300" height="180" rx="8" fill="white" class="drop-shadow-lg"/>
                
                <rect x="150" y="90" width="100" height="20" rx="10" fill="#EFF6FF"/>
                <text x="200" y="104" font-family="Arial, sans-serif" font-size="9" fill="#2563EB" font-weight="bold" text-anchor="middle" letter-spacing="1">
                    <?= mb_strtoupper($c['template_items']['item_3']['cat']) ?>
                </text>

                <text x="200" y="140" font-family="Arial, sans-serif" font-size="22" fill="#1E40AF" font-weight="extrabold" text-anchor="middle">
                    <?= $c['template_items']['item_3']['name'] ?>
                </text>
                
                <rect x="160" y="160" width="80" height="2" fill="#BFDBFE"/>

                <rect x="80" y="190" width="240" height="30" rx="15" fill="#F1F5F9" stroke="#DBEAFE"/>
                <circle cx="100" cy="205" r="4" fill="#94A3B8"/>
                <rect x="250" y="194" width="60" height="22" rx="11" fill="#3B82F6"/>
            </svg>
        </div>
    </a>

</div>
    </div>
</section>

<section class="py-24 bg-slate-900 relative overflow-hidden" id="bao-gia">
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">
                <?= $c['pricing_intro']['title'] ?> <br> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400"><?= $c['pricing_intro']['highlight'] ?></span>
            </h2>
            <a href="<?= $c['pricing_intro']['btn_link'] ?>" class="px-6 py-2 rounded-full bg-orange-500 text-white font-bold text-sm shadow-lg inline-block"><?= $c['pricing_intro']['btn_text'] ?></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center max-w-6xl mx-auto">
            
            <div class="bg-slate-800/50 backdrop-blur-lg border border-slate-700 rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2"><?= $c['pricing_plans']['basic']['name'] ?></h3>
                <div class="text-3xl font-bold text-white mb-6"><?= $c['pricing_plans']['basic']['price'] ?> <span class="text-sm text-slate-500 font-normal">vnđ</span></div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8"><?= $c['pricing_plans']['basic']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <?php foreach($c['pricing_plans']['basic']['features'] as $ft): ?>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-slate-500"></i> <?= $ft ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['basic']['btn_link'] ?>" class="block text-center w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all"><?= $c['pricing_plans']['basic']['btn_text'] ?></a>
            </div>

            <div class="relative bg-gradient-to-b from-orange-500 to-orange-700 rounded-3xl p-8 shadow-2xl transform md:scale-110 z-10">
                <div class="absolute top-0 right-0 bg-white/20 text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase backdrop-blur-md">Khuyên dùng</div>
                <h3 class="text-orange-100 font-medium mb-2"><?= $c['pricing_plans']['pro']['name'] ?></h3>
                <div class="text-4xl font-bold text-white mb-6"><?= $c['pricing_plans']['pro']['price'] ?> <span class="text-sm text-orange-200 font-normal">vnđ</span></div>
                <p class="text-orange-100 text-sm mb-8 border-b border-orange-400/30 pb-8"><?= $c['pricing_plans']['pro']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-white text-sm font-medium">
                    <?php foreach($c['pricing_plans']['pro']['features'] as $ft): ?>
                        <li class="flex items-center gap-3"><div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> <?= $ft ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['pro']['btn_link'] ?>" class="block text-center w-full py-4 rounded-xl bg-white text-orange-600 font-bold hover:shadow-lg transition-all"><?= $c['pricing_plans']['pro']['btn_text'] ?></a>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-lg border border-slate-700 rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2"><?= $c['pricing_plans']['enterprise']['name'] ?></h3>
                <div class="text-3xl font-bold text-white mb-6"><?= $c['pricing_plans']['enterprise']['price'] ?></div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8"><?= $c['pricing_plans']['enterprise']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <?php foreach($c['pricing_plans']['enterprise']['features'] as $ft): ?>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> <?= $ft ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['enterprise']['btn_link'] ?>" class="block text-center w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all"><?= $c['pricing_plans']['enterprise']['btn_text'] ?></a>
            </div>

        </div>
    </div>
</section>

<section class="relative py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="max-w-4xl mx-auto bg-orange-50 rounded-[3rem] p-12 md:p-20 border border-orange-100 relative overflow-hidden">
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6"><?= $c['cta']['title'] ?></h2>
            <p class="text-lg text-slate-600 mb-10 max-w-xl mx-auto"><?= $c['cta']['desc'] ?></p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:<?= $c['cta']['phone_val'] ?>" class="px-8 py-4 bg-orange-600 text-white text-lg font-bold rounded-full shadow-xl shadow-orange-500/30 hover:bg-orange-700 transition-all transform hover:-translate-y-1">
                    Gọi ngay: <?= $c['cta']['phone_display'] ?>
                </a>
                <a href="<?= $c['cta']['zalo_link'] ?>" class="px-8 py-4 bg-white text-slate-800 border border-slate-200 text-lg font-bold rounded-full hover:border-blue-500 hover:text-blue-600 transition-all">
                    <?= $c['cta']['zalo_text'] ?>
                </a>
            </div>
            <p class="mt-6 text-sm text-slate-400"><?= $c['cta']['note'] ?></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>