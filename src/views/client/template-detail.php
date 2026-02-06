<?php
// views/client/template-detail.php
include 'includes/header.php';

// Lưu ý: Các biến $template, $related_templates, $schema_json đã được Controller truyền sang.
?>

<?php if (isset($schema_json)): ?>
    <script type="application/ld+json">
        <?= $schema_json ?>
    </script>
<?php endif; ?>

<style>
    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Animation cho Lightbox */
    .scale-enter {
        transform: scale(0.95);
        opacity: 0;
    }

    .scale-enter-active {
        transform: scale(1);
        opacity: 1;
        transition: all 0.3s ease-out;
    }

    .scale-exit {
        transform: scale(1);
        opacity: 1;
    }

    .scale-exit-active {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.2s ease-in;
    }
</style>

<section class="bg-slate-900 pt-28 pb-12 lg:pt-36 lg:pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/20 rounded-full blur-[120px] pointer-events-none translate-x-1/2 -translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <div class="w-full lg:w-7/12 text-white">
                <div class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-white uppercase bg-orange-600 rounded-full">
                    <?= htmlspecialchars($template['cat_name']) ?>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight">
                    <?= htmlspecialchars($template['name']) ?>
                </h1>
                <p class="text-slate-400 text-lg mb-8 max-w-2xl leading-relaxed">
                    Mã sản phẩm: <span class="text-white font-mono"><?= htmlspecialchars($template['sku']) ?></span> <br>
                    <?= substr(strip_tags($template['description']), 0, 150) ?>...
                </p>

                <div class="flex gap-4 justify-center lg:justify-start">
                    <a href="#demo" class="px-8 py-3.5 bg-white text-slate-900 font-bold rounded-full hover:bg-orange-50 transition-colors flex items-center gap-2">
                        <i data-lucide="eye" class="w-5 h-5"></i> Demo
                    </a>
                    <a href="#chi-tiet" class="px-8 py-3.5 bg-slate-800 text-white border border-slate-700 font-bold rounded-full hover:border-orange-500 hover:text-orange-500 transition-colors flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Chi Tiết
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-5/12">
                <div class="relative rounded-xl overflow-hidden shadow-2xl border-4 border-slate-800 group aspect-[16/10]">
                    <img src="<?= htmlspecialchars($template['image_desktop']) ?>" alt="<?= htmlspecialchars($template['name']) ?>" class="w-full h-full object-cover object-top transform group-hover:scale-105 transition-transform duration-700">
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

                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100" id="demo">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="monitor-smartphone" class="w-5 h-5 text-orange-500"></i> Demo Giao diện
                        </h3>
                        <div class="bg-slate-100 p-1 rounded-lg inline-flex self-start md:self-auto">
                            <button onclick="switchView('desktop')" id="btn-desktop" class="px-4 py-2 rounded-md text-sm font-bold transition-all bg-white text-orange-600 shadow-sm flex items-center gap-2">
                                <i data-lucide="monitor" class="w-4 h-4"></i> Desktop
                            </button>
                            <button onclick="switchView('mobile')" id="btn-mobile" class="px-4 py-2 rounded-md text-sm font-bold transition-all text-slate-500 hover:text-slate-900 flex items-center gap-2">
                                <i data-lucide="smartphone" class="w-4 h-4"></i> Mobile
                            </button>
                        </div>
                    </div>

                    <div class="relative bg-slate-50 rounded-2xl border border-slate-100 p-2 md:p-6 flex items-center justify-center min-h-[500px] lg:min-h-[600px] overflow-hidden">
                        <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] opacity-50"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-500/5 rounded-full blur-3xl"></div>

                        <div id="view-desktop" class="relative w-full max-w-6xl transition-all duration-500 ease-out transform opacity-100 scale-100 mx-auto">
                            <div class="relative mx-auto shadow-2xl">
                                <div class="relative w-full aspect-[16/10] bg-white rounded-xl overflow-hidden border-[1px] md:border-[6px] border-slate-800">
                                    <div class="h-5 md:h-8 bg-slate-800 flex items-center gap-1.5 px-4">
                                        <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-red-500/80"></div>
                                        <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-yellow-500/80"></div>
                                        <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-green-500/80"></div>
                                        <div class="ml-2 md:ml-4 flex-1 h-3 md:h-5 bg-slate-700/50 rounded-md"></div>
                                    </div>

                                    <div class="w-full h-[calc(100%-20px)] md:h-[calc(100%-32px)] overflow-y-auto scrollbar-hide bg-white group">
                                        <img src="<?= htmlspecialchars($template['image_desktop']) ?>"
                                            class="w-full h-auto shadow-sm group-hover:-translate-y-[calc(100%-300px)] transition-transform duration-[4000ms] ease-in-out">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="view-mobile" class="absolute inset-0 flex items-center justify-center transition-all duration-500 ease-out transform opacity-0 scale-90 pointer-events-none">
                            <div class="relative w-[280px] h-[580px] md:w-[300px] md:h-[600px] bg-slate-900 rounded-[3rem] shadow-2xl border-[8px] border-slate-800">
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-7 bg-slate-900 rounded-b-2xl z-20 flex justify-center items-center">
                                    <div class="w-10 h-1 bg-slate-800 rounded-full opacity-50"></div>
                                </div>
                                <div class="w-full h-full bg-white rounded-[2.5rem] overflow-hidden relative">
                                    <div class="w-full h-full overflow-y-auto scrollbar-hide">
                                        <img src="<?= htmlspecialchars($template['image_mobile']) ?>"
                                            class="w-full h-auto min-h-full object-cover object-top">
                                    </div>
                                    <div class="absolute top-2 left-6 text-[10px] font-bold text-slate-900 z-10">9:41</div>
                                    <div class="absolute top-2 right-6 flex gap-1 z-10">
                                        <div class="w-3 h-3 rounded-full border border-slate-900"></div>
                                        <div class="w-3 h-3 bg-slate-900 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-orange-500"></i> Mô tả chi tiết
                    </h3>

                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed mb-8">
                        <?= $template['description'] ?>
                    </div>

                    <?php if (!empty($template['features'])): ?>
                        <h4 class="font-bold text-slate-900 mb-4">Tính năng nổi bật:</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-8">
                            <?php foreach ($template['features'] as $feat): ?>
                                <li class="flex items-start gap-2 text-sm text-slate-600">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-green-500 shrink-0 mt-0.5"></i>
                                    <?= htmlspecialchars($feat) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (!empty($template['tech_specs'])): ?>
                        <h4 class="font-bold text-slate-900 mb-4">Công nghệ sử dụng:</h4>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($template['tech_specs'] as $tech): ?>
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-md border border-slate-200">
                                    <?= htmlspecialchars($tech) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center gap-8">
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full border-4 border-green-500 flex items-center justify-center text-3xl font-bold text-green-600 mb-2"><?= $template['score_mobile'] ?></div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mobile Score</span>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full border-4 border-green-500 flex items-center justify-center text-3xl font-bold text-green-600 mb-2"><?= $template['score_desktop'] ?></div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Desktop Score</span>
                    </div>
                    <div class="flex-1 text-center md:text-left border-t md:border-t-0 md:border-l border-slate-100 pt-6 md:pt-0 md:pl-8">
                        <h4 class="font-bold text-slate-900 mb-2">Tối ưu hóa Core Web Vitals</h4>
                        <p class="text-sm text-slate-500">
                            Giao diện này đã được tối ưu mã nguồn, nén ảnh và cache để đạt điểm xanh tuyệt đối trên Google PageSpeed Insights. Tốt cho SEO và trải nghiệm người dùng.
                        </p>
                    </div>
                </div>

                <?php if (!empty($template['images']['gallery'])): ?>
                    <div class="pt-8 border-t border-slate-100">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i data-lucide="image" class="w-5 h-5 text-orange-500"></i> Ảnh thực tế (Screenshots)
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="aspect-video cursor-pointer group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100" onclick="openLightbox('<?= $template['images']['main'] ?>')">
                                <img src="<?= htmlspecialchars($template['images']['main']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <i data-lucide="zoom-in" class="w-8 h-8 text-white"></i>
                                </div>
                            </div>

                            <?php foreach ($template['images']['gallery'] as $img): ?>
                                <div class="aspect-video cursor-pointer group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100" onclick="openLightbox('<?= htmlspecialchars($img) ?>')">
                                    <img src="<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <i data-lucide="zoom-in" class="w-8 h-8 text-white"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <div class="w-full lg:w-4/12 relative">
                <div class="sticky-sidebar space-y-6">
                    <div class="bg-white rounded-2xl p-6 shadow-xl shadow-orange-500/5 border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500/10 rounded-bl-full -mr-4 -mt-4"></div>

                        <div class="mb-6">
                            <?php if ($template['old_price_text']): ?>
                                <span class="text-sm text-slate-500 line-through block"><?= $template['old_price_text'] ?></span>
                            <?php endif; ?>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-extrabold text-orange-600"><?= $template['price_text'] ?></span>
                                <?php if ($template['old_price_text']): ?>
                                    <span class="bg-orange-100 text-orange-700 text-xs font-bold px-2 py-1 rounded">-30%</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">Thanh toán 1 lần - Sở hữu vĩnh viễn</p>
                        </div>

                        <div class="space-y-3 mb-6">
                            <a href="/lien-he?template=<?= $template['sku'] ?>" class="w-full py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 flex items-center justify-center gap-2 transition-all transform hover:-translate-y-1">
                                <i data-lucide="shopping-bag" class="w-5 h-5"></i> Mua giao diện này
                            </a>
                            <?php if (!empty($template['demo_url'])): ?>
                                <a href="<?= $template['demo_url'] ?>" target="_blank" class="w-full py-3 bg-white border-2 border-slate-200 text-slate-700 font-bold rounded-xl hover:border-orange-500 hover:text-orange-600 transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="eye" class="w-5 h-5"></i> Xem Demo
                                </a>
                            <?php endif; ?>
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
                        <a href="tel:<?= setting('company_phone') ?>" class="text-orange-400 font-bold hover:text-white transition-colors">
                            <?= setting('company_phone', '0973.157.932') ?>
                        </a>
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
            <?php if (!empty($related_templates)): ?>
                <?php foreach ($related_templates as $item):
                    $has_sale = ($item['sale_price'] > 0 && $item['sale_price'] < $item['price']);
                    $thumb = !empty($item['image_desktop']) ? $item['image_desktop'] : 'https://placehold.co/600x400?text=No+Image';
                ?>
                    <div class="group bg-white rounded-xl overflow-hidden border border-slate-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                        <a href="/kho-giao-dien/<?= htmlspecialchars($item['slug'] ?? '') ?>" class="block">

                            <div class="relative overflow-hidden aspect-[16/10] bg-slate-200">
                                <div class="w-full h-full bg-cover bg-top transform group-hover:scale-110 transition-transform duration-500"
                                    style="background-image: url('<?= htmlspecialchars($thumb) ?>');"></div>
                            </div>

                            <div class="p-4">
                                <h3 class="text-sm font-bold text-slate-900 mb-1 truncate"><?= htmlspecialchars($item['name'] ?? 'Chưa có tên') ?></h3>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <?php if ($has_sale): ?>
                                            <span class="text-orange-600 font-bold text-sm"><?= number_format($item['sale_price'], 0, ',', '.') ?>đ</span>
                                            <span class="text-slate-400 text-xs line-through ml-1"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                                        <?php else: ?>
                                            <span class="text-slate-900 font-bold text-sm"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs text-slate-500 hover:text-orange-500 flex items-center">Chi tiết <i data-lucide="arrow-right" class="w-3 h-3 ml-1"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-slate-500 text-sm">Chưa có giao diện liên quan nào.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/90 hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-white hover:text-orange-500 transition-colors z-50">
        <i data-lucide="x" class="w-10 h-10"></i>
    </button>
    <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
</div>

<script>
    // 1. Chuyển đổi Desktop/Mobile View
    function switchView(device) {
        const desktopView = document.getElementById('view-desktop');
        const mobileView = document.getElementById('view-mobile');
        const btnDesktop = document.getElementById('btn-desktop');
        const btnMobile = document.getElementById('btn-mobile');

        const activeClass = "bg-white text-orange-600 shadow-sm".split(" ");
        const inactiveClass = "text-slate-500 hover:text-slate-900".split(" ");

        if (device === 'desktop') {
            desktopView.classList.remove('opacity-0', 'scale-90', 'pointer-events-none', 'absolute');
            desktopView.classList.add('opacity-100', 'scale-100', 'relative');

            mobileView.classList.add('opacity-0', 'scale-90', 'pointer-events-none', 'absolute');
            mobileView.classList.remove('opacity-100', 'scale-100', 'relative');

            btnDesktop.classList.add(...activeClass);
            btnDesktop.classList.remove(...inactiveClass);
            btnMobile.classList.remove(...activeClass);
            btnMobile.classList.add(...inactiveClass);
        } else {
            mobileView.classList.remove('opacity-0', 'scale-90', 'pointer-events-none', 'absolute');
            mobileView.classList.add('opacity-100', 'scale-100', 'relative');

            desktopView.classList.add('opacity-0', 'scale-90', 'pointer-events-none', 'absolute');
            desktopView.classList.remove('opacity-100', 'scale-100', 'relative');

            btnMobile.classList.add(...activeClass);
            btnMobile.classList.remove(...inactiveClass);
            btnDesktop.classList.remove(...activeClass);
            btnDesktop.classList.add(...inactiveClass);
        }
    }

    // 2. Lightbox Script
    function openLightbox(src) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');

        img.src = src;
        modal.classList.remove('hidden');

        setTimeout(() => {
            modal.classList.remove('opacity-0');
            img.classList.remove('scale-95');
            img.classList.add('scale-100');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');

        modal.classList.add('opacity-0');
        img.classList.remove('scale-100');
        img.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            img.src = '';
        }, 300);

        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

<?php include 'includes/footer.php'; ?>