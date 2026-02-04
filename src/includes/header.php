<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $meta_title ?? $title ?? setting('default_title') ?></title>
    
    <meta name="description" content="<?= $meta_desc ?? $description ?? setting('default_desc') ?>">
    <meta name="keywords" content="<?= $meta_keywords ?? setting('default_keywords') ?>">
    <meta name="robots" content="<?= $meta_robots ?? 'index, follow' ?>">
    <meta name="author" content="<?= $meta_author ?? setting('company_name', 'HolaGroup') ?>">
    <meta name="copyright" content="<?= setting('company_name', 'HolaGroup') ?>">

    <link rel="canonical" href="<?= $meta_canonical ?? "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />

    <meta property="og:type" content="<?= $og_type ?? 'website' ?>">
    <meta property="og:url" content="<?= $meta_canonical ?? "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="og:site_name" content="<?= setting('company_name', 'HolaGroup') ?>">
    <meta property="og:title" content="<?= $meta_title ?? $title ?? setting('default_title') ?>">
    <meta property="og:description" content="<?= $meta_desc ?? $description ?? setting('default_desc') ?>">
    <meta property="og:image" content="<?= $og_image ?? setting('default_share_image') ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="vi_VN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $meta_title ?? $title ?? setting('default_title') ?>">
    <meta name="twitter:description" content="<?= $meta_desc ?? $description ?? setting('default_desc') ?>">
    <meta name="twitter:image" content="<?= $og_image ?? setting('default_share_image') ?>">

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">

    <?php if (isset($schema_json) && !empty($schema_json)): ?>
    <script type="application/ld+json">
        <?= $schema_json ?>
    </script>
    <?php endif; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ProfessionalService",
      "name": "<?= setting('company_name', 'HolaGroup') ?>",
      "image": "<?= setting('default_share_image') ?>",
      "@id": "http://<?= $_SERVER['HTTP_HOST'] ?>",
      "url": "http://<?= $_SERVER['HTTP_HOST'] ?>",
      "telephone": "<?= setting('company_phone') ?>",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= setting('company_address') ?>",
        "addressLocality": "Hồ Chí Minh",
        "postalCode": "700000",
        "addressCountry": "VN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 10.762622,
        "longitude": 106.660172
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        "opens": "08:00",
        "closes": "18:00"
      },
      "sameAs": [
        "<?= setting('social_facebook') ?>",
        "<?= setting('social_zalo') ?>"
      ]
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            500: '#f97316', 
                            600: '#ea580c', 
                            900: '#1a202c', 
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                },
            },
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen overflow-x-hidden">

    <header class="fixed w-full top-0 z-50 transition-all duration-300" id="main-header">
        
        <div class="bg-slate-900 text-white py-2 text-xs md:text-sm hidden md:block border-b border-slate-800">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <a href="mailto:<?= setting('company_email') ?>" class="flex items-center gap-2 opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                        <i data-lucide="mail" class="w-3.5 h-3.5"></i> <?= setting('company_email') ?>
                    </a>
                    <a href="tel:<?= setting('company_phone') ?>" class="flex items-center gap-2 opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                        <i data-lucide="phone" class="w-3.5 h-3.5"></i> <?= setting('company_phone') ?>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/tin-tuc" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">Tin tức & Sự kiện</a>
                </div>
            </div>
        </div>

        <nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm relative z-50">
            <div class="container mx-auto px-4 py-3 md:py-4">
                <div class="flex items-center justify-between">
                    
                    <a href="/" class="flex items-center gap-2.5 group" title="Về trang chủ">
                        <?php if(setting('site_logo_url')): ?>
                            <img src="<?= setting('site_logo_url') ?>" alt="<?= setting('company_name') ?>" class="h-10 w-auto">
                        <?php else: ?>
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20 group-hover:rotate-12 transition-transform duration-300">
                                <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                            </div>
                            <div class="leading-tight">
                                <span class="block text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700">
                                    <?= setting('company_name', 'HolaGroup') ?>
                                </span>
                                <span class="block text-[10px] font-bold tracking-[0.2em] text-orange-500 uppercase">
                                    <?= setting('company_slogan', 'Tech Solution') ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </a>

                    <div class="hidden lg:flex items-center gap-8">
                        <a href="/" class="relative text-sm font-bold text-gray-700 hover:text-orange-600 transition-colors group py-2">
                            Trang chủ
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/gioi-thieu" class="relative text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors group py-2">
                            Giới thiệu
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/dich-vu" class="relative text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors group py-2">
                            Dịch vụ
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/kho-giao-dien" class="relative text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors group py-2">
                            Kho giao diện
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/tin-tuc" class="relative text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors group py-2">
                            Tin tức
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>

                    <div class="hidden lg:flex">
                        <a href="/lien-he" class="group bg-slate-900 hover:bg-orange-600 text-white text-sm font-bold px-6 py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-slate-900/20 hover:shadow-orange-500/30 flex items-center gap-2 transform hover:-translate-y-0.5">
                            <span>Báo giá ngay</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-lg transition-colors z-50 relative" aria-label="Mở menu">
                        <i data-lucide="menu" class="w-7 h-7"></i>
                    </button>

                </div>
            </div>
        </nav>
    </header>

    <div id="mobile-backdrop" class="fixed inset-0 bg-slate-900/50 z-[60] hidden transition-opacity duration-300 opacity-0 backdrop-blur-sm"></div>

    <div id="mobile-menu" class="fixed top-0 right-0 w-[300px] h-full bg-white z-[70] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
        
        <div class="p-5 flex items-center justify-between border-b border-gray-100">
            <span class="text-lg font-bold text-slate-800"><?= setting('company_name', 'HolaGroup') ?></span>
            <button id="close-menu-btn" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 flex flex-col gap-2">
            <a href="/" class="px-4 py-3 text-orange-600 bg-orange-50 font-semibold rounded-xl flex items-center gap-3">
                <i data-lucide="home" class="w-5 h-5"></i> Trang chủ
            </a>
            <a href="/kho-giao-dien" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-xl flex items-center gap-3">
                <i data-lucide="layout-template" class="w-5 h-5"></i> Kho giao diện
            </a>
            <a href="/dich-vu" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-xl flex items-center gap-3">
                <i data-lucide="briefcase" class="w-5 h-5"></i> Dịch vụ
            </a>
            <a href="/gioi-thieu" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-xl flex items-center gap-3">
                <i data-lucide="info" class="w-5 h-5"></i> Giới thiệu
            </a>
            <a href="/tin-tuc" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-xl flex items-center gap-3">
                <i data-lucide="newspaper" class="w-5 h-5"></i> Tin tức
            </a>

            <div class="mt-6 border-t border-gray-100 pt-6 space-y-4">
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Liên hệ</p>
                <a href="tel:<?= setting('company_phone') ?>" class="px-4 flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-orange-600">
                    <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                    </div>
                    <?= setting('company_phone') ?>
                </a>
                <a href="mailto:<?= setting('company_email') ?>" class="px-4 flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-orange-600">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <?= setting('company_email') ?>
                </a>
            </div>
        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <a href="/lien-he" class="flex items-center justify-center gap-2 w-full py-3.5 bg-slate-900 text-white font-bold rounded-xl shadow-lg hover:bg-orange-600 transition-colors">
                Liên hệ báo giá <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>

    <div class="h-[72px] md:h-[106px]"></div>

    <main class="flex-grow">