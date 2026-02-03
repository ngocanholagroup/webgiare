<?php
// Gọi Header
include 'includes/header.php';

// Dữ liệu giả lập
// Đã loại bỏ icon
$categories = [
    'all' => ['name' => 'Tất cả'],
    'ban-hang' => ['name' => 'Bán hàng'],
    'bds' => ['name' => 'Bất động sản'],
    'doanh-nghiep' => ['name' => 'Doanh nghiệp'],
    'landing' => ['name' => 'Landing Page'],
    'blog' => ['name' => 'Blog/Tin tức']
];

// Đã loại bỏ 'tag' và 'tag_color' cho gọn code
$templates = [
    [
        'id' => 1,
        'name' => 'TechZone - Siêu thị điện máy',
        'cat' => 'Bán hàng',
        'image' => 'https://cdn.dribbble.com/users/1615584/screenshots/15668383/media/89d1a8c3d9806f3621453916962f9095.jpg',
        'price' => '2.500.000đ',
        'sale_price' => '1.990.000đ',
    ],
    [
        'id' => 2,
        'name' => 'Luxury Home - BĐS Cao cấp',
        'cat' => 'Bất động sản',
        'image' => 'https://cdn.dribbble.com/users/702789/screenshots/16900609/media/c8a24c084f938b25121b6d194564249a.png',
        'price' => '3.500.000đ',
        'sale_price' => null,
    ],
    [
        'id' => 3,
        'name' => 'Agency Creative Pro',
        'cat' => 'Doanh nghiệp',
        'image' => 'https://cdn.dribbble.com/users/418188/screenshots/16386596/media/53239a2444634734892c908f5127602f.jpg',
        'price' => 'Liên hệ',
        'sale_price' => null,
    ],
    [
        'id' => 4,
        'name' => 'Organic Fresh Food',
        'cat' => 'Bán hàng',
        'image' => 'https://cdn.dribbble.com/users/2308947/screenshots/15367687/media/e14316333c5095e263c9b7405f60b459.jpg',
        'price' => '2.800.000đ',
        'sale_price' => '2.500.000đ',
    ],
    [
        'id' => 5,
        'name' => 'EduMaster - Khóa học Online',
        'cat' => 'Giáo dục',
        'image' => 'https://cdn.dribbble.com/users/1998175/screenshots/16335181/media/2e538c22709295551711200923055375.jpg',
        'price' => '3.500.000đ',
        'sale_price' => null,
    ],
    [
        'id' => 6,
        'name' => 'Spa & Beauty Center',
        'cat' => 'Làm đẹp',
        'image' => 'https://cdn.dribbble.com/users/1728196/screenshots/16086961/media/0117462432a559869680c2f808791054.png',
        'price' => '2.500.000đ',
        'sale_price' => null,
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
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<section class="relative pt-32 pb-24 lg:pt-48 lg:pb-32 bg-slate-900 overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[120px] animate-blob"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-500/20 rounded-full blur-[120px] animate-blob animation-delay-2000"></div>
    <div class="absolute inset-0 bg-noise opacity-20 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-800/50 border border-slate-700 backdrop-blur-md mb-8">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">Cập nhật 20+ mẫu mới tháng này</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight leading-tight">
                Chọn giao diện <br>
                <span class="text-gradient">Xứng tầm thương hiệu</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto font-light">
                Hơn 500+ giao diện website chuẩn SEO, tối ưu UI/UX cho mọi ngành nghề. 
            </p>

            <div class="relative max-w-2xl mx-auto group">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative flex items-center bg-slate-800 rounded-full p-2 border border-slate-700 shadow-2xl">
                    <div class="pl-6 text-slate-400"><i data-lucide="search" class="w-6 h-6"></i></div>
                    <input type="text" placeholder="Bạn đang tìm mẫu web gì?" class="w-full bg-transparent text-white px-4 py-3 focus:outline-none placeholder-slate-500">
                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-full font-bold transition-all shadow-lg shadow-orange-600/20">Tìm kiếm</button>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-3 text-sm text-slate-400">
                <span>Gợi ý:</span>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Landing Page</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Bất động sản</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Mỹ phẩm</a>
                <a href="#" class="hover:text-orange-400 underline decoration-dotted">Công ty</a>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 min-h-screen relative">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="sticky top-[80px] z-30 mb-12 py-4 bg-slate-50/95 backdrop-blur-sm transition-all">
            <div class="flex overflow-x-auto gap-3 p-2 scrollbar-hide md:justify-center">
                <?php foreach($categories as $key => $cat): ?>
                    <a href="?cat=<?= $key ?>" 
                       class="group flex items-center gap-2 px-6 py-3 rounded-full text-sm font-bold transition-all border whitespace-nowrap
                       <?= ($key === 'all') 
                           ? 'bg-slate-900 text-white border-slate-900 shadow-xl shadow-slate-900/20 ring-2 ring-offset-2 ring-slate-900' 
                           : 'bg-white text-slate-600 border-slate-200 hover:border-orange-500 hover:text-orange-600 hover:shadow-md' 
                       ?>">
                        <?= $cat['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <?php foreach($templates as $item): ?>
            <a href="/lien-he" class="group relative flex flex-col bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500 block">
                
                <div class="h-8 bg-slate-100 rounded-t-2xl border-b border-slate-200 flex items-center px-4 gap-2">
                    <div class="flex gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                    </div>
                    <div class="mx-auto w-1/2 h-4 bg-white rounded-md flex items-center justify-center text-[8px] text-slate-400 font-mono tracking-tighter">
                        <i data-lucide="lock" class="w-2 h-2 mr-1"></i> secure-site.com
                    </div>
                </div>

                <div class="relative overflow-hidden aspect-[4/3] bg-slate-200 group-hover:rounded-b-none transition-all">
                    
                    <div class="w-full h-full bg-cover bg-top transform group-hover:scale-110 group-hover:rotate-1 transition-transform duration-700 ease-out"
                         style="background-image: url('<?= $item['image'] ?>');">
                         <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 opacity-50 mix-blend-multiply"></div>
                    </div>

                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px] flex items-center justify-center">
                        <span class="bg-orange-600 text-white px-6 py-2.5 rounded-full font-bold shadow-xl shadow-orange-600/30 transform scale-95 hover:scale-105 hover:bg-orange-700 transition-all duration-300 flex items-center gap-2">
                            Xem chi tiết
                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1 relative">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider"><?= $item['cat'] ?></span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-2 leading-tight group-hover:text-orange-600 transition-colors">
                        <?= $item['name'] ?>
                    </h3>
                    
                    <div class="w-full h-px bg-slate-100 my-4"></div>

                    <div class="mt-auto flex items-end justify-between">
                        <div>
                            <?php if($item['sale_price']): ?>
                                <span class="text-slate-400 text-xs font-medium line-through block mb-0.5"><?= $item['price'] ?></span>
                                <span class="text-lg font-extrabold text-orange-600"><?= $item['sale_price'] ?></span>
                            <?php else: ?>
                                <span class="text-slate-400 text-xs font-medium block mb-0.5">Giá trọn gói</span>
                                <span class="text-lg font-extrabold text-slate-900"><?= $item['price'] ?></span>
                            <?php endif; ?>
                        </div>
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
</section>

<section class="py-24 bg-white border-t border-slate-100 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="relative bg-gradient-to-r from-orange-500 to-pink-600 rounded-[2.5rem] p-12 md:p-20 overflow-hidden text-center shadow-2xl shadow-orange-500/30">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Không tìm thấy mẫu ưng ý?</h2>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/lien-he" class="px-8 py-4 bg-white text-orange-600 font-bold rounded-full shadow-xl hover:bg-slate-900 hover:text-white transition-all flex items-center justify-center gap-2">
                        <i data-lucide="pen-tool" class="w-5 h-5"></i> Đặt thiết kế riêng
                    </a>
                    <a href="https://zalo.me/0973157932" class="px-8 py-4 bg-orange-700/50 text-white font-bold rounded-full border border-white/20 hover:bg-orange-700 transition-all flex items-center justify-center gap-2 backdrop-blur-sm">
                        <i data-lucide="message-circle" class="w-5 h-5"></i> Chat tư vấn Zalo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>