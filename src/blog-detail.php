<?php
require_once 'config/database.php';
$pageTitle = "5 Xu hướng thiết kế Website 'lên ngôi' năm 2026 - Blog HolaGroup";
include 'includes/header.php';
?>

<div class="fixed top-0 left-0 h-1 bg-gradient-to-r from-orange-500 to-pink-500 z-[60] w-0 transition-all duration-100" id="reading-progress"></div>

<section class="pt-32 pb-10 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="index.php" class="hover:text-orange-500 transition">Trang chủ</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <a href="blog.php" class="hover:text-orange-500 transition">Blog Công nghệ</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-gray-900 font-medium truncate max-w-[200px] md:max-w-none">Xu hướng thiết kế Web 2026</span>
        </div>

        <div class="max-w-4xl mx-auto text-center">
            <div class="flex items-center justify-center gap-4 mb-6">
                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider">
                    Web Design
                </span>
                <span class="text-gray-400 text-sm flex items-center gap-1">
                    <i data-lucide="clock" class="w-3.5 h-3.5"></i> 5 phút đọc
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-8 leading-tight">
                5 Xu hướng thiết kế Website "lên ngôi" <br> trong năm 2026
            </h1>

            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-orange-100 p-0.5">
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Author" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="text-left">
                    <p class="font-bold text-gray-900 text-sm">Trần Minh Hiếu</p>
                    <p class="text-gray-500 text-xs">Senior UI/UX Designer</p>
                </div>
                <span class="text-gray-300">|</span>
                <p class="text-gray-500 text-sm">27 Tháng 01, 2026</p>
            </div>
        </div>
    </div>
</section>

<section class="pb-12 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="relative aspect-[21/9] rounded-3xl overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" 
                 alt="Web Design Trends" 
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000">
        </div>
    </div>
</section>

<section class="py-12 bg-white relative">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-12">

            <article class="w-full lg:w-8/12">
                
                <p class="text-xl text-gray-600 leading-relaxed font-medium mb-8 border-l-4 border-orange-500 pl-6 italic">
                    "Website không chỉ là bộ mặt của doanh nghiệp, nó là nhân viên bán hàng xuất sắc nhất. Năm 2026 đánh dấu sự chuyển mình mạnh mẽ của thiết kế web với sự hỗ trợ của AI và trải nghiệm tương tác sâu."
                </p>

                <div class="prose prose-lg prose-slate max-w-none text-gray-700 space-y-8">
                    
                    <p>
                        Nếu bạn đang có ý định làm mới lại website hoặc xây dựng một trang web mới, việc cập nhật các xu hướng thiết kế là điều bắt buộc để không bị đối thủ bỏ lại phía sau. Dưới đây là 5 xu hướng được dự đoán sẽ thống trị internet trong năm nay.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Chủ nghĩa tối giản mới (Neo-Minimalism)</h2>
                    <p>
                        Không còn là những trang web trắng trơn nhàm chán. Chủ nghĩa tối giản năm 2026 kết hợp giữa khoảng trắng (white space) rộng rãi và các chi tiết <strong>Micro-interactions</strong> (tương tác nhỏ) tinh tế.
                    </p>
                    <div class="my-8 rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Minimalism" class="w-full">
                        <p class="text-center text-sm text-gray-500 py-2 bg-gray-50">Giao diện tối giản giúp tăng tốc độ tải trang và tập trung vào nội dung.</p>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Typography khổng lồ (Oversized Typography)</h2>
                    <p>
                        Thay vì sử dụng hình ảnh, nhiều thương hiệu lớn đang chuyển sang sử dụng chữ cái kích thước lớn để truyền tải thông điệp. Điều này tạo ra ấn tượng thị giác mạnh mẽ ngay lập tức.
                    </p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-orange-500">
                        <li>Dễ đọc trên thiết bị di động.</li>
                        <li>Tạo cá tính riêng cho thương hiệu.</li>
                        <li>Tối ưu tốt cho SEO vì Google đọc được văn bản.</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Chế độ tối (Dark Mode) mặc định</h2>
                    <p>
                        Với sự phổ biến của màn hình OLED, Dark Mode không còn là tùy chọn phụ. Nhiều website công nghệ hiện nay (như HolaGroup) ưu tiên thiết kế giao diện tối để tạo cảm giác sang trọng và bảo vệ mắt người dùng.
                    </p>

                    <div class="bg-blue-50 p-8 rounded-2xl border border-blue-100 my-8">
                        <div class="flex gap-4">
                            <i data-lucide="quote" class="w-8 h-8 text-blue-500 fill-current opacity-50 shrink-0"></i>
                            <div>
                                <p class="text-lg font-bold text-blue-900 mb-2">Lời khuyên từ chuyên gia:</p>
                                <p class="text-blue-800">
                                    "Đừng chạy theo xu hướng một cách mù quáng. Hãy chọn phong cách phù hợp với tệp khách hàng của bạn. Một web bán nông sản không nên thiết kế quá Cyberpunk như web game."
                                </p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Trí tuệ nhân tạo (AI) trong Chatbot</h2>
                    <p>
                        Chatbot năm 2026 không còn trả lời cứng nhắc theo kịch bản. Chúng hiểu ngữ cảnh và tư vấn như người thật. Việc tích hợp AI Chatbot vào website giúp tăng tỷ lệ chuyển đổi lên tới 40%.
                    </p>

                    <h3 class="text-xl font-bold text-gray-900 mt-6 mb-3">Kết luận</h3>
                    <p>
                        Website là một cơ thể sống, cần được nuôi dưỡng và cập nhật thường xuyên. Tại <strong>HolaGroup</strong>, chúng tôi luôn sẵn sàng giúp bạn hiện thực hóa những ý tưởng táo bạo nhất.
                    </p>
                </div>

                <div class="border-t border-b border-gray-100 py-8 my-12 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-gray-900 mr-2">Tags:</span>
                        <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 text-gray-600 hover:text-orange-600 rounded-lg text-sm transition">Thiết kế web</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 text-gray-600 hover:text-orange-600 rounded-lg text-sm transition">UI/UX</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 text-gray-600 hover:text-orange-600 rounded-lg text-sm transition">Xu hướng</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-gray-900 mr-2">Chia sẻ:</span>
                        <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90 transition">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:opacity-90 transition">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center hover:opacity-90 transition">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 flex flex-col sm:flex-row gap-6 items-center sm:items-start text-center sm:text-left">
                    <div class="w-20 h-20 rounded-full overflow-hidden shrink-0 border-2 border-white shadow-md">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Author" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">Về tác giả: Trần Minh Hiếu</h4>
                        <p class="text-gray-500 text-sm mt-2 mb-4 leading-relaxed">
                            Senior Designer với 8 năm kinh nghiệm. Đam mê sự tối giản và trải nghiệm người dùng. Từng tham gia thiết kế cho hơn 100 dự án thương mại điện tử lớn nhỏ.
                        </p>
                        <a href="#" class="text-orange-600 font-bold text-sm hover:underline">Xem các bài viết khác của Hiếu</a>
                    </div>
                </div>

                <div class="mt-16">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Bình luận (3)</h3>
                    
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 shrink-0 overflow-hidden">
                                <img src="https://i.pravatar.cc/150?u=1" alt="User">
                            </div>
                            <div>
                                <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-bold text-gray-900">Nguyễn Văn A</span>
                                        <span class="text-xs text-gray-400">2 giờ trước</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Bài viết rất hữu ích! Mình đang phân vân có nên làm Dark Mode cho web bán thực phẩm không?</p>
                                </div>
                                <button class="text-xs font-bold text-gray-500 mt-2 ml-2 hover:text-orange-500">Trả lời</button>
                            </div>
                        </div>

                        <div class="flex gap-4 ml-12">
                            <div class="w-10 h-10 rounded-full bg-orange-100 shrink-0 overflow-hidden border border-orange-200">
                                <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Author">
                            </div>
                            <div>
                                <div class="bg-orange-50 p-4 rounded-2xl rounded-tl-none border border-orange-100">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-bold text-orange-700">Trần Minh Hiếu <span class="bg-orange-600 text-white text-[10px] px-1.5 py-0.5 rounded ml-1">Admin</span></span>
                                        <span class="text-xs text-orange-400">1 giờ trước</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Chào bạn A, với web thực phẩm thì màu sắc tươi sáng (trắng/xanh) vẫn kích thích vị giác tốt hơn nhé. Dark Mode hợp với web công nghệ hoặc portfolio hơn.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="font-bold text-gray-900 mb-4">Để lại bình luận</h4>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" placeholder="Tên của bạn *" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-orange-500 outline-none">
                                <input type="email" placeholder="Email *" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-orange-500 outline-none">
                            </div>
                            <textarea rows="4" placeholder="Nội dung bình luận..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-orange-500 outline-none resize-none"></textarea>
                            <button class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-orange-600 transition shadow-lg">Gửi bình luận</button>
                        </form>
                    </div>

                </div>

            </article>

            <aside class="w-full lg:w-4/12 space-y-8">
                
                <div class="hidden lg:block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Mục lục bài viết</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="#" class="flex items-start gap-2 text-orange-600 font-medium">
                                <span class="text-orange-400">1.</span> Chủ nghĩa tối giản mới
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start gap-2 text-gray-600 hover:text-orange-600 transition pl-4">
                                <span class="text-gray-400">2.</span> Typography khổng lồ
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start gap-2 text-gray-600 hover:text-orange-600 transition pl-4">
                                <span class="text-gray-400">3.</span> Chế độ tối mặc định
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start gap-2 text-gray-600 hover:text-orange-600 transition pl-4">
                                <span class="text-gray-400">4.</span> AI Chatbot thông minh
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="relative rounded-2xl overflow-hidden text-center group shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 to-blue-900/90 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Service" class="absolute inset-0 w-full h-full object-cover">
                    
                    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center p-6 text-white">
                        <p class="text-sm font-bold text-purple-200 uppercase tracking-widest mb-2">Dịch vụ Hot</p>
                        <h3 class="text-2xl font-bold mb-4">Thiết kế Website chuẩn SEO 2026</h3>
                        <p class="text-sm text-gray-300 mb-6">Tặng Hosting + Tên miền. Bảo hành trọn đời.</p>
                        <a href="contact.php" class="bg-white text-purple-700 px-6 py-3 rounded-full font-bold text-sm hover:scale-105 transition-transform shadow-lg">
                            Xem báo giá ngay
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Bài viết xem nhiều</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-3 group cursor-pointer">
                            <div class="w-16 h-16 rounded-lg bg-gray-200 shrink-0 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-orange-600 transition-colors line-clamp-2">
                                    Làm sao để website tải dưới 1 giây?
                                </h4>
                                <span class="text-xs text-gray-400">12.5k views</span>
                            </div>
                        </li>
                         <li class="flex gap-3 group cursor-pointer">
                            <div class="w-16 h-16 rounded-lg bg-gray-200 shrink-0 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-orange-600 transition-colors line-clamp-2">
                                    Top 10 Plugin WordPress không thể thiếu
                                </h4>
                                <span class="text-xs text-gray-400">8.2k views</span>
                            </div>
                        </li>
                    </ul>
                </div>

            </aside>

        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Bài viết cùng chủ đề</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-gray-100 group">
                <div class="relative overflow-hidden aspect-video">
                     <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                         style="background-image: url('https://images.unsplash.com/photo-1555421689-d68471e189f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-orange-600 line-clamp-2">
                        Quy trình thiết kế UI/UX chuẩn quốc tế
                    </h3>
                    <a href="#" class="text-xs font-bold text-orange-500 uppercase">Đọc ngay</a>
                </div>
            </article>
             <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-gray-100 group">
                <div class="relative overflow-hidden aspect-video">
                     <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                         style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-orange-600 line-clamp-2">
                        Checklist kiểm tra Website trước khi bàn giao
                    </h3>
                    <a href="#" class="text-xs font-bold text-orange-500 uppercase">Đọc ngay</a>
                </div>
            </article>
             <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-gray-100 group">
                <div class="relative overflow-hidden aspect-video">
                     <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500"
                         style="background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');">
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-orange-600 line-clamp-2">
                        Bảo mật Website: Những điều chủ doanh nghiệp cần biết
                    </h3>
                    <a href="#" class="text-xs font-bold text-orange-500 uppercase">Đọc ngay</a>
                </div>
            </article>
        </div>
    </div>
</section>

<script>
    window.onscroll = function() {myFunction()};
    function myFunction() {
      var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var scrolled = (winScroll / height) * 100;
      document.getElementById("reading-progress").style.width = scrolled + "%";
    }
</script>

<?php
include 'includes/footer.php';
?>