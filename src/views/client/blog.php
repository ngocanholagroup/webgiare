<?php
// views/client/blog.php
include 'includes/header.php';

// 1. HELPER: Tạo URL giữ tham số (Search + Filter + Page)
function buildUrl($key, $value)
{
    $params = $_GET;
    $params[$key] = $value;
    // Reset về trang 1 nếu thay đổi bộ lọc hoặc tìm kiếm
    if ($key !== 'page') {
        $params['page'] = 1;
    }
    return '?' . http_build_query($params);
}

// 2. Xử lý dữ liệu mặc định
$active_cat = $active_cat ?? 'all';
$keyword = $keyword ?? '';
$posts = $posts ?? [];
$pagination = $pagination ?? ['current_page' => 1, 'total_pages' => 1];
$featured_post = $featured_post ?? null;
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

            <div class="relative max-w-2xl mx-auto group">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative flex items-center bg-slate-800 rounded-full p-2 border border-slate-700 shadow-2xl">
                    <div class="pl-6 text-slate-400"><i data-lucide="search" class="w-6 h-6"></i></div>

                    <form action="" method="GET" class="flex-1 flex">
                        <?php if ($active_cat !== 'all'): ?>
                            <input type="hidden" name="cat" value="<?= htmlspecialchars($active_cat) ?>">
                        <?php endif; ?>

                        <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>"
                            placeholder="Tìm kiếm bài viết? (VD: SEO, Marketing...)"
                            class="w-full bg-transparent text-white px-4 py-3 focus:outline-none placeholder-slate-500">
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-full font-bold transition-all shadow-lg shadow-orange-600/20">
                            Tìm kiếm
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-3 text-sm text-slate-400">
                <span>Chủ đề:</span>
                <a href="<?= buildUrl('cat', 'all') ?>"
                    class="<?= $active_cat == 'all' ? 'text-orange-400 font-bold' : 'hover:text-orange-400' ?> underline decoration-dotted">Tất cả</a>

                <?php if (!empty($categories)): foreach ($categories as $cat): ?>
                        <a href="<?= buildUrl('cat', $cat['slug']) ?>"
                            class="<?= $active_cat == $cat['slug'] ? 'text-orange-400 font-bold' : 'hover:text-orange-400' ?> underline decoration-dotted">
                            <?= $cat['name'] ?>
                        </a>
                <?php endforeach;
                endif; ?>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 min-h-screen relative">
    <div class="container mx-auto px-4 relative z-10">

        <div class="flex flex-col gap-12">
            <div class="w-full">
                <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-2">Từ khóa hot</h4>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $tags = ['SEO', 'Google Ads', 'Facebook', 'Livestream', 'Hosting', 'SSL', 'Tốc độ web', 'UX/UI', 'Content'];
                        foreach ($tags as $t): ?>
                            <a href="?q=<?= $t ?>" class="px-6 py-3 bg-slate-50 text-slate-600 text-xs font-bold rounded-full hover:bg-orange-500 hover:text-white transition-all">
                                #<?= $t ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="w-full">

                <?php if ($featured_post && $pagination['current_page'] == 1 && empty($keyword)): ?>
                    <a href="/tin-tuc/<?= $featured_post['slug'] ?>" class="group block relative rounded-3xl overflow-hidden bg-white shadow-xl hover:shadow-2xl transition-all duration-300 mb-12">
                        <div class="relative aspect-[4/5] md:aspect-video overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent z-10"></div>

                            <img src="<?= !empty($featured_post['thumbnail']) ? $featured_post['thumbnail'] : 'https://placehold.co/800x400' ?>"
                                alt="<?= htmlspecialchars($featured_post['title']) ?>"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">

                            <div class="absolute top-4 left-4 md:top-6 md:left-6 z-20">
                                <span class="bg-orange-600 text-white text-[10px] md:text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Tiêu điểm</span>
                            </div>

                            <div class="absolute bottom-0 left-0 w-full p-5 md:p-8 z-20">
                                <div class="flex items-center gap-3 md:gap-4 text-slate-300 text-xs md:text-sm mb-2 md:mb-3">
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5 md:w-4 md:h-4 text-orange-500"></i> <?= date('d/m/Y', strtotime($featured_post['published_at'])) ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="user" class="w-3.5 h-3.5 md:w-4 md:h-4 text-orange-500"></i> <?= htmlspecialchars($featured_post['author_name'] ?? 'Admin') ?></span>
                                </div>

                                <h2 class="text-xl md:text-3xl font-extrabold text-white mb-3 leading-tight group-hover:text-orange-400 transition-colors line-clamp-3 md:line-clamp-none">
                                    <?= htmlspecialchars($featured_post['title']) ?>
                                </h2>

                                <p class="text-slate-300 line-clamp-2 md:line-clamp-none mb-4 hidden md:block">
                                    <?= htmlspecialchars($featured_post['summary']) ?>
                                </p>

                                <span class="inline-flex items-center text-sm md:text-base text-white font-bold border-b-2 border-orange-500 group-hover:text-orange-400 transition-colors pb-1">
                                    Đọc tiếp <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if (!empty($posts)): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php foreach ($posts as $post): ?>
                            <a href="/tin-tuc/<?= $post['slug'] ?>" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                                <div class="relative overflow-hidden aspect-[16/10]">
                                    <span class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-sm text-slate-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-slate-200">
                                        <?= htmlspecialchars($post['category_name'] ?? 'Tin tức') ?>
                                    </span>

                                    <img src="<?= !empty($post['thumbnail']) ? $post['thumbnail'] : 'https://placehold.co/600x400' ?>"
                                        alt="<?= htmlspecialchars($post['title']) ?>"
                                        loading="lazy"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                </div>

                                <div class="p-6 flex flex-col flex-1">
                                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> <?= date('d/m/Y', strtotime($post['published_at'])) ?></span>
                                        <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> <?= number_format($post['views']) ?></span>
                                    </div>

                                    <h3 class="text-lg font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </h3>

                                    <p class="text-sm text-slate-500 line-clamp-3 mb-4"><?= htmlspecialchars($post['summary']) ?></p>

                                    <div class="mt-auto pt-4 border-t border-slate-50">
                                        <span class="text-sm font-semibold text-slate-600 group-hover:text-orange-600 flex items-center gap-1">
                                            Xem chi tiết <i data-lucide="chevron-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                        <div class="inline-block p-4 rounded-full bg-slate-100 mb-4 text-slate-400">
                            <i data-lucide="search-x" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Không tìm thấy kết quả</h3>
                        <p class="text-slate-500 mt-2">Vui lòng thử từ khóa khác hoặc chọn danh mục khác.</p>
                        <a href="/tin-tuc" class="inline-block mt-4 text-orange-600 font-bold hover:underline">Xem tất cả bài viết</a>
                    </div>
                <?php endif; ?>

                <?php if ($pagination['total_pages'] > 1): ?>
                    <div class="mt-20 flex justify-center">
                        <div class="bg-white p-2 rounded-full shadow-lg border border-slate-100 inline-flex items-center gap-2">

                            <?php if ($pagination['current_page'] > 1): ?>
                                <a href="<?= buildUrl('page', $pagination['current_page'] - 1) ?>" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all">
                                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                                <?php if ($i == $pagination['current_page']): ?>
                                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-900 text-white font-bold shadow-md"><?= $i ?></span>
                                <?php else: ?>
                                    <a href="<?= buildUrl('page', $i) ?>" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 font-bold hover:bg-orange-50 hover:text-orange-600 transition-all"><?= $i ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                                <a href="<?= buildUrl('page', $pagination['current_page'] + 1) ?>" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php
$cta_title = "Sẵn sàng bứt phá doanh thu?";
$cta_desc = "Chiến lược Web & Marketing tổng thể giúp bạn dẫn đầu thị trường.";
$cta_note = "Tư vấn miễn phí 100% • Không phát sinh chi phí";
include 'includes/cta-section.php';
?>

<?php include 'includes/footer.php'; ?>