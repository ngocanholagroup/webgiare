</main> <footer class="border-t border-slate-200 bg-white py-4 px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
                <p>
                    &copy; <?php echo date("Y"); ?> <span class="font-bold text-slate-700">HolaGroup System</span>. Version 2.0
                </p>
                <div class="flex gap-4 mt-2 md:mt-0">
                    <span class="flex items-center gap-1"><div class="w-2 h-2 rounded-full bg-green-500"></div> Server: Online</span>
                    <span class="flex items-center gap-1"><div class="w-2 h-2 rounded-full bg-blue-500"></div> DB: Connected</span>
                </div>
            </div>
        </footer>

    </div> <script>
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
                if(overlay.classList.contains('hidden')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>
</body>
</html>