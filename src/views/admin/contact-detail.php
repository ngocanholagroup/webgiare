<?php include 'includes/admin-header.php'; ?>

<div class="w-full">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200 w-full">
        <a href="/admin/contact" class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
        </a>
        
        <?php 
        $badges = [
            'new' => ['Mới gửi', 'bg-orange-100 text-orange-700'],
            'contacted' => ['Đã liên hệ', 'bg-blue-100 text-blue-700'],
            'completed' => ['Hoàn thành', 'bg-green-100 text-green-700'],
            'spam' => ['Spam', 'bg-slate-100 text-slate-600']
        ];
        $st = $badges[$contact['status']] ?? $badges['new'];
        ?>
        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide <?= $st[1] ?>">
            <?= $st[0] ?>
        </span>
    </div>

    <div class="grid grid-cols-12 gap-6">
        
        <div class="col-span-12 md:col-span-8 space-y-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Thông tin yêu cầu</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-xs text-slate-400 uppercase font-bold">Họ và tên</label>
                        <p class="text-slate-800 font-medium text-lg"><?= htmlspecialchars($contact['full_name']) ?></p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-400 uppercase font-bold">Số điện thoại</label>
                        <p class="text-slate-800 font-medium text-lg flex items-center gap-2">
                            <?= htmlspecialchars($contact['phone']) ?>
                            <a href="tel:<?= $contact['phone'] ?>" class="text-green-600 bg-green-50 p-1.5 rounded-full hover:bg-green-100"><i data-lucide="phone" class="w-3 h-3"></i></a>
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-xs text-slate-400 uppercase font-bold">Email</label>
                    <p class="text-slate-800"><?= htmlspecialchars($contact['email'] ?? 'Không có') ?></p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-xs text-slate-400 uppercase font-bold">Dịch vụ quan tâm</label>
                        <p class="text-blue-600 font-semibold"><?= htmlspecialchars($contact['service_type']) ?></p>
                    </div>
                    <?php if(!empty($contact['related_template'])): ?>
                    <div>
                        <label class="text-xs text-slate-400 uppercase font-bold">Template liên quan</label>
                        <p class="text-slate-800"><?= htmlspecialchars($contact['related_template']) ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Lời nhắn</label>
                    <div class="bg-slate-50 p-4 rounded-lg text-slate-700 text-sm mt-1 leading-relaxed border border-slate-100">
                        <?= nl2br(htmlspecialchars($contact['message'])) ?>
                    </div>
                </div>
                
                <div class="mt-4 text-xs text-slate-400 text-right">
                    Gửi lúc: <?= date('H:i - d/m/Y', strtotime($contact['created_at'])) ?>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-4">
            <form action="/admin/contact/update/<?= $contact['id'] ?>" method="POST" class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm sticky top-6">
                <h2 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Xử lý liên hệ</h2>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Trạng thái xử lý</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500">
                        <option value="new" <?= $contact['status'] == 'new' ? 'selected' : '' ?>>Mới nhận</option>
                        <option value="contacted" <?= $contact['status'] == 'contacted' ? 'selected' : '' ?>>Đã liên hệ tư vấn</option>
                        <option value="completed" <?= $contact['status'] == 'completed' ? 'selected' : '' ?>>Đơn hàng hoàn thành</option>
                        <option value="spam" <?= $contact['status'] == 'spam' ? 'selected' : '' ?>>Đánh dấu Spam</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ghi chú nội bộ (Admin Note)</label>
                    <textarea name="admin_note" rows="6" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="Ghi lại tiến độ tư vấn, báo giá..."><?= htmlspecialchars($contact['admin_note'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition-colors shadow-lg shadow-slate-200 flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Cập nhật trạng thái
                </button>
            </form>
        </div>

    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>