<?php include 'includes/admin-header.php'; ?>

<form action="/admin/page/update/<?= $page['id'] ?>" method="POST">
    
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200 w-full">
        <a href="/admin/page" class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
        </a>
        <button type="submit" class="bg-slate-800 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-orange-600 transition-all shadow-lg shadow-slate-300 inline-flex items-center gap-2">
            <i data-lucide="save" class="w-4 h-4"></i> Lưu Trang
        </button>
    </div>
       
    <div class="flex flex-col gap-6">
        
        <div class="space-y-6">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm sticky top-24">
                <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="settings" class="w-4 h-4"></i> Cấu hình SEO
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase">Tên trang</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($page['name']) ?>" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase">Meta Title</label>
                        <input type="text" name="meta_title" value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase">Meta Description</label>
                        <textarea name="meta_desc" rows="4" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500"><?= htmlspecialchars($page['meta_desc'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-3 mb-6 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4"></i> Nội dung trang (JSON Editor)
                </h3>

                <?php 
                // CHUẨN BỊ DỮ LIỆU CHO COMPONENT
                $json_data = $content; // Biến $content được decode từ Controller
                $json_root_name = 'content'; // Tên mảng $_POST['content'] khi submit
                
                // GỌI COMPONENT
                include 'includes/json-form.php'; 
                ?>
            </div>
        </div>
    </div>
</form>

<?php include 'includes/admin-footer.php'; ?>