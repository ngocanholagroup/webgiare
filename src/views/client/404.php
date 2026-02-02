<?php
// Không gọi header/footer đầy đủ nếu muốn trang 404 đứng độc lập, 
// nhưng để giữ trải nghiệm đồng bộ, ta vẫn nên include header.
require_once 'config/database.php';
$pageTitle = "Không tìm thấy trang - 404 Error";
include 'includes/header.php';
?>

<section class="min-h-screen bg-white flex items-center justify-center relative overflow-hidden pt-20 pb-20">
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-tr from-orange-100 to-pink-100 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        
        <h1 class="text-[150px] md:text-[250px] font-black leading-none text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600 select-none animate-pulse">
            404
        </h1>

        <div class="max-w-xl mx-auto -mt-4 md:-mt-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Oops! Trang này đã "đi lạc"
            </h2>
            <p class="text-gray-500 text-lg mb-8">
                Có vẻ như đường link bạn truy cập không tồn tại hoặc đã bị xóa. Đừng lo, hãy quay lại trang chủ để tìm kiếm thông tin bạn cần nhé.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="index.php" class="inline-flex items-center justify-center gap-2 bg-slate-900 text-white px-8 py-3.5 rounded-full font-bold hover:bg-orange-600 transition-colors shadow-lg">
                    <i data-lucide="home" class="w-5 h-5"></i> Về trang chủ
                </a>
                <a href="contact.php" class="inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full font-bold hover:border-orange-500 hover:text-orange-500 transition-colors">
                    <i data-lucide="help-circle" class="w-5 h-5"></i> Báo lỗi cho Admin
                </a>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <p class="text-sm font-medium text-gray-400 mb-4 uppercase tracking-widest">Có thể bạn đang tìm:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm font-semibold text-gray-600">
                    <a href="products.php" class="hover:text-orange-500 underline decoration-gray-300 underline-offset-4 hover:decoration-orange-500 transition-all">Kho giao diện</a>
                    <a href="services.php" class="hover:text-orange-500 underline decoration-gray-300 underline-offset-4 hover:decoration-orange-500 transition-all">Dịch vụ SEO</a>
                    <a href="blog.php" class="hover:text-orange-500 underline decoration-gray-300 underline-offset-4 hover:decoration-orange-500 transition-all">Tin tức công nghệ</a>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
// Footer tối giản cho trang 404 (hoặc include footer thường)
include 'includes/footer.php';
?>