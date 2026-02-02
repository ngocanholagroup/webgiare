<?php
// Gọi Header
include 'includes/header.php';

// --- MOCK DATA (Dữ liệu giả lập thay cho DB) ---
// Trong thực tế, bạn sẽ dùng $id từ Router để query DB: 
// $template = $db->query("SELECT * FROM templates WHERE id = $id");

$template = [
    'id' => 1,
    'name' => 'TechZone - Siêu thị Điện máy & Công nghệ',
    'cat' => 'Thương mại điện tử',
    'price' => '2.500.000đ',
    'old_price' => '3.500.000đ',
    'sku' => 'THEME-001',
    'desc' => 'TechZone là mẫu website bán hàng hiện đại, được thiết kế tối ưu chuyên biệt cho các ngành hàng điện tử, máy tính, điện thoại hoặc phụ kiện công nghệ. Giao diện tập trung vào trải nghiệm mua hàng nhanh chóng, bộ lọc sản phẩm thông minh và hiển thị tốt trên mọi thiết bị di động.',
    'features' => [
        'Giao diện Mobile-First tối ưu trải nghiệm vuốt chạm',
        'Bộ lọc sản phẩm đa tầng (Giá, Thương hiệu, Cấu hình)',
        'Tích hợp tính năng Mua nhanh / Giỏ hàng Ajax',
        'Tối ưu SEO On-page (Schema Product, Breadcrumb)',
        'Tốc độ tải trang đạt 95/100 Google PageSpeed'
    ],
    'tech_specs' => ['HTML5', 'CSS3', 'Bootstrap 5', 'jQuery', 'PHP 8'],
    'images' => [
        'main' => 'https://cdn.dribbble.com/users/1615584/screenshots/15668383/media/89d1a8c3d9806f3621453916962f9095.jpg', // Ảnh chính
        'sub1' => 'https://cdn.dribbble.com/users/1615584/screenshots/14686948/media/25292415d86b71887e2213a48e89b25a.jpg', // Ảnh trang danh mục
        'sub2' => 'https://cdn.dribbble.com/users/702789/screenshots/16900609/media/c8a24c084f938b25121b6d194564249a.png', // Ảnh trang chi tiết
    ]
];
?>

<style>
    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px; /* Cách đỉnh màn hình 100px khi cuộn */
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<section class="bg-slate-900 pt-28 pb-12 lg:pt-36 lg:pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/20 rounded-full blur-[120px] pointer-events-none translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <nav class="flex text-sm text-slate-400 mb-6">
            <a href="/" class="hover:text-white transition-colors">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="/kho-giao-dien" class="hover:text-white transition-colors">Kho giao diện</a>
            <span class="mx-2">/</span>
            <span class="text-orange-500 font-bold truncate"><?= $template['name'] ?></span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <div class="w-full lg:w-7/12 text-white">
                <div class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-white uppercase bg-orange-600 rounded-full">
                    <?= $template['cat'] ?>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight">
                    <?= $template['name'] ?>
                </h1>
                <p class="text-slate-400 text-lg mb-8 max-w-2xl leading-relaxed">
                    Mã sản phẩm: <span class="text-white font-mono"><?= $template['sku'] ?></span> <br>
                    Giao diện bán hàng chuyên nghiệp, chuẩn SEO, tối ưu tỷ lệ chuyển đổi đơn hàng.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="#demo" class="px-8 py-3.5 bg-white text-slate-900 font-bold rounded-full hover:bg-orange-50 transition-colors flex items-center gap-2">
                        <i data-lucide="eye" class="w-5 h-5"></i> Xem Demo Trực tiếp
                    </a>
                    <a href="#chi-tiet" class="px-8 py-3.5 bg-slate-800 text-white border border-slate-700 font-bold rounded-full hover:border-orange-500 hover:text-orange-500 transition-colors flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Thông tin chi tiết
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-5/12">
                <div class="relative rounded-xl overflow-hidden shadow-2xl border-4 border-slate-800 group">
                    <img src="<?= $template['images']['main'] ?>" alt="<?= $template['name'] ?>" class="w-full h-auto transform group-hover:scale-105 transition-transform duration-700">
                    <a href="#demo" class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/50 text-white hover:scale-110 transition-transform">
                            <i data-lucide="play" class="w-8 h-8 fill-current"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 min-h-screen" id="chi-tiet">
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <div class="w-full lg:w-8/12 space-y-12">
                
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i data-lucide="image" class="w-5 h-5 text-orange-500"></i> Hình ảnh giao diện
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <img src="<?= $template['images']['main'] ?>" class="rounded-lg shadow-sm border border-slate-100 hover:shadow-lg transition-shadow cursor-pointer">
                        <img src="<?= $template['images']['sub1'] ?>" class="rounded-lg shadow-sm border border-slate-100 hover:shadow-lg transition-shadow cursor-pointer">
                        <div class="md:col-span-2">
                            <img src="<?= $template['images']['sub2'] ?>" class="w-full rounded-lg shadow-sm border border-slate-100 hover:shadow-lg transition-shadow cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-orange-500"></i> Mô tả chi tiết
                    </h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed mb-8">
                        <p><?= $template['desc'] ?></p>
                    </div>

                    <h4 class="font-bold text-slate-900 mb-4">Tính năng nổi bật:</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-8">
                        <?php foreach($template['features'] as $feat): ?>
                        <li class="flex items-start gap-2 text-sm text-slate-600">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-green-500 shrink-0 mt-0.5"></i>
                            <?= $feat ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <h4 class="font-bold text-slate-900 mb-4">Công nghệ sử dụng:</h4>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach($template['tech_specs'] as $tech): ?>
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-md border border-slate-200">
                            <?= $tech ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center gap-8">
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full border-4 border-green-500 flex items-center justify-center text-3xl font-bold text-green-600 mb-2">98</div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mobile Score</span>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full border-4 border-green-500 flex items-center justify-center text-3xl font-bold text-green-600 mb-2">100</div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Desktop Score</span>
                    </div>
                    <div class="flex-1 text-center md:text-left border-t md:border-t-0 md:border-l border-slate-100 pt-6 md:pt-0 md:pl-8">
                        <h4 class="font-bold text-slate-900 mb-2">Tối ưu hóa Core Web Vitals</h4>
                        <p class="text-sm text-slate-500">
                            Giao diện này đã được tối ưu mã nguồn, nén ảnh và cache để đạt điểm xanh tuyệt đối trên Google PageSpeed Insights. Tốt cho SEO và trải nghiệm người dùng.
                        </p>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-4/12 relative">
                <div class="sticky-sidebar space-y-6">
                    
                    <div class="bg-white rounded-2xl p-6 shadow-xl shadow-orange-500/5 border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500/10 rounded-bl-full -mr-4 -mt-4"></div>
                        
                        <div class="mb-6">
                            <span class="text-sm text-slate-500 line-through block"><?= $template['old_price'] ?></span>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-extrabold text-orange-600"><?= $template['price'] ?></span>
                                <span class="bg-orange-100 text-orange-700 text-xs font-bold px-2 py-1 rounded">-30%</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">Thanh toán 1 lần - Sở hữu vĩnh viễn</p>
                        </div>

                        <div class="space-y-3 mb-6">
                            <a href="/lien-he?template=<?= $template['sku'] ?>" class="w-full py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 flex items-center justify-center gap-2 transition-all transform hover:-translate-y-1">
                                <i data-lucide="shopping-bag" class="w-5 h-5"></i> Mua giao diện này
                            </a>
                            <a href="#" class="w-full py-3 bg-white border-2 border-slate-200 text-slate-700 font-bold rounded-xl hover:border-orange-500 hover:text-orange-600 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="eye" class="w-5 h-5"></i> Xem Demo
                            </a>
                        </div>

                        <div class="space-y-3 pt-6 border-t border-slate-100">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i> Miễn phí cài đặt Demo
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i> Tặng Hosting 1GB (1 năm)
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i> Bảo hành lỗi code trọn đời
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900 rounded-2xl p-6 text-white text-center">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 text-orange-500">
                            <i data-lucide="headphones" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold mb-2">Cần tư vấn thêm?</h4>
                        <p class="text-slate-400 text-sm mb-4">Đội ngũ kỹ thuật sẵn sàng giải đáp mọi thắc mắc của bạn.</p>
                        <a href="tel:0973157932" class="text-orange-400 font-bold hover:text-white transition-colors">0973.157.932</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-white border-t border-slate-100">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Có thể bạn sẽ thích</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php for($i=1; $i<=4; $i++): ?>
            <div class="group bg-white rounded-xl overflow-hidden border border-slate-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                <div class="relative overflow-hidden aspect-[4/3] bg-slate-200">
                    <div class="w-full h-full bg-cover bg-center transform group-hover:scale-110 transition-transform duration-500"
                         style="background-image: url('https://cdn.dribbble.com/users/1615584/screenshots/15668383/media/89d1a8c3d9806f3621453916962f9095.jpg');"></div>
                </div>
                <div class="p-4">
                    <h3 class="text-sm font-bold text-slate-900 mb-1 truncate">Giao diện Bán hàng Số <?= $i ?></h3>
                    <div class="flex items-center justify-between">
                        <span class="text-orange-600 font-bold text-sm">2.500.000đ</span>
                        <a href="#" class="text-xs text-slate-500 hover:text-orange-500 flex items-center">Chi tiết <i data-lucide="arrow-right" class="w-3 h-3 ml-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<?php
// Gọi Footer
include 'includes/footer.php';
?>