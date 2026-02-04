<?php
// views/client/blog-detail.php
include 'includes/header.php';

// Các biến đã có từ Controller: $post, $related_posts, $schema_json
// Fallback nếu không có dữ liệu để tránh lỗi
if (empty($post)) {
    echo "<div class='container mx-auto py-20 text-center'>Bài viết không tồn tại.</div>";
    include 'includes/footer.php';
    exit;
}
?>

<?php if(isset($schema_json)): ?>
<script type="application/ld+json">
    <?= $schema_json ?>
</script>
<?php endif; ?>

<style>
    /* Thanh tiến trình đọc */
    #progress-bar {
        width: 0%;
        height: 4px;
        background: linear-gradient(to right, #f97316, #fbbf24);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        transition: width 0.1s;
    }
    
    /* Typography cho bài viết (Tailwind Typography Plugin thay thế thủ công) */
    .article-content h2 { font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-top: 2.5rem; margin-bottom: 1rem; line-height: 1.3; }
    .article-content h3 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-top: 2rem; margin-bottom: 1rem; }
    .article-content p { font-size: 1.1rem; color: #334155; line-height: 1.8; margin-bottom: 1.5rem; }
    .article-content ul, .article-content ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
    .article-content ul { list-style: disc; }
    .article-content ol { list-style: decimal; }
    .article-content li { margin-bottom: 0.5rem; color: #334155; }
    .article-content blockquote { border-left: 4px solid #f97316; padding: 1.5rem; font-style: italic; background: #fff7ed; border-radius: 0 1rem 1rem 0; margin: 2rem 0; color: #475569; }
    .article-content img { border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); margin: 2rem auto; max-width: 100%; height: auto; display: block; }
    .article-content a { color: #f97316; text-decoration: underline; font-weight: 600; }
    
    /* Sticky Sidebar */
    .sticky-toc {
        position: -webkit-sticky;
        position: sticky;
        top: 120px;
    }
    
    /* Style cho mục lục động */
    .toc-link { display: block; padding: 4px 0; color: #64748b; transition: all 0.2s; font-size: 0.9rem; }
    .toc-link:hover, .toc-link.active { color: #ea580c; padding-left: 5px; border-left: 2px solid #ea580c; }
</style>

<div id="progress-bar"></div>

<section class="relative pt-32 pb-16 lg:pt-40 lg:pb-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            
            <div class="inline-flex items-center gap-2 mb-6">
                <a href="/blog?cat=<?= $post['cat_slug'] ?>" class="bg-orange-600 hover:bg-orange-700 transition text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    <?= htmlspecialchars($post['cat_name']) ?>
                </a>
                <span class="text-slate-400 text-sm flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i> <?= $post['reading_time'] ?? 5 ?> phút đọc
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-8 leading-tight">
                <?= htmlspecialchars($post['title']) ?>
            </h1>

            <div class="flex items-center justify-center gap-6 text-slate-400 text-sm md:text-base border-t border-slate-800 pt-8 mt-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-700 rounded-full overflow-hidden border-2 border-slate-600">
                        <img src="<?= !empty($post['author_avatar']) ? $post['author_avatar'] : 'https://ui-avatars.com/api/?name='.urlencode($post['author_name']) ?>" alt="Author" class="w-full h-full object-cover">
                    </div>
                    <div class="text-left">
                        <p class="text-white font-bold"><?= htmlspecialchars($post['author_name']) ?></p>
                        <p class="text-xs">Tác giả</p>
                    </div>
                </div>
                <div class="h-8 w-px bg-slate-800 hidden sm:block"></div>
                <div class="hidden sm:block">
                    <p class="text-white font-bold"><?= date('d/m/Y', strtotime($post['published_at'])) ?></p>
                    <p class="text-xs">Ngày đăng</p>
                </div>
                <div class="h-8 w-px bg-slate-800"></div>
                <div>
                    <p class="text-white font-bold"><?= number_format($post['views']) ?></p>
                    <p class="text-xs">Lượt xem</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-white relative">
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="hidden lg:flex flex-col gap-4 w-12 sticky-toc h-fit">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-[#1877F2] hover:text-white transition-colors" title="Share Facebook"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-orange-500 hover:text-white transition-colors" title="Copy Link"><i data-lucide="link" class="w-5 h-5"></i></a>
            </div>

            <div class="w-full lg:w-8/12">
                
                <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 -mt-24 relative z-20 border-4 border-white aspect-video bg-slate-200">
                    <img src="<?= !empty($post['thumbnail']) ? $post['thumbnail'] : 'https://placehold.co/800x400' ?>" 
                         alt="<?= htmlspecialchars($post['title']) ?>" 
                         class="w-full h-full object-cover">
                </div>

                <article class="article-content max-w-none" id="main-content">
                    <p class="lead text-xl font-medium text-slate-600 mb-8 border-l-4 border-orange-500 pl-4">
                        <?= $post['summary'] ?>
                    </p>

                    <?= $post['content'] ?>
                </article>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    
                    <?php if(!empty($post['tags'])): ?>
                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-sm font-bold text-slate-400 mr-2 flex items-center"><i data-lucide="tag" class="w-4 h-4 mr-1"></i> Tags:</span>
                        <?php foreach($post['tags'] as $tag): ?>
                            <a href="/blog?q=<?= $tag['name'] ?>" class="px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-xs font-bold hover:bg-orange-500 hover:text-white transition-colors">
                                #<?= htmlspecialchars($tag['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="bg-slate-50 rounded-2xl p-6 flex flex-col sm:flex-row items-start gap-4">
                        <div class="w-16 h-16 rounded-full bg-slate-200 flex-shrink-0 overflow-hidden">
                            <img src="<?= !empty($post['author_avatar']) ? $post['author_avatar'] : 'https://ui-avatars.com/api/?name='.urlencode($post['author_name']) ?>" alt="Author">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">
                                <?= htmlspecialchars($post['author_name']) ?> 
                                <span class="text-sm font-normal text-slate-500 ml-2">(<?= htmlspecialchars($post['author_title'] ?? 'Admin') ?>)</span>
                            </h4>
                            <p class="text-slate-500 text-sm mb-3">
                                <?= !empty($post['author_bio']) ? htmlspecialchars($post['author_bio']) : 'Tác giả chưa cập nhật giới thiệu.' ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-3/12 relative hidden lg:block">
                <div class="sticky-toc space-y-8">
                    
                    <div class="border-l-2 border-slate-100 pl-4" id="toc-container">
                        <h4 class="font-bold text-slate-900 mb-4 text-sm uppercase tracking-wider">Mục lục bài viết</h4>
                        <nav class="flex flex-col gap-3 text-sm" id="toc-list">
                            </nav>
                    </div>

                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-center text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500 rounded-full blur-[40px] opacity-20"></div>
                        <h5 class="font-bold text-lg mb-2">Cần Website?</h5>
                        <p class="text-slate-400 text-xs mb-4">Đăng ký ngay để nhận ưu đãi Hosting miễn phí trọn đời.</p>
                        <a href="/lien-he" class="block w-full py-2 bg-white text-orange-600 font-bold rounded-lg text-sm hover:bg-orange-50 transition-colors">Báo giá ngay</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Bài viết liên quan</h2>
        
        <?php if(!empty($related_posts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach($related_posts as $item): ?>
            <a href="/blog/<?= $item['slug'] ?>" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                <div class="aspect-video bg-slate-200 overflow-hidden relative">
                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-[10px] font-bold px-2 py-1 rounded text-slate-800 z-10">
                        <?= htmlspecialchars($item['cat_name']) ?>
                    </span>
                    <img src="<?= !empty($item['thumbnail']) ? $item['thumbnail'] : 'https://placehold.co/600x400' ?>" 
                         alt="<?= htmlspecialchars($item['title']) ?>" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-bold text-slate-900 mt-2 mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                        <?= htmlspecialchars($item['title']) ?>
                    </h3>
                    <p class="text-slate-400 text-sm mt-auto"><?= date('d/m/Y', strtotime($item['published_at'])) ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p class="text-slate-500">Chưa có bài viết liên quan.</p>
        <?php endif; ?>
    </div>
</section>

<script>
    // 1. Xử lý thanh tiến trình đọc
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("progress-bar").style.width = scrolled + "%";
    };

    // 2. Tự động tạo Mục lục (Table of Contents) từ thẻ H2
    document.addEventListener("DOMContentLoaded", function() {
        const content = document.getElementById('main-content');
        const tocList = document.getElementById('toc-list');
        const tocContainer = document.getElementById('toc-container');
        
        if (content && tocList) {
            const headers = content.querySelectorAll('h2');
            
            if (headers.length > 0) {
                headers.forEach((header, index) => {
                    // Tạo ID cho thẻ h2 nếu chưa có
                    if (!header.id) {
                        header.id = 'section-' + index;
                    }
                    
                    // Tạo link trong sidebar
                    const link = document.createElement('a');
                    link.href = '#' + header.id;
                    link.textContent = header.textContent;
                    link.className = 'toc-link';
                    
                    // Smooth scroll khi click
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        document.querySelector(this.getAttribute('href')).scrollIntoView({
                            behavior: 'smooth'
                        });
                    });

                    tocList.appendChild(link);
                });
            } else {
                // Ẩn mục lục nếu bài viết không có thẻ H2
                tocContainer.style.display = 'none';
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?>