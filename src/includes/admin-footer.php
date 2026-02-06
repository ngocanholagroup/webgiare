</main>
<footer class="border-t border-slate-200 bg-white py-4 px-8">
    <div class="flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
        <p>
            &copy; <?php echo date("Y"); ?> <span class="font-bold text-slate-700">HolaGroup System</span>. Version 2.0
        </p>
        <div class="flex gap-4 mt-2 md:mt-0">
            <span class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full bg-green-500"></div> Server: Online
            </span>
            <span class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full bg-blue-500"></div> DB: Connected
            </span>
        </div>
    </div>
</footer>

</div>

<script>
    // 1. Khởi tạo Icons
    lucide.createIcons();

    // 2. Logic Sidebar Mobile
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        const isClosed = sidebar.classList.contains('-translate-x-full');

        if (isClosed) {
            // Mở menu
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10); // Fade in overlay
        } else {
            // Đóng menu
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300); // Đợi fade out xong mới ẩn
        }
    }

    // 3. Auto đóng menu khi resize màn hình to ra (tránh lỗi UI)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            overlay.classList.add('hidden', 'opacity-0');
            sidebar.classList.remove('-translate-x-full'); // Đảm bảo hiện lại trên desktop
        } else {
            if (overlay.classList.contains('hidden')) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>

<style>
    /* CSS cho Tab trong Header */
    .nav-tab.active {
        color: #ea580c;
        /* orange-600 */
        border-bottom-color: #ea580c;
        background-color: transparent;
    }

    /* Hiệu ứng chuyển đổi nội dung Tab */
    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
        animation: fadeSlideIn 0.2s ease-out;
    }

    @keyframes fadeSlideIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    // Hàm chuyển Tab toàn cục
    function switchTab(tabId) {
        // 1. Ẩn tất cả nội dung tab
        document.querySelectorAll('.tab-panel').forEach(el => el.classList.remove('active'));

        // 2. Reset style tất cả nút tab
        document.querySelectorAll('.nav-tab').forEach(el => el.classList.remove('active'));

        // 3. Hiện tab được chọn
        const targetPanel = document.getElementById(tabId);
        if (targetPanel) targetPanel.classList.add('active');

        // 4. Active nút được chọn
        const targetBtn = document.getElementById('btn-' + tabId);
        if (targetBtn) targetBtn.classList.add('active');
    }
</script>
</body>

</html>