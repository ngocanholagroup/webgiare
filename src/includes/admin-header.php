<?php
// 1. XỬ LÝ TIÊU ĐỀ (Dynamic Title)
// Lấy biến $title từ Controller truyền qua, nếu không có thì dùng mặc định
$page_title = $title ?? 'Admin Portal - HolaGroup';

// 2. XỬ LÝ ACTIVE MENU
// Lấy đường dẫn hiện tại
$uri = $_SERVER['REQUEST_URI'];
$active_page = basename(parse_url($uri, PHP_URL_PATH));

// Hàm kiểm tra active
function isActive($keyword, $uri)
{
    return strpos($uri, $keyword) !== false ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($page_title) ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            500: '#f97316',
                            600: '#ea580c'
                        },
                        slate: {
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>

</head>

<body class="flex h-screen overflow-hidden">

    <?php include 'admin-sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 lg:pl-64 transition-all duration-300">

        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40 px-4 lg:px-8 flex items-center justify-between">
            <h1 class="text-xl capitalize text-slate-800 mb-4 md:mb-0">
                <?= htmlspecialchars($page_title) ?>
            </h1>
            <a href="/" target="_blank" class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-orange-50 text-slate-600 hover:text-orange-600 rounded-full text-xs font-bold transition-all">
                <i data-lucide="globe" class="w-3.5 h-3.5"></i> Xem trang chủ
            </a>
        </header>

        <main class="flex-1 overflow-y-auto bg-slate-50 relative">

            <?php
            // --- LOGIC RENDER PAGE HEADER & TABS TỰ ĐỘNG ---
            if (isset($page_tabs) && is_array($page_tabs) && !empty($page_tabs)):
            ?>
                <div class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
                    <div class="container mx-auto px-4 md:px-6">
                        <div class="flex space-x-1 mt-2 overflow-x-auto no-scrollbar">
                            <?php foreach ($page_tabs as $index => $tab):
                                $isActive = $index === 0 ? 'active' : ''; // Tab đầu tiên active
                            ?>
                                <button onclick="switchTab('<?= $tab['id'] ?>')"
                                    id="btn-<?= $tab['id'] ?>"
                                    class="nav-tab <?= $isActive ?> flex items-center gap-2 px-4 py-3 border-b-2 border-transparent text-sm font-bold text-slate-500 hover:text-slate-800 hover:border-slate-300 transition-all whitespace-nowrap">
                                    <?php if (isset($tab['icon'])): ?>
                                        <i data-lucide="<?= $tab['icon'] ?>" class="w-4 h-4"></i>
                                    <?php endif; ?>
                                    <?= htmlspecialchars($tab['label']) ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="px-4 md:px-6 py-6">