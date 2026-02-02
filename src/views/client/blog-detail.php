<?php
// Gọi Header
include 'includes/header.php';

// --- MOCK DATA ---
$post = [
    'title' => '5 Xu hướng Thiết kế Website sẽ thống trị năm 2026',
    'cat' => 'Xu hướng công nghệ',
    'date' => '02/02/2026',
    'author' => 'Tuấn Anh (Senior Dev)',
    'views' => '2,543',
    'image' => 'https://cdn.dribbble.com/users/1294862/screenshots/17390977/media/a96095940428d227b233a59569766624.png',
];
?>

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
    
    /* Typography cho bài viết */
    .article-content h2 { font-size: 1.875rem; font-weight: 800; color: #0f172a; margin-top: 2.5rem; margin-bottom: 1.25rem; }
    .article-content h3 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-top: 2rem; margin-bottom: 1rem; }
    .article-content p { font-size: 1.125rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem; }
    .article-content ul { list-style: none; margin-bottom: 1.5rem; }
    .article-content ul li { position: relative; padding-left: 1.5rem; margin-bottom: 0.75rem; color: #475569; }
    .article-content ul li::before { content: "•"; color: #f97316; font-weight: bold; font-size: 1.5rem; position: absolute; left: 0; top: -0.25rem; }
    .article-content blockquote { border-left: 4px solid #f97316; padding-left: 1.5rem; font-style: italic; color: #334155; background: #fff7ed; padding: 1.5rem; border-radius: 0 1rem 1rem 0; margin: 2rem 0; }
    .article-content img { border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); margin: 2rem 0; width: 100%; }
    
    /* Sticky Sidebar */
    .sticky-toc {
        position: -webkit-sticky;
        position: sticky;
        top: 120px;
    }
</style>

<div id="progress-bar"></div>

<section class="relative pt-32 pb-16 lg:pt-40 lg:pb-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            
            <div class="inline-flex items-center gap-2 mb-6">
                <span class="bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    <?= $post['cat'] ?>
                </span>
                <span class="text-slate-400 text-sm flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i> 5 phút đọc
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-8 leading-tight">
                <?= $post['title'] ?>
            </h1>

            <div class="flex items-center justify-center gap-6 text-slate-400 text-sm md:text-base border-t border-slate-800 pt-8 mt-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center text-orange-500 font-bold border-2 border-slate-600">
                        TA
                    </div>
                    <div>
                        <p class="text-white font-bold"><?= $post['author'] ?></p>
                        <p class="text-xs">Tác giả</p>
                    </div>
                </div>
                <div class="h-8 w-px bg-slate-800"></div>
                <div>
                    <p class="text-white font-bold"><?= $post['date'] ?></p>
                    <p class="text-xs">Ngày đăng</p>
                </div>
                <div class="h-8 w-px bg-slate-800"></div>
                <div>
                    <p class="text-white font-bold"><?= $post['views'] ?></p>
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
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-[#1877F2] hover:text-white transition-colors" title="Share Facebook"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-[#1DA1F2] hover:text-white transition-colors" title="Share Twitter"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-[#0A66C2] hover:text-white transition-colors" title="Share LinkedIn"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-orange-500 hover:text-white transition-colors" title="Copy Link"><i data-lucide="link" class="w-5 h-5"></i></a>
            </div>

            <div class="w-full lg:w-8/12">
                
                <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 -mt-24 relative z-20 border-4 border-white">
                    <img src="<?= $post['image'] ?>" alt="<?= $post['title'] ?>" class="w-full h-auto">
                </div>

                <article class="article-content max-w-none">
                    <p class="lead text-xl font-medium text-slate-600 mb-8">
                        Năm 2025 đánh dấu sự bùng nổ của AI trong thiết kế web. Nhưng đến năm 2026, chúng ta sẽ thấy sự lên ngôi của những trải nghiệm người dùng siêu cá nhân hóa và các phong cách thị giác táo bạo hơn.
                    </p>

                    <h2 id="section-1">1. Glassmorphism 2.0 (Hiệu ứng kính mờ)</h2>
                    <p>
                        Không chỉ là những tấm kính mờ đơn thuần như macOS Big Sur. Phiên bản 2.0 sẽ kết hợp với các dải màu Gradient chuyển động (Aurora Backgrounds) tạo nên chiều sâu không gian cực kỳ ấn tượng.
                    </p>
                    <img src="https://cdn.dribbble.com/users/418188/screenshots/16386596/media/53239a2444634734892c908f5127602f.jpg" alt="Glassmorphism Example">
                    
                    <h2 id="section-2">2. Typography khổng lồ (Large Typography)</h2>
                    <p>
                        "Less is more". Thay vì dùng hình ảnh, các nhà thiết kế sẽ sử dụng những font chữ kích thước cực lớn (Bold & Heavy) để truyền tải thông điệp mạnh mẽ ngay từ cái nhìn đầu tiên.
                    </p>
                    
                    <div class="my-10 bg-slate-900 rounded-2xl p-8 text-center relative overflow-hidden group cursor-pointer hover:shadow-2xl transition-all">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 rounded-full blur-[50px] opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative z-10">
                            <h4 class="text-white font-bold text-xl mb-2">Bạn muốn Website chuẩn Trend 2026?</h4>
                            <p class="text-slate-400 text-sm mb-6">Đội ngũ HolaGroup sẵn sàng tư vấn giải pháp thiết kế độc quyền cho bạn.</p>
                            <a href="/lien-he" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-8 rounded-full transition-colors">Nhận tư vấn ngay</a>
                        </div>
                    </div>

                    <h2 id="section-3">3. Dark Mode là tiêu chuẩn</h2>
                    <p>
                        Chế độ tối không còn là tùy chọn phụ. Nó sẽ trở thành giao diện mặc định cho các sản phẩm công nghệ, SaaS và Portfolio cá nhân để tạo cảm giác sang trọng và giảm mỏi mắt.
                    </p>
                    
                    <blockquote>
                        "Thiết kế không chỉ là nó trông như thế nào và cảm thấy như thế nào. Thiết kế là cách nó hoạt động." - Steve Jobs
                    </blockquote>

                    <h2 id="section-4">4. Tương tác vi mô (Micro-interactions)</h2>
                    <p>
                        Những chuyển động nhỏ khi di chuột, click nút, hoặc cuộn trang sẽ được chăm chút tỉ mỉ. Nó làm cho website trở nên "sống động" và phản hồi lại người dùng như một sinh vật sống.
                    </p>
                    <ul>
                        <li>Hiệu ứng Hover button sáng tạo</li>
                        <li>Loading bar theo trục dọc</li>
                        <li>Cursor tùy chỉnh theo ngữ cảnh</li>
                    </ul>

                    <h3 id="ket-luan">Kết luận</h3>
                    <p>
                        Để không bị bỏ lại phía sau, doanh nghiệp cần cập nhật liên tục. Một website đẹp không chỉ để ngắm, mà là công cụ bán hàng đắc lực nhất của bạn.
                    </p>
                </article>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-sm font-bold text-slate-400 mr-2">Tags:</span>
                        <a href="#" class="px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-xs font-bold hover:bg-orange-500 hover:text-white transition-colors">#WebDesign</a>
                        <a href="#" class="px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-xs font-bold hover:bg-orange-500 hover:text-white transition-colors">#2026Trends</a>
                        <a href="#" class="px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-xs font-bold hover:bg-orange-500 hover:text-white transition-colors">#UI/UX</a>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-6 flex items-start gap-4">
                        <div class="w-16 h-16 rounded-full bg-slate-200 flex-shrink-0 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Tuan+Anh&background=f97316&color=fff" alt="Author">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Tuấn Anh (Senior Dev)</h4>
                            <p class="text-slate-500 text-sm mb-3">
                                10 năm kinh nghiệm trong lĩnh vực Fullstack Web Development. Đam mê chia sẻ kiến thức về công nghệ và tối ưu hiệu suất website.
                            </p>
                            <div class="flex gap-3">
                                <a href="#" class="text-slate-400 hover:text-blue-600"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                                <a href="#" class="text-slate-400 hover:text-blue-400"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-3/12 relative hidden lg:block">
                <div class="sticky-toc space-y-8">
                    
                    <div class="border-l-2 border-slate-100 pl-4">
                        <h4 class="font-bold text-slate-900 mb-4 text-sm uppercase tracking-wider">Mục lục bài viết</h4>
                        <nav class="flex flex-col gap-3 text-sm">
                            <a href="#section-1" class="text-slate-500 hover:text-orange-600 hover:pl-1 transition-all">1. Glassmorphism 2.0</a>
                            <a href="#section-2" class="text-slate-500 hover:text-orange-600 hover:pl-1 transition-all">2. Typography khổng lồ</a>
                            <a href="#section-3" class="text-slate-500 hover:text-orange-600 hover:pl-1 transition-all">3. Dark Mode là tiêu chuẩn</a>
                            <a href="#section-4" class="text-slate-500 hover:text-orange-600 hover:pl-1 transition-all">4. Tương tác vi mô</a>
                            <a href="#ket-luan" class="text-slate-500 hover:text-orange-600 hover:pl-1 transition-all">Kết luận</a>
                        </nav>
                    </div>

                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-center text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500 rounded-full blur-[40px] opacity-20"></div>
                        <h5 class="font-bold text-lg mb-2">Cần Website?</h5>
                        <p class="text-slate-400 text-xs mb-4">Đăng ký ngay để nhận ưu đãi Hosting miễn phí.</p>
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
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php for($i=1; $i<=3; $i++): ?>
            <a href="#" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="aspect-video bg-slate-200 overflow-hidden">
                    <img src="https://source.unsplash.com/random/800x600?tech,<?= $i ?>" alt="Blog" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <span class="text-xs font-bold text-orange-500 uppercase">Công nghệ</span>
                    <h3 class="font-bold text-slate-900 mt-2 mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                        Làm thế nào để tối ưu điểm Google PageSpeed lên 100?
                    </h3>
                    <p class="text-slate-400 text-sm">28/01/2026</p>
                </div>
            </a>
            <?php endfor; ?>
        </div>
    </div>
</section>

<script>
    // Xử lý thanh tiến trình đọc
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("progress-bar").style.width = scrolled + "%";
    };
</script>

<?php
// Gọi Footer
include 'includes/footer.php';
?>