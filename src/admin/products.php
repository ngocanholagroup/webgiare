<?php
$activePage = 'products'; // Để bôi đậm menu Sản phẩm
$pageTitle = 'Quản lý kho giao diện';
include 'includes/header.php';
?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div class="relative w-full sm:w-96">
        <input type="text" placeholder="Tìm kiếm sản phẩm..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all">
        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2.5"></i>
    </div>
    
    <button class="flex items-center gap-2 bg-slate-900 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-orange-500/30">
        <i data-lucide="plus" class="w-5 h-5"></i> Thêm giao diện mới
    </button>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="p-5 font-medium w-16">#</th>
                    <th class="p-5 font-medium">Hình ảnh</th>
                    <th class="p-5 font-medium">Tên giao diện</th>
                    <th class="p-5 font-medium">Danh mục</th>
                    <th class="p-5 font-medium">Giá bán</th>
                    <th class="p-5 font-medium text-right">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="p-5 text-gray-400">1</td>
                    <td class="p-5">
                        <div class="w-16 h-12 rounded-lg bg-gray-200 overflow-hidden border border-gray-200">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&w=100&q=80" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-5">
                        <div class="font-bold text-gray-900">TechZone E-commerce</div>
                        <div class="text-xs text-gray-500">Mã: THEME-058</div>
                    </td>
                    <td class="p-5">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">
                            Bán hàng
                        </span>
                    </td>
                    <td class="p-5">
                        <span class="font-bold text-gray-900">3.500.000đ</span>
                    </td>
                    <td class="p-5 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100" title="Sửa"><i data-lucide="edit" class="w-4 h-4"></i></button>
                            <button class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100" title="Xóa"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="p-5 text-gray-400">2</td>
                    <td class="p-5">
                        <div class="w-16 h-12 rounded-lg bg-gray-200 overflow-hidden border border-gray-200">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&w=100&q=80" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-5">
                        <div class="font-bold text-gray-900">Bất động sản Luxury</div>
                        <div class="text-xs text-gray-500">Mã: THEME-059</div>
                    </td>
                    <td class="p-5">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold">
                            Bất động sản
                        </span>
                    </td>
                    <td class="p-5">
                        <span class="font-bold text-gray-900">5.500.000đ</span>
                    </td>
                    <td class="p-5 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100" title="Sửa"><i data-lucide="edit" class="w-4 h-4"></i></button>
                            <button class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100" title="Xóa"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100 flex justify-between items-center">
        <p class="text-xs text-gray-500">Hiển thị 2 / 50 sản phẩm</p>
        <div class="flex gap-1">
            <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-slate-900 text-white font-bold text-xs">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50 text-xs">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>