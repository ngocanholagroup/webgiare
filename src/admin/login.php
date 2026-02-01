<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị - HolaGroup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] animate-pulse animation-delay-2000"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-pink-500 text-white shadow-lg mb-4">
                    <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                </div>
                <h1 class="text-2xl font-bold text-white">HolaGroup Admin</h1>
                <p class="text-slate-400 text-sm mt-1">Đăng nhập để truy cập hệ thống</p>
            </div>

            <form action="index.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300">Tài khoản</label>
                    <div class="relative">
                        <input type="text" placeholder="admin@holagroup.com" class="w-full bg-slate-800/50 border border-slate-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent block w-full pl-10 p-3 outline-none transition-all placeholder-slate-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 flex justify-between">
                        Mật khẩu
                        <a href="#" class="text-orange-400 hover:text-orange-300 text-xs">Quên mật khẩu?</a>
                    </label>
                    <div class="relative">
                        <input type="password" placeholder="••••••••" class="w-full bg-slate-800/50 border border-slate-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent block w-full pl-10 p-3 outline-none transition-all placeholder-slate-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-slate-500"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember-me" type="checkbox" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-slate-700 rounded bg-slate-800">
                    <label for="remember-me" class="ml-2 block text-sm text-slate-300">Ghi nhớ đăng nhập</label>
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-pink-600 hover:from-orange-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all transform hover:-translate-y-0.5">
                    Đăng nhập ngay
                </button>
            </form>
            
            <p class="mt-6 text-center text-xs text-slate-500">
                &copy; 2026 HolaGroup Tech Solution.
            </p>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>