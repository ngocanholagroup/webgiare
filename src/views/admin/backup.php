<?php
$title = 'Quản lý Sao lưu & Khôi phục';
require_once __DIR__ . '/../../includes/admin-header.php';
?>

<div class="flex h-screen bg-gray-50 overflow-hidden">
    <!-- Sidebar -->
    <?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-20">
            <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-900"><?= $title ?></h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Xin chào, <strong><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></strong></span>
                    <a href="/admin/logout" class="text-red-600 hover:text-red-700 text-sm font-medium">Đăng xuất</a>
                </div>
            </div>
        </header>

        <!-- Main scrollable content -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:px-8">
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Danh sách bản sao lưu</h2>
                        <p class="text-sm text-gray-500 mt-1">Hệ thống tự động sao lưu lúc 02:00 sáng mỗi ngày.</p>
                    </div>
                    <form action="/admin/backup/create" method="POST" onsubmit="return confirm('Quá trình tạo sao lưu có thể mất vài phút. Bạn có muốn tiếp tục?');">
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            Tạo sao lưu mới ngay
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-200">
                                <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Thời gian</th>
                                <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Các file dữ liệu</th>
                                <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tổng dung lượng</th>
                                <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (empty($backups)): ?>
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">Chưa có bản sao lưu nào.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($backups as $backup): ?>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($backup['display_date']) ?>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        <ul class="list-disc pl-4 space-y-1">
                                        <?php foreach ($backup['files'] as $file): ?>
                                            <li><?= htmlspecialchars($file['name']) ?> (<?= round($file['size'] / 1024 / 1024, 2) ?> MB)</li>
                                        <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        <?= round($backup['size'] / 1024 / 1024, 2) ?> MB
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-2">
                                        <form action="/admin/backup/restore" method="POST" class="inline-block" onsubmit="return confirm('CẢNH BÁO: Quá trình này sẽ GHI ĐÈ toàn bộ dữ liệu hiện tại bằng dữ liệu từ bản sao lưu ngày <?= htmlspecialchars($backup['display_date']) ?>. Bạn có CHẮC CHẮN muốn thực hiện?');">
                                            <input type="hidden" name="date" value="<?= htmlspecialchars($backup['id']) ?>">
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 hover:bg-amber-200 text-sm font-medium rounded-lg transition-colors">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                                Khôi phục
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
