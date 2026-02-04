<?php
// views/client/policy.php
include 'includes/header.php';
?>

<section class="relative bg-slate-50 pt-32 pb-24 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-[500px] bg-white transform -skew-y-3 origin-top-left z-0"></div>
    <div class="absolute top-20 right-20 w-64 h-64 bg-orange-100 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-16 gap-10">
            <div class="w-full md:w-1/2">
                <div class="inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider mb-4 border border-blue-100">
                    Legal & Privacy
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight">
                    Điều khoản & <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Chính sách dịch vụ</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed max-w-lg">
                    Sự minh bạch là nền tảng của niềm tin. Dưới đây là các quy định chi tiết về quyền lợi và trách nhiệm của cả hai bên.
                </p>
                <div class="mt-6 flex items-center gap-2 text-sm text-slate-400">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    <span>Cập nhật lần cuối: 01/01/2026</span>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                <div class="relative w-80 h-80">
                    <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-2xl animate-[float_6s_ease-in-out_infinite]">
                        <rect x="80" y="40" width="240" height="320" rx="4" fill="white"/>
                        <path d="M80 40 L 320 40 L 320 360 L 80 360 Z" fill="#F8FAFC"/>
                        <path d="M260 40 L 320 100 L 260 100 Z" fill="#E2E8F0"/>
                        
                        <rect x="120" y="100" width="100" height="12" rx="6" fill="#CBD5E1"/>
                        <rect x="120" y="140" width="160" height="8" rx="4" fill="#E2E8F0"/>
                        <rect x="120" y="165" width="160" height="8" rx="4" fill="#E2E8F0"/>
                        <rect x="120" y="190" width="140" height="8" rx="4" fill="#E2E8F0"/>
                        <rect x="120" y="215" width="160" height="8" rx="4" fill="#E2E8F0"/>
                        
                        <path d="M280 280 C 280 280, 320 290, 320 330 C 320 370, 280 390, 280 390 C 280 390, 240 370, 240 330 C 240 290, 280 280, 280 280 Z" fill="#3B82F6" stroke="white" stroke-width="4"/>
                        <path d="M270 335 L 280 345 L 300 315" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <circle cx="200" cy="300" r="40" fill="#EF4444" opacity="0.9"/>
                        <circle cx="200" cy="300" r="32" stroke="#FEE2E2" stroke-width="2" stroke-dasharray="4 2"/>
                        <path d="M190 300 L 200 310 L 220 285" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <rect x="250" y="180" width="20" height="100" rx="4" transform="rotate(-45 260 230)" fill="#F97316"/>
                        <path d="M236 264 L 225 275 L 240 270 Z" fill="#334155"/>
                    </svg>
                </div>
            </div>
        </div>

            <div class="w-full">
                <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 space-y-16">
                    
                    <div id="quy-dinh-chung" class="scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600">
                                <i data-lucide="file-text" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">1. Quy định chung</h2>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600">
                            <p>Chào mừng bạn đến với HolaGroup. Khi sử dụng dịch vụ của chúng tôi, bạn đồng ý tuân thủ các điều khoản dưới đây. Chúng tôi có quyền thay đổi, chỉnh sửa các quy định này bất cứ lúc nào để phù hợp với tình hình thực tế và quy định của pháp luật.</p>
                            <ul class="list-disc pl-5 space-y-2 mt-4">
                                <li>Khách hàng cam kết cung cấp thông tin chính xác khi đăng ký dịch vụ.</li>
                                <li>Không sử dụng dịch vụ của chúng tôi cho các mục đích vi phạm pháp luật Việt Nam.</li>
                                <li>Tôn trọng quyền sở hữu trí tuệ đối với các sản phẩm do HolaGroup thiết kế.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-full h-px bg-slate-100"></div>

                    <div id="bao-mat" class="scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                                <i data-lucide="shield" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">2. Chính sách bảo mật</h2>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600">
                            <p>Chúng tôi hiểu rằng dữ liệu là tài sản quý giá nhất của doanh nghiệp. HolaGroup cam kết:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    <h4 class="font-bold text-slate-900 mb-2">Không chia sẻ dữ liệu</h4>
                                    <p class="text-sm">Tuyệt đối không bán hoặc chia sẻ thông tin khách hàng cho bên thứ 3.</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    <h4 class="font-bold text-slate-900 mb-2">Mã hóa SSL</h4>
                                    <p class="text-sm">Mọi giao dịch và dữ liệu truyền tải đều được mã hóa theo chuẩn quốc tế.</p>
                                </div>
                            </div>
                            <p>Thông tin cá nhân thu thập được sẽ chỉ được sử dụng trong nội bộ để nâng cao chất lượng dịch vụ và hỗ trợ khách hàng.</p>
                        </div>
                    </div>

                    <div class="w-full h-px bg-slate-100"></div>

                    <div id="thanh-toan" class="scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                                <i data-lucide="credit-card" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">3. Thanh toán & Hoàn tiền</h2>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600">
                            <p>Quy trình thanh toán được chia làm 2 giai đoạn để đảm bảo quyền lợi cho khách hàng:</p>
                            <ul class="list-decimal pl-5 space-y-2 mt-4">
                                <li><strong>Đợt 1:</strong> Thanh toán 50% giá trị hợp đồng ngay sau khi ký kết để triển khai dự án.</li>
                                <li><strong>Đợt 2:</strong> Thanh toán 50% còn lại sau khi nghiệm thu và bàn giao mã nguồn.</li>
                            </ul>
                            <p class="mt-4 italic bg-yellow-50 p-3 rounded-lg border border-yellow-100 text-yellow-800 text-sm">
                                <i data-lucide="info" class="w-4 h-4 inline mr-1"></i>
                                <strong>Chính sách hoàn tiền:</strong> Hoàn tiền 100% nếu chúng tôi không thực hiện đúng cam kết trong hợp đồng hoặc trễ tiến độ quá 30 ngày không có lý do chính đáng.
                            </p>
                        </div>
                    </div>

                    <div class="w-full h-px bg-slate-100"></div>

                    <div id="bao-hanh" class="scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                                <i data-lucide="wrench" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">4. Bảo hành & Hỗ trợ</h2>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600">
                            <p>Sản phẩm làm ra là đứa con tinh thần của chúng tôi. HolaGroup cam kết:</p>
                            <ul class="space-y-4 mt-4">
                                <li class="flex items-start gap-3">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                    <span><strong>Bảo hành vĩnh viễn:</strong> Đối với các lỗi phát sinh từ mã nguồn do chúng tôi lập trình.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                    <span><strong>Hỗ trợ trọn đời:</strong> Hướng dẫn sử dụng, tư vấn nâng cấp tính năng bất cứ khi nào bạn cần.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                    <span><strong>Backup định kỳ:</strong> Dữ liệu website được sao lưu hàng tuần để phòng tránh rủi ro.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
    }
</style>

<?php
// Gọi Footer
include 'includes/footer.php';
?>