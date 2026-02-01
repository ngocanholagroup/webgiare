<?php
require_once 'config/database.php';
$pageTitle = "Chính sách & Quy định - HolaGroup";
include 'includes/header.php';
?>

<section class="bg-slate-50 pt-32 pb-12 border-b border-gray-200">
    <div class="container mx-auto px-4 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-orange-500 shadow-lg mb-6">
            <i data-lucide="shield-check" class="w-8 h-8"></i>
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
            Trung tâm chính sách
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto">
            Minh bạch và rõ ràng là nền tảng kinh doanh của HolaGroup. Dưới đây là các quy định về bảo mật, thanh toán và bảo hành dịch vụ.
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">

            <div class="w-full lg:w-3/12">
                <div class="sticky top-24 bg-white rounded-2xl border border-gray-100 shadow-lg p-2">
                    <nav class="flex flex-col space-y-1">
                        <a href="#bao-mat" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            <i data-lucide="lock" class="w-4 h-4"></i> Chính sách bảo mật
                        </a>
                        <a href="#thanh-toan" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            <i data-lucide="credit-card" class="w-4 h-4"></i> Quy định thanh toán
                        </a>
                        <a href="#bao-hanh" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            <i data-lucide="wrench" class="w-4 h-4"></i> Chế độ bảo hành
                        </a>
                        <a href="#hoan-tien" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            <i data-lucide="refresh-ccw" class="w-4 h-4"></i> Chính sách hoàn tiền
                        </a>
                    </nav>
                </div>
            </div>

            <div class="w-full lg:w-9/12 space-y-16">
                
                <div id="bao-mat" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">01</span>
                        Chính sách bảo mật thông tin
                    </h2>
                    <div class="prose prose-slate max-w-none text-gray-600">
                        <p class="mb-4">HolaGroup cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng theo chính sách bảo vệ thông tin cá nhân của pháp luật Việt Nam.</p>
                        <ul class="list-disc pl-5 space-y-2 mb-4">
                            <li><strong>Thu thập thông tin:</strong> Chúng tôi chỉ thu thập các thông tin cần thiết (Họ tên, Email, SĐT) để tư vấn và ký kết hợp đồng.</li>
                            <li><strong>Sử dụng thông tin:</strong> Thông tin chỉ được dùng để liên lạc, gửi báo giá, bàn giao sản phẩm và hỗ trợ kỹ thuật.</li>
                            <li><strong>Chia sẻ thông tin:</strong> Cam kết không bán, trao đổi hoặc chia sẻ thông tin khách hàng cho bên thứ 3 nào khác, trừ khi có yêu cầu từ cơ quan pháp luật.</li>
                        </ul>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div id="thanh-toan" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">02</span>
                        Quy định thanh toán
                    </h2>
                    <div class="text-gray-600">
                        <p class="mb-4">Để đảm bảo quyền lợi cho cả hai bên, quy trình thanh toán được chia làm 2 giai đoạn:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-gray-900 mb-2">Đợt 1: Tạm ứng 50%</h4>
                                <p class="text-sm">Ngay sau khi ký hợp đồng. HolaGroup sẽ tiến hành thiết kế Demo giao diện.</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-gray-900 mb-2">Đợt 2: Thanh toán 50%</h4>
                                <p class="text-sm">Sau khi website hoàn thiện, khách hàng nghiệm thu và nhận bàn giao tài khoản quản trị.</p>
                            </div>
                        </div>
                        <p>Hình thức thanh toán: Chuyển khoản ngân hàng hoặc Tiền mặt tại văn phòng.</p>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div id="bao-hanh" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">03</span>
                        Chế độ bảo hành & Bảo trì
                    </h2>
                    <div class="text-gray-600 space-y-4">
                        <p><strong>Đối với Website sử dụng Hosting của HolaGroup:</strong></p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Bảo hành kỹ thuật <strong>TRỌN ĐỜI</strong>.</li>
                            <li>Miễn phí khắc phục sự cố, virus, mã độc.</li>
                            <li>Backup dữ liệu định kỳ hàng tuần.</li>
                        </ul>
                        <p><strong>Đối với Website lưu trữ tại đơn vị khác:</strong></p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Bảo hành code 12 tháng kể từ ngày bàn giao.</li>
                            <li>Hỗ trợ hướng dẫn sử dụng trọn đời qua Ultraviewer/Teamviewer.</li>
                        </ul>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div id="hoan-tien" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">04</span>
                        Chính sách hoàn tiền
                    </h2>
                    <div class="bg-red-50 text-red-800 p-4 rounded-xl text-sm border border-red-100">
                        <p>HolaGroup cam kết hoàn trả <strong>100% chi phí tạm ứng</strong> nếu:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Chúng tôi không thực hiện đúng các hạng mục đã cam kết trong hợp đồng.</li>
                            <li>Giao diện Demo không đúng với yêu cầu thiết kế ban đầu quá 3 lần chỉnh sửa.</li>
                            <li>Quá thời gian bàn giao dự án mà không có lý do chính đáng.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>