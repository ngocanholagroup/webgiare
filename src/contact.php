<?php
// 1. Gọi cấu hình (nếu cần xử lý form PHP)
require_once 'config/database.php';

// 2. Tiêu đề trang (SEO)
$pageTitle = "Liên hệ - HolaGroup Tech Solution";

// 3. Gọi Header
include 'includes/header.php';
?>

<section class="relative bg-slate-50 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="text-orange-500 font-bold tracking-widest uppercase text-sm bg-orange-50 px-3 py-1 rounded-full border border-orange-100">
            Hỗ trợ 24/7
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-4 mb-4">
            Liên hệ với <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600">HolaGroup</span>
        </h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto">
            Chúng tôi luôn sẵn sàng lắng nghe. Hãy để lại thông tin hoặc ghé thăm văn phòng để cùng thảo luận về giải pháp số cho doanh nghiệp của bạn.
        </p>
    </div>
</section>

<section class="py-20 bg-white relative">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <div class="w-full lg:w-5/12 space-y-6">
                
                <div class="flex items-start gap-5 p-6 rounded-2xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl transition-all duration-300 bg-white group">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shrink-0">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Trụ sở chính</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            119 Đường Lê Bôi, Phường 7, <br>Quận 8, TP. Hồ Chí Minh
                        </p>
                        <a href="#map" class="text-blue-600 text-sm font-semibold mt-2 inline-flex items-center gap-1 hover:underline">
                            Xem bản đồ <i data-lucide="arrow-down" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-5 p-6 rounded-2xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl transition-all duration-300 bg-white group">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300 shrink-0">
                        <i data-lucide="phone-call" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Kênh liên lạc</h3>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-sm">Hotline: <span class="text-gray-900 font-semibold">0973.157.932</span></p>
                            <p class="text-gray-500 text-sm">Kỹ thuật: <span class="text-gray-900 font-semibold">0909.xxx.xxx</span></p>
                            <p class="text-gray-500 text-sm">Email: <span class="text-blue-600">sale@holagroup.com.vn</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-5 p-6 rounded-2xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl transition-all duration-300 bg-white group">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shrink-0">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Giờ làm việc</h3>
                        <div class="space-y-1 text-sm text-gray-500">
                            <p class="flex justify-between gap-4"><span>Thứ 2 - Thứ 6:</span> <span class="font-medium text-gray-900">8:00 - 17:30</span></p>
                            <p class="flex justify-between gap-4"><span>Thứ 7:</span> <span class="font-medium text-gray-900">8:00 - 12:00</span></p>
                            <p class="flex justify-between gap-4"><span>Chủ nhật:</span> <span class="text-orange-500 font-medium">Nghỉ</span></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-7/12">
                <div class="bg-gray-50 rounded-3xl p-8 md:p-10 border border-gray-100 h-full">
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i data-lucide="send" class="w-6 h-6 text-orange-500"></i> Gửi tin nhắn trực tuyến
                    </h2>

                    <form action="process_contact.php" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên *</label>
                                <input type="text" name="fullname" placeholder="Nguyễn Văn A" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại *</label>
                                <input type="tel" name="phone" placeholder="09xxxxxxx" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email (Nếu có)</label>
                            <input type="email" name="email" placeholder="example@gmail.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all bg-white">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Chủ đề quan tâm</label>
                            <div class="relative">
                                <select name="subject" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all bg-white appearance-none cursor-pointer">
                                    <option value="">-- Chọn dịch vụ --</option>
                                    <option value="Web">Thiết kế Website</option>
                                    <option value="SEO">Dịch vụ SEO</option>
                                    <option value="Ads">Quảng cáo Online</option>
                                    <option value="Other">Hợp tác / Khác</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 absolute right-4 top-3.5 pointer-events-none"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nội dung tin nhắn</label>
                            <textarea name="message" rows="5" placeholder="Mô tả chi tiết nhu cầu của bạn..." required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all bg-white resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                            Gửi yêu cầu ngay
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="map" class="relative w-full h-[450px] bg-gray-200">
    <div class="absolute inset-0 flex items-center justify-center bg-gray-100 z-0">
        <span class="text-gray-400 animate-pulse">Loading Google Maps...</span>
    </div>
    
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.666750033107!2d106.6346853!3d10.7599171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752e8f88888888%3A0x8888888888888888!2zMTE5IMSQxrDhu51uZyBMw6ogQsO0aSwgUGjhuqduZyA3LCBRdeG6rW4gOCwgSOG7kyBDaMOtIE1pbmgsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" 
        width="100%" 
        height="100%" 
        style="border:0; position: relative; z-index: 10;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

<?php
// 4. Gọi Footer
include 'includes/footer.php';
?>