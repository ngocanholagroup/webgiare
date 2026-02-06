<?php
// views/client/home.php
include 'includes/header.php';

$steps = [
    [
        'title' => 'Tiếp nhận & Khảo sát',
        'desc' => 'Lắng nghe yêu cầu, đánh giá hiện trạng và tư vấn giải pháp sơ bộ.'
    ],
    [
        'title' => 'Hoạch định & Thiết kế',
        'desc' => 'Xây dựng cấu trúc, luồng người dùng và thiết kế giao diện UI/UX chi tiết.'
    ],
    [
        'title' => 'Lập trình & Phát triển',
        'desc' => 'Hiện thực hóa thiết kế thành sản phẩm hoạt động với mã nguồn tối ưu.'
    ],
    [
        'title' => 'Kiểm thử & Bàn giao',
        'desc' => 'Rà soát lỗi, đào tạo quản trị và triển khai chính thức lên server.'
    ],
];

?>

<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .text-gradient {
        background: linear-gradient(to right, #f97316, #fbbf24);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
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

        <div class="mt-8 md:mt-16 relative mx-auto max-w-5xl px-4 md:px-0">
            <div class="relative rounded-2xl bg-slate-900 p-1.5 md:p-2 shadow-2xl ring-1 ring-slate-900/10">
                <div class="absolute -top-px left-10 md:left-20 right-11 h-px bg-gradient-to-r from-orange-400/0 via-orange-400/70 to-orange-400/0"></div>

                <div class="rounded-xl bg-slate-800 overflow-hidden border border-slate-700/50">
                    <div class="grid grid-cols-12 gap-0 h-auto md:h-[500px] bg-slate-900">

                        <div class="hidden md:block col-span-2 border-r border-slate-700 p-4 space-y-4">
                            <div class="h-8 w-8 bg-orange-500 rounded-lg mb-6"></div>
                            <div class="h-2 w-20 bg-slate-700 rounded"></div>
                            <div class="h-2 w-16 bg-slate-700 rounded"></div>
                        </div>

                        <div class="col-span-12 md:col-span-10 p-4 md:p-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-6">
                                <div>
                                    <div class="h-2 w-24 md:w-32 bg-slate-700 rounded mb-2"></div>
                                    <div class="h-8 w-40 md:w-48 bg-white/10 rounded"></div>
                                </div>
                                <div class="px-3 py-1.5 md:px-4 md:py-2 bg-orange-600 rounded-lg text-[10px] md:text-xs text-white font-bold uppercase tracking-wider shadow-lg shadow-orange-600/20">
                                    Export Report
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-6">
                                <div class="h-28 md:h-32 bg-slate-800 rounded-xl border border-slate-700 p-3 md:p-4 flex flex-col justify-between">
                                    <div class="h-7 w-7 md:h-8 md:w-8 bg-orange-500/20 rounded-lg text-orange-500 flex items-center justify-center">
                                        <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                    </div>
                                    <div class="text-lg md:text-2xl font-bold text-white">45.2M <span class="block md:inline text-[10px] text-green-500">+12%</span></div>
                                </div>

                                <div class="h-28 md:h-32 bg-slate-800 rounded-xl border border-slate-700 p-3 md:p-4 flex flex-col justify-between">
                                    <div class="h-7 w-7 md:h-8 md:w-8 bg-blue-500/20 rounded-lg text-blue-500 flex items-center justify-center">
                                        <i data-lucide="users" class="w-4 h-4"></i>
                                    </div>
                                    <div class="text-lg md:text-2xl font-bold text-white">1,205 <span class="block md:inline text-[10px] text-green-500">+5%</span></div>
                                </div>

                                <div class="hidden md:flex h-32 bg-slate-800 rounded-xl border border-slate-700 p-4 flex-col justify-between">
                                    <div class="h-8 w-8 bg-purple-500/20 rounded-lg text-purple-500 flex items-center justify-center">
                                        <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                    </div>
                                    <div class="text-2xl font-bold text-white">320 <span class="text-xs text-green-500">+8%</span></div>
                                </div>
                            </div>

                            <div class="h-32 md:h-48 bg-slate-800 rounded-xl border border-slate-700 w-full relative overflow-hidden">
                                <svg class="absolute bottom-0 left-0 w-full h-full text-orange-500/20 fill-current" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,20 L0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8 L100,20 Z" />
                                </svg>
                                <svg class="absolute bottom-0 left-0 w-full h-full text-orange-500 stroke-current stroke-2 fill-none" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,10 Q10,5 20,12 T40,10 T60,5 T80,15 T100,8" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white" id="tinh-nang-noi-bat">
    <div class="container mx-auto px-4">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                <?= $c['feature_intro']['title_prefix'] ?> <br>
                <span class="text-orange-500"><?= $c['feature_intro']['title_highlight'] ?></span>
            </h2>
            <p class="text-slate-500"><?= $c['feature_intro']['desc'] ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 group relative p-8 md:p-10 bg-orange-50 rounded-3xl border border-orange-100 overflow-hidden hover:shadow-xl hover:shadow-orange-500/10 transition-all duration-300">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= $c['feature_items']['speed']['title'] ?></h3>
                        <p class="text-slate-600 leading-relaxed"><?= $c['feature_items']['speed']['desc'] ?></p>
                    </div>

                    <div class="w-40 h-40 flex-shrink-0 relative transform group-hover:scale-110 transition-transform duration-500">
                        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M40 160 A 80 80 0 1 1 160 160" stroke="#FFEDD5" stroke-width="20" stroke-linecap="round" />
                            <path d="M40 160 A 80 80 0 1 1 160 160" stroke="#F97316" stroke-width="20" stroke-linecap="round" stroke-dasharray="350" stroke-dashoffset="100" class="drop-shadow-lg" />
                            <path d="M100 100 L140 60" stroke="#C2410C" stroke-width="8" stroke-linecap="round" />
                            <circle cx="100" cy="100" r="15" fill="#F97316" />
                            <path d="M110 40 L120 20 L140 30" fill="#F97316" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative p-8 bg-white rounded-3xl border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:shadow-orange-500/10 transition-all duration-300">
                <div class="h-32 mb-4 flex items-center justify-center transform group-hover:-translate-y-2 transition-transform duration-500">
                    <svg width="120" height="120" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="40" y="50" width="120" height="100" rx="8" fill="#FFF7ED" stroke="#FDBA74" stroke-width="4" />
                        <rect x="40" y="50" width="120" height="20" rx="8" fill="#FDBA74" />
                        <circle cx="55" cy="60" r="3" fill="white" />
                        <circle cx="65" cy="60" r="3" fill="white" />
                        <rect x="60" y="110" width="15" height="30" rx="2" fill="#F97316" opacity="0.4" />
                        <rect x="85" y="90" width="15" height="50" rx="2" fill="#F97316" opacity="0.7" />
                        <rect x="110" y="80" width="15" height="60" rx="2" fill="#F97316" />
                        <circle cx="130" cy="130" r="30" stroke="#C2410C" stroke-width="6" fill="white" fill-opacity="0.8" />
                        <path d="M150 150 L170 170" stroke="#C2410C" stroke-width="8" stroke-linecap="round" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2"><?= $c['feature_items']['seo']['title'] ?></h3>
                <p class="text-slate-500 text-sm"><?= $c['feature_items']['seo']['desc'] ?></p>
            </div>

            <div class="group relative p-8 bg-white rounded-3xl border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:shadow-orange-500/10 transition-all duration-300">
                <div class="h-32 mb-4 flex items-center justify-center transform group-hover:-translate-y-2 transition-transform duration-500">
                    <svg width="120" height="120" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="30" y="40" width="140" height="90" rx="6" fill="#FFF7ED" stroke="#FDBA74" stroke-width="4" />
                        <path d="M80 140 H120 L110 130 H90 L80 140Z" fill="#FDBA74" />
                        <rect x="70" y="140" width="60" height="4" rx="2" fill="#FDBA74" />
                        <rect x="130" y="80" width="40" height="70" rx="4" fill="white" stroke="#F97316" stroke-width="4" class="drop-shadow-md" />
                        <rect x="142" y="90" width="16" height="2" rx="1" fill="#F97316" />
                        <circle cx="150" cy="140" r="3" fill="#F97316" />
                        <circle cx="50" cy="150" r="10" fill="#FFEDD5" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2"><?= $c['feature_items']['mobile']['title'] ?></h3>
                <p class="text-slate-500 text-sm"><?= $c['feature_items']['mobile']['desc'] ?></p>
            </div>

            <div class="lg:col-span-2 group relative p-8 md:p-10 bg-slate-900 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-600 rounded-full blur-[80px] opacity-20 group-hover:opacity-30 transition-opacity"></div>

                <div class="relative z-10 flex flex-col md:flex-row-reverse items-center justify-between gap-8">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-3"><?= $c['security']['title'] ?></h3>
                        <p class="text-slate-400 leading-relaxed mb-4"><?= $c['security']['desc'] ?></p>
                    </div>

                    <div class="w-40 h-40 flex-shrink-0 transform group-hover:scale-105 transition-transform duration-500">
                        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 30 C100 30 160 40 160 90 C160 140 100 180 100 180 C100 180 40 140 40 90 C40 40 100 30 100 30 Z" fill="#1E293B" stroke="#F97316" stroke-width="4" />

                            <path d="M80 100 L95 115 L125 75" stroke="#F97316" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />

                            <circle cx="50" cy="50" r="4" fill="#F97316" opacity="0.5" />
                            <circle cx="150" cy="160" r="6" fill="#F97316" opacity="0.3" />
                            <circle cx="170" cy="60" r="3" fill="#F97316" opacity="0.6" />

                            <rect x="50" y="90" width="100" height="2" fill="white" opacity="0.2" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white overflow-hidden" id="quy-trinh-line-tree">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                Quy trình tinh gọn <br>
                <span class="text-orange-500">Tối ưu hóa hiệu năng</span>
            </h2>
            <p class="text-slate-500">Quy trình triển khai nhanh chóng, minh bạch và hiệu quả, giúp bạn tiết kiệm thời gian và chi phí.</p>
        </div>

        <div class="relative">
            <div class="absolute left-6 md:left-1/2 top-2 h-[calc(100%-1rem)] w-0.5 bg-gradient-to-b from-orange-200 via-orange-400 to-orange-200 transform md:-translate-x-1/2 z-0 rounded-full"></div>

            <div class="space-y-16 relative z-10">
                <?php foreach ($steps as $i => $step):
                    $is_even = (($i + 1) % 2 == 0);
                ?>
                    <div class="relative flex flex-col md:flex-row items-center <?= $is_even ? 'md:flex-row-reverse' : '' ?>">

                        <div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-12 h-12 rounded-full bg-orange-50 border-4 border-white shadow-[0_0_0_4px_rgba(249,115,22,0.2)] z-20 mt-1 md:mt-0">
                            <div class="w-4 h-4 bg-orange-600 rounded-full"></div>
                        </div>

                        <div class="w-full md:w-1/2 pl-20 md:pl-0 <?= $is_even ? 'md:pr-16 md:text-right' : 'md:pl-16 md:text-left' ?>">
                            <div class="group relative p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
                                <span class="absolute text-7xl font-black text-orange-200/30 -top-6 select-none pointer-events-none transition-all group-hover:text-orange-300/40 <?= $is_even ? 'right-4' : 'left-4' ?>">
                                    0<?= $i + 1 ?>
                                </span>

                                <h3 class="text-xl font-bold text-orange-700 mb-3 relative">
                                    <?= $step['title'] ?>
                                </h3>
                                <p class="text-slate-900 text-sm leading-relaxed relative font-medium">
                                    <?= $step['desc'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="hidden md:block md:w-1/2"></div>

                    </div>
                <?php endforeach; ?>
            </div>
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

            <div class="bg-slate-800/50 backdrop-blur-lg rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2"><?= $c['pricing_plans']['basic']['name'] ?></h3>
                <div class="text-3xl font-bold text-white mb-6"><?= $c['pricing_plans']['basic']['price'] ?> <span class="text-sm text-slate-500 font-normal">vnđ</span></div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8"><?= $c['pricing_plans']['basic']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <?php foreach ($c['pricing_plans']['basic']['features'] as $ft): ?>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-slate-500"></i> <?= $ft ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['basic']['btn_link'] ?>" class="block text-center w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all"><?= $c['pricing_plans']['basic']['btn_text'] ?></a>
            </div>

            <div class="relative bg-gradient-to-b from-orange-500 to-orange-700 rounded-3xl p-8 shadow-2xl transform md:scale-110 z-10 overflow-hidden hover:shadow-3xl hover:scale-105 transition-all">
                <div class="absolute top-0 right-0 bg-white/20 text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase backdrop-blur-md">Khuyên dùng</div>
                <h3 class="text-orange-100 font-medium mb-2"><?= $c['pricing_plans']['pro']['name'] ?></h3>
                <div class="text-4xl font-bold text-white mb-6"><?= $c['pricing_plans']['pro']['price'] ?> <span class="text-sm text-orange-200 font-normal">vnđ</span></div>
                <p class="text-orange-100 text-sm mb-8 border-b border-orange-400/30 pb-8"><?= $c['pricing_plans']['pro']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-white text-sm font-medium">
                    <?php foreach ($c['pricing_plans']['pro']['features'] as $ft): ?>
                        <li class="flex items-center gap-3">
                            <div class="p-1 bg-white/20 rounded-full"><i data-lucide="check" class="w-3 h-3 text-white"></i></div> <?= $ft ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['pro']['btn_link'] ?>" class="block text-center w-full py-4 rounded-xl bg-white text-orange-600 font-bold hover:shadow-lg transition-all"><?= $c['pricing_plans']['pro']['btn_text'] ?></a>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-lg rounded-3xl p-8 hover:bg-slate-800 transition-all">
                <h3 class="text-slate-400 font-medium mb-2"><?= $c['pricing_plans']['enterprise']['name'] ?></h3>
                <div class="text-3xl font-bold text-white mb-6"><?= $c['pricing_plans']['enterprise']['price'] ?></div>
                <p class="text-slate-400 text-sm mb-8 border-b border-slate-700 pb-8"><?= $c['pricing_plans']['enterprise']['desc'] ?></p>
                <ul class="space-y-4 mb-8 text-slate-300 text-sm">
                    <?php foreach ($c['pricing_plans']['enterprise']['features'] as $ft): ?>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-orange-500"></i> <?= $ft ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= $c['pricing_plans']['enterprise']['btn_link'] ?>" class="block text-center w-full py-3 rounded-xl border border-slate-600 text-white font-bold hover:bg-white hover:text-slate-900 transition-all"><?= $c['pricing_plans']['enterprise']['btn_text'] ?></a>
            </div>

        </div>
    </div>
</section>

<?php
$cta_title = "Đừng để đối thủ vượt mặt bạn trên Google";
include 'includes/cta-section.php';
?>

<?php include 'includes/footer.php'; ?>