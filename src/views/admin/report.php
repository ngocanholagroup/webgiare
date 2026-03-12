<?php include 'includes/admin-header.php'; ?>

<main class="p-6 overflow-y-auto h-full">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Báo cáo & Thống kê</h2>
            <p class="text-sm text-slate-500 mt-1">Xem dữ liệu truy cập từ Google Analytics / Looker Studio.</p>
        </div>
        
        <!-- Toggle Config Button -->
        <button onclick="document.getElementById('config-modal').classList.toggle('hidden')" 
                class="flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 text-sm font-medium transition">
            <i data-lucide="settings" class="w-4 h-4"></i> Cấu hình Báo cáo
        </button>
    </div>

    <!-- Config Modal -->
    <div id="config-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative animate-fade-in-up">
            <button onclick="document.getElementById('config-modal').classList.add('hidden')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            
            <h3 class="text-lg font-bold text-slate-800 mb-4">Cấu hình Embed URL</h3>
            
            <form action="/admin/report/save" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Looker Studio Embed URL</label>
                    <input type="url" name="analytics_embed_url" value="<?= htmlspecialchars($embedUrl ?? '') ?>" 
                           class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                           placeholder="https://lookerstudio.google.com/embed/reporting/...">
                    <p class="text-xs text-slate-500 mt-2">
                        Vào <strong>Looker Studio</strong> -> Tạo báo cáo -> Chia sẻ -> Nhúng báo cáo -> Copy URL trong thẻ iframe (src="...").
                    </p>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('config-modal').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg text-sm font-medium transition">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 text-sm font-medium transition">Lưu cấu hình</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Display -->
    <?php if (!empty($embedUrl)): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-[800px]">
            <iframe src="<?= htmlspecialchars($embedUrl) ?>" frameborder="0" style="border:0" allowfullscreen class="w-full h-full"></iframe>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="bar-chart-2" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Chưa cấu hình báo cáo</h3>
            <p class="text-slate-500 max-w-md mx-auto mb-6">
                Bạn chưa nhập đường dẫn nhúng báo cáo từ Google Looker Studio. 
                Hãy tạo một báo cáo miễn phí kết nối với GA4 của bạn để xem biểu đồ trực quan tại đây.
            </p>
            <button onclick="document.getElementById('config-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 text-white rounded-full hover:bg-orange-700 font-medium transition shadow-lg shadow-orange-500/30">
                <i data-lucide="plus" class="w-4 h-4"></i> Thêm báo cáo ngay
            </button>
        </div>
    <?php endif; ?>

</main>

<script>
    lucide.createIcons();
</script>
