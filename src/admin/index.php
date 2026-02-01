<?php
// Cấu hình trang
$activePage = 'dashboard';
$pageTitle = 'Tổng quan hệ thống';

// Gọi Header
include 'includes/header.php';
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                <i data-lucide="dollar-sign" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">Doanh thu tháng</p>
        <h3 class="text-2xl font-bold text-gray-900">45.2tr đ</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+5</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">Đơn hàng mới</p>
        <h3 class="text-2xl font-bold text-gray-900">12</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+18%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">Lượt truy cập</p>
        <h3 class="text-2xl font-bold text-gray-900">85.4k</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center text-pink-600">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded-full">0%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">Yêu cầu tư vấn</p>
        <h3 class="text-2xl font-bold text-gray-900">8</h3>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-900 text-lg">Đơn hàng / Liên hệ gần đây</h3>
        <a href="orders.php" class="text-sm text-orange-600 font-bold hover:underline">Xem tất cả</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="p-4 font-medium">Mã</th>
                    <th class="p-4 font-medium">Khách hàng</th>
                    <th class="p-4 font-medium">Dịch vụ</th>
                    <th class="p-4 font-medium">Ngày</th>
                    <th class="p-4 font-medium">Trạng thái</th>
                    <th class="p-4 font-medium text-right">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-mono text-gray-600">#ORD-001</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-900">Nguyễn Văn A</div>
                        <div class="text-xs text-gray-500">09xxxxxxxxx</div>
                    </td>
                    <td class="p-4 text-gray-600">Thiết kế Web Bán Hàng</td>
                    <td class="p-4 text-gray-500">27/01/2026</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 rounded-md bg-yellow-100 text-yellow-700 text-xs font-bold">Chờ tư vấn</span>
                    </td>
                    <td class="p-4 text-right">
                        <button class="p-2 bg-gray-100 rounded hover:bg-blue-100 text-blue-600 transition"><i data-lucide="eye" class="w-4 h-4"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-mono text-gray-600">#ORD-002</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-900">Trần Thị B</div>
                    </td>
                    <td class="p-4 text-gray-600">Hosting Doanh Nghiệp</td>
                    <td class="p-4 text-gray-500">26/01/2026</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 rounded-md bg-green-100 text-green-700 text-xs font-bold">Hoàn thành</span>
                    </td>
                    <td class="p-4 text-right">
                        <button class="p-2 bg-gray-100 rounded hover:bg-blue-100 text-blue-600 transition"><i data-lucide="eye" class="w-4 h-4"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
// Gọi Footer
include 'includes/footer.php';
?>