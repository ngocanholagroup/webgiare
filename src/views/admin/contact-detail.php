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
        <div class="col-span-12">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Thông tin liên hệ</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-slate-700">Họ và tên</label>
                        <p class="text-slate-800 font-medium text-lg"><?= htmlspecialchars($contact['full_name']) ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Số điện thoại</label>
                        <p class="text-slate-800 font-medium text-lg flex items-center gap-2">
                            <?= htmlspecialchars($contact['phone']) ?>
                            <a href="tel:<?= $contact['phone'] ?>" class="text-green-600 bg-green-50 p-1.5 rounded-full hover:bg-green-100"><i data-lucide="phone" class="w-3 h-3"></i></a>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Email</label>
                        <p class="text-slate-800 font-medium text-lg"><?= htmlspecialchars($contact['email'] ?? 'Không có') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Dịch vụ quan tâm</label>
                        <p class="text-blue-600 font-semibold"><?= htmlspecialchars($contact['service_type']) ?></p>
                    </div>
                    <?php if(!empty($contact['related_template'])): ?>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Template liên quan</label>
                        <p class="text-slate-800 font-medium text-lg"><?= htmlspecialchars($contact['related_template']) ?></p>
                    </div>
                    <?php endif; ?>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Lời nhắn</label>
                        <div class="bg-slate-50 p-4 rounded-lg text-slate-700 text-sm mt-1 leading-relaxed border border-slate-100">
                            <?= nl2br(htmlspecialchars($contact['message'])) ?>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-slate-700">Gửi lúc</label>
                        <p class="text-slate-800 font-medium text-lg"><?= date('H:i - d/m/Y', strtotime($contact['created_at'])) ?></p>
                    </div>
                    <!-- Thêm vào cái select để đánh dấu trạng thái ở đây: 'new', 'contacted', 'completed', 'spam' -->
                    <form id="contact-form" action="/admin/contact/update/<?= $contact['id'] ?>" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(SecurityHelper::getCSRFToken() ?? '') ?>">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Trạng thái</label>
                        <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm">
                            <option value="new" <?= $contact['status'] === 'new' ? 'selected' : '' ?>>Mới</option>
                            <option value="contacted" <?= $contact['status'] === 'contacted' ? 'selected' : '' ?>>Đã liên hệ</option>
                            <option value="completed" <?= $contact['status'] === 'completed' ? 'selected' : '' ?>>Đã xử lý</option>
                            <option value="spam" <?= $contact['status'] === 'spam' ? 'selected' : '' ?>>Spam</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Ghi chú nội bộ (Admin Note)</label>
                        <textarea name="admin_note" rows="6" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="Ghi lại tiến độ tư vấn, báo giá..."><?= htmlspecialchars($contact['admin_note'] ?? '') ?></textarea>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Fixed Save Button -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 shadow-lg z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">
                <span id="save-status" class="hidden">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Đang lưu...
                </span>
                <span id="save-success" class="hidden text-green-600">
                    <i class="fas fa-check mr-2"></i>Đã lưu!
                </span>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="window.location.href='/admin/contact'" 
                        class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">
                    <i class="fas fa-times mr-2"></i>Hủy bỏ
                </button>
                <button type="submit" form="contact-form" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>Lưu
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add padding bottom to avoid content being hidden by fixed button -->
<style>
body {
    padding-bottom: 80px;
}
</style>

<!-- JavaScript for form handling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const saveStatus = document.getElementById('save-status');
    const saveSuccess = document.getElementById('save-success');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Show saving status
            saveStatus.classList.remove('hidden');
            saveSuccess.classList.add('hidden');
            
            // Hide saving status after 3 seconds (in case of slow response)
            setTimeout(() => {
                saveStatus.classList.add('hidden');
            }, 3000);
        });
    }
    
    // Show success message when page loads with success parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        saveSuccess.classList.remove('hidden');
        setTimeout(() => {
            saveSuccess.classList.add('hidden');
        }, 3000);
    }
});
</script>

<?php include 'includes/admin-footer.php'; ?>