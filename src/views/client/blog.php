<?php
// Gọi Header
include 'includes/header.php';

// Dữ liệu giả lập (Mock Data)
$featured_post = [
    'title' => '5 Xu hướng Thiết kế Website sẽ thống trị năm 2026',
    'slug' => 'xu-huong-thiet-ke-web-2026',
    'desc' => 'Khám phá những phong cách UI/UX mới nhất: Từ Glassmorphism, 3D Abstract đến xu hướng tối giản Dark Mode.',
    'image' => 'https://cdn.dribbble.com/users/1294862/screenshots/17390977/media/a96095940428d227b233a59569766624.png',
    'cat' => 'Xu hướng',
    'date' => '02/02/2026',
    'author' => 'Admin'
];

$posts = [
    [
        'title' => 'Tại sao Website của bạn tải chậm? Cách khắc phục ngay',
        'image' => 'https://cdn.dribbble.com/users/1998175/screenshots/15646979/media/3c239482d8c903e053d100d33e6015b3.jpg',
        'cat' => 'Kỹ thuật',
        'date' => '01/02/2026',
        'views' => '1.2k'
    ],
    [
        'title' => 'SEO On-page là gì? Hướng dẫn cho người mới bắt đầu',
        'image' => 'https://cdn.dribbble.com/users/418188/screenshots/14299318/media/673410657158885c345d3c8c7604f141.png',
        'cat' => 'Marketing',
        'date' => '30/01/2026',
        'views' => '850'
    ],
    [
        'title' => 'Bí quyết tăng tỷ lệ chuyển đổi (CRO) cho Landing Page',
        'image' => 'https://cdn.dribbble.com/users/418188/screenshots/11497262/media/64835845c432d53c7a0d425b74681f2f.jpg',
        'cat' => 'Kinh doanh',
        'date' => '28/01/2026',
        'views' => '2.1k'
    ],
    [
        'title' => 'Hosting NVMe là gì? Tại sao nên nâng cấp ngay?',
        'image' => 'https://cdn.dribbble.com/users/2514124/screenshots/15509789/media/c968f921f0842211912440b82f808779.png',
        'cat' => 'Công nghệ',
        'date' => '25/01/2026',
        'views' => '500'
    ],
    [
        'title' => 'Review top 5 cổng thanh toán Online tốt nhất Việt Nam',
        'image' => 'https://cdn.dribbble.com/users/1615584/screenshots/14686948/media/25292415d86b71887e2213a48e89b25a.jpg',
        'cat' => 'E-commerce',
        'date' => '20/01/2026',
        'views' => '3.4k'
    ],
    [
        'title' => 'Màu sắc ảnh hưởng thế nào đến tâm lý khách hàng?',
        'image' => 'https://cdn.dribbble.com/users/1728196/screenshots/14493393/media/c15b94239841c59972323a67d5594b29.png',
        'cat' => 'Thiết kế',
        'date' => '15/01/2026',
        'views' => '1.5k'
    ]
];
?>

<style>
    .text-gradient {
        background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bg-noise {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
    }
</style>

<section class="relative pt-32 pb-24 lg:pt-48 lg:pb-32 bg-slate-900 overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[120px] animate-blob"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-500/20 rounded-full blur-[120px] animate-blob animation-delay-2000"></div>
    <div class="absolute inset-0 bg-noise opacity-20 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">

            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-800/50 border border-slate-700 backdrop-blur-md mb-8">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">Kiến thức & Kinh nghiệm</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight leading-tight">
                Góc chia sẻ <br>
                <span class="text-gradient">Chuyên gia Digital</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto font-light">
                Cập nhật những xu hướng công nghệ mới nhất, bí quyết kinh doanh online và thủ thuật tối ưu website thực chiến.
            </p>

            <div class="relative max-w-2xl mx-auto group">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative flex items-center bg-slate-800 rounded-full p-2 border border-slate-700 shadow-2xl">
                    <div class="pl-6 text-slate-400"><i data-lucide="search" class="w-6 h-6"></i></div>
                    <input type="text" placeholder="Tìm kiếm bài viết? (VD: SEO, Marketing, Hosting...)"
                        class="w-full bg-transparent text-white px-4 py-3 focus:outline-none placeholder-slate-500">
                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-full font-bold transition-all shadow-lg shadow-orange-600/20">
                        Tìm kiếm
                    </button>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-3 text-sm text-slate-400">
                <span>Chủ đề hot:</span>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Tối ưu SEO</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Google Ads</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Content Marketing</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Thủ thuật Web</a>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 min-h-screen relative">
    <div class="container mx-auto px-4 relative z-10">

        <div class="flex flex-col lg:flex-row gap-12">

            <div class="w-full lg:w-8/12">

                <a href="/blog-detail" class="group block relative rounded-3xl overflow-hidden bg-white shadow-xl hover:shadow-2xl transition-all duration-300 mb-12 border border-slate-200">
                    <div class="relative aspect-video overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent z-10"></div>
                        <img src="<?= $featured_post['image'] ?>" alt="Featured" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">

                        <div class="absolute top-6 left-6 z-20">
                            <span class="bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Tiêu điểm</span>
                        </div>

                        <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 z-20">
                            <div class="flex items-center gap-4 text-slate-300 text-sm mb-3">
                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-4 h-4 text-orange-500"></i> <?= $featured_post['date'] ?></span>
                                <span class="flex items-center gap-1"><i data-lucide="user" class="w-4 h-4 text-orange-500"></i> <?= $featured_post['author'] ?></span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3 leading-tight group-hover:text-orange-400 transition-colors">
                                <?= $featured_post['title'] ?>
                            </h2>
                            <p class="text-slate-300 line-clamp-2 md:line-clamp-none mb-4 hidden md:block">
                                <?= $featured_post['desc'] ?>
                            </p>
                            <span class="inline-flex items-center text-white font-bold border-b-2 border-orange-500 group-hover:text-orange-400 transition-colors pb-1">
                                Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach ($posts as $post): ?>
                        <a href="/blog-detail" class="group block bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                            <div class="relative overflow-hidden aspect-[16/10]">
                                <span class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-sm text-slate-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-slate-200">
                                    <?= $post['cat'] ?>
                                </span>
                                <img src="<?= $post['image'] ?>" alt="Blog" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>

                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> <?= $post['date'] ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> <?= $post['views'] ?></span>
                                </div>

                                <h3 class="text-lg font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                    <?= $post['title'] ?>
                                </h3>

                                <div class="mt-auto pt-4 border-t border-slate-50">
                                    <span class="text-sm font-semibold text-slate-600 group-hover:text-orange-600 flex items-center gap-1">
                                        Xem chi tiết <i data-lucide="chevron-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="mt-20 flex justify-center">
                    <div class="bg-white p-2 rounded-full shadow-lg border border-slate-100 inline-flex items-center gap-2">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-900 text-white font-bold shadow-md">1</a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 font-bold hover:bg-orange-50 hover:text-orange-600 transition-all">2</a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 font-bold hover:bg-orange-50 hover:text-orange-600 transition-all">3</a>
                        <span class="w-10 h-10 flex items-center justify-center text-slate-300 font-bold">...</span>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-4/12 space-y-8">

                <div class="bg-slate-900 rounded-3xl p-8 text-center relative overflow-hidden shadow-xl">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 rounded-full blur-[60px] opacity-20"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-orange-500 mx-auto mb-4 border border-white/10">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Đăng ký nhận tin</h4>
                        <p class="text-slate-400 text-sm mb-6">Nhận các bài viết mới nhất về kinh doanh online và mã giảm giá hàng tuần.</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Email của bạn..." class="w-full bg-slate-800 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-orange-500 transition-colors">
                            <button class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg">Đăng ký ngay</button>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-2">Từ khóa hot</h4>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $tags = ['SEO', 'Google Ads', 'Facebook', 'Livestream', 'Hosting', 'SSL', 'Tốc độ web', 'UX/UI', 'Content'];
                        foreach ($tags as $t): ?>
                            <a href="#" class="px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-lg hover:bg-orange-500 hover:text-white transition-all border border-slate-100">
                                #<?= $t ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <a href="/dich-vu" class="block relative rounded-3xl overflow-hidden aspect-[3/4] group cursor-pointer shadow-xl border border-slate-800/50 bg-slate-900">

                    <div class="absolute inset-0">
                        <svg viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <defs>
                                <linearGradient id="growthGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#f97316;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#fbbf24;stop-opacity:1" />
                                </linearGradient>
                            </defs>

                            <circle cx="50%" cy="30%" r="100" fill="#f97316" opacity="0.2" style="filter: blur(60px);"></circle>
                            <circle cx="80%" cy="80%" r="80" fill="#4f46e5" opacity="0.15" style="filter: blur(50px);"></circle>

                            <g class="transition-transform duration-700 ease-out group-hover:-translate-y-4">
                                <circle cx="150" cy="180" r="80" stroke="white" stroke-width="1.5" fill="none" opacity="0.1"></circle>
                                <circle cx="150" cy="180" r="60" stroke="white" stroke-width="2" fill="none" opacity="0.2" stroke-dasharray="8 12"></circle>

                                <path d="M150 100 L120 160 L150 140 L180 160 Z" fill="url(#growthGrad)" filter="drop-shadow(0 10px 20px rgba(249, 115, 22, 0.4))" />

                                <circle cx="150" cy="140" r="12" fill="white"></circle>
                                <ellipse cx="150" cy="220" rx="60" ry="15" fill="#ffffff" opacity="0.05"></ellipse>
                            </g>
                        </svg>
                    </div>

                    <div class="absolute inset-0 flex flex-col items-center justify-end text-center p-8 z-20 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent">

                        <span class="inline-block text-orange-400 font-bold tracking-widest uppercase text-[11px] mb-3 bg-slate-950/80 px-3 py-1 rounded-full border border-orange-500/20 backdrop-blur-md">
                            Giải pháp doanh nghiệp
                        </span>

                        <h3 class="text-2xl font-extrabold text-white mb-3 leading-tight">
                            Tăng Trưởng Số <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">Đột Phá Doanh Thu</span>
                        </h3>

                        <p class="text-slate-300 text-sm mb-6 opacity-90">
                            Chiến lược Web & Marketing tổng thể giúp bạn dẫn đầu thị trường.
                        </p>

                        <span class="w-full py-3.5 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-2xl font-bold text-sm shadow-lg shadow-orange-600/30 group-hover:shadow-orange-600/50 transition-all transform group-hover:scale-[1.02] flex items-center justify-center gap-2">
                            Nhận tư vấn miễn phí <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

            </div>

        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>