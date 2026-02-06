<?php
// src/views/admin/login.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống - HolaGroup</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: { 500: '#f97316', 600: '#ea580c' },
                        slate: { 800: '#1e293b', 900: '#0f172a' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.5s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .bg-noise { background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E"); }
        /* CSS cho Loading Spinner */
        .spinner {
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top: 2px solid #fff;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-slate-900 font-sans h-screen w-full overflow-hidden flex items-center justify-center relative">

    <div class="absolute inset-0 bg-noise pointer-events-none z-0"></div>
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-orange-600/30 rounded-full blur-[120px] animate-float z-0"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[120px] animate-float z-0" style="animation-delay: 2s;"></div>

    <div class="relative z-10 w-full max-w-md px-4 animate-fade-in-up">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-700/50">
            
            <div class="px-8 pt-8 pb-6 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-lg shadow-orange-500/30 mb-6">
                    <i data-lucide="zap" class="w-8 h-8 text-white fill-current"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Đăng nhập quản trị</h1>
                <p class="text-sm text-slate-500 mt-2">Hệ thống quản lý nội dung HolaGroup</p>
            </div>

            <div class="px-8 pb-10">
                
                <?php if(!empty($error)): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium animate-pulse">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <form id="loginForm" action="/admin/login" method="POST" class="space-y-5">
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Tài khoản</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            <input type="text" name="username" required 
                                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-medium placeholder-slate-400" 
                                placeholder="Tên đăng nhập">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5 ml-1">
                            <label class="block text-sm font-bold text-slate-700">Mật khẩu</label>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            <input type="password" name="password" id="password" required 
                                class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-medium placeholder-slate-400" 
                                placeholder="••••••••">
                            
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none transition-colors" title="Hiện mật khẩu">
                                <i data-lucide="eye" class="w-5 h-5" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="w-full group relative flex justify-center items-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg shadow-slate-900/30 hover:shadow-orange-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        <span id="btnText" class="flex items-center">
                            Đăng nhập ngay <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                        </span>
                        <div id="btnSpinner" class="hidden spinner mr-2"></div>
                        <span id="btnLoadingText" class="hidden">Đang xử lý...</span>
                    </button>

                </form>
            </div>
            
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500 font-medium">
                    &copy; 2026 HolaGroup System.
                </p>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-slate-400 hover:text-white text-sm font-medium transition-colors flex items-center justify-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay về trang chủ
            </a>
        </div>

    </div>

    <script>
        // 1. Khởi tạo Icons
        lucide.createIcons();

        // 2. Sự kiện Ẩn/Hiện Mật khẩu
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off'); // Đổi icon thành gạch chéo
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            // Cần gọi lại createIcons để Lucide vẽ lại icon mới
            lucide.createIcons();
        }

        // 3. Sự kiện Submit Form (Hiệu ứng Loading)
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const btnLoadingText = document.getElementById('btnLoadingText');

        loginForm.addEventListener('submit', function(e) {
            // 1. Vô hiệu hóa nút để chống spam click
            submitBtn.disabled = true;
            submitBtn.classList.add('cursor-not-allowed', 'bg-slate-700'); // Đổi màu xám chút
            
            // 2. Ẩn text cũ, hiện spinner và text loading
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            btnLoadingText.classList.remove('hidden');
        });
    </script>
</body>
</html>