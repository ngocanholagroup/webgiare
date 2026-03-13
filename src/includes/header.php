<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if ($ga_id = setting('google_analytics_id')): ?>
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($ga_id) ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= htmlspecialchars($ga_id) ?>');
    </script>
    <?php endif; ?>

    <?php if ($gtm_id = setting('google_tag_manager_id')): ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?= htmlspecialchars($gtm_id) ?>');</script>
    <!-- End Google Tag Manager -->
    <?php endif; ?>

    <?php if ($clarity_id = setting('microsoft_clarity_id')): ?>
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "<?= htmlspecialchars($clarity_id) ?>");
    </script>
    <?php endif; ?>

    <title><?= htmlspecialchars($meta_title ?? $title ?? setting('default_title'), ENT_QUOTES, 'UTF-8') ?></title>
    
    <meta name="description" content="<?= htmlspecialchars($meta_desc ?? $description ?? setting('default_desc'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords ?? setting('default_keywords'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="robots" content="<?= htmlspecialchars($meta_robots ?? 'index, follow', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="author" content="<?= htmlspecialchars($meta_author ?? setting('company_name', 'HolaGroup'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="copyright" content="<?= htmlspecialchars(setting('company_name', 'HolaGroup'), ENT_QUOTES, 'UTF-8') ?>">

    <link rel="canonical" href="<?= $meta_canonical ?? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]" . htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') ?>" />

    <meta property="og:type" content="<?= htmlspecialchars($og_type ?? 'website', ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:url" content="<?= $meta_canonical ?? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]" . htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:site_name" content="<?= htmlspecialchars(setting('company_name', 'HolaGroup'), ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:title" content="<?= htmlspecialchars($meta_title ?? $title ?? setting('default_title'), ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_desc ?? $description ?? setting('default_desc'), ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_image ?? setting('default_share_image'), ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="vi_VN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($meta_title ?? $title ?? setting('default_title'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta_desc ?? $description ?? setting('default_desc'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($og_image ?? setting('default_share_image'), ENT_QUOTES, 'UTF-8') ?>">

    <?php $favicon = setting('site_favicon_url', '/assets/favicon.ico'); ?>
    <link rel="icon" href="<?= $favicon ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= $favicon ?>" type="image/x-icon">
    
    <!-- Sitemap -->
    <link rel="sitemap" type="application/xml" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?>/sitemap.xml" />

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
      "@id": "<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?>",
      "url": "<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?>",
      "telephone": "<?= setting('company_phone') ?>",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= setting('company_address') ?>",
        "addressLocality": "<?= setting('company_city', 'Hồ Chí Minh') ?>",
        "postalCode": "<?= setting('company_postal_code', '700000') ?>",
        "addressCountry": "<?= setting('company_country', 'VN') ?>"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": <?= setting('company_latitude', '10.762622') ?>,
        "longitude": <?= setting('company_longitude', '106.660172') ?>
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        "opens": "<?= setting('company_open_time', '08:00') ?>",
        "closes": "<?= setting('company_close_time', '18:00') ?>"
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        /* Tối ưu hiển thị cho gạch chân active */
        .nav-active-bar { width: 100% !important; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen overflow-x-hidden">
    <?php if ($gtm_id = setting('google_tag_manager_id')): ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= htmlspecialchars($gtm_id) ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>

    <?php
    // Logic xác định trang hiện tại để Active Menu
    $current_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Hàm helper kiểm tra active
    function is_active($path, $current_uri) {
        if ($path === '/') {
            return $current_uri === '/' ? 'text-orange-600' : 'text-gray-700';
        }
        return (strpos($current_uri, $path) === 0) ? 'text-orange-600' : 'text-gray-700';
    }

    // Hàm helper cho gạch chân
    function is_active_bar($path, $current_uri) {
        if ($path === '/') {
            return $current_uri === '/' ? 'w-full' : 'w-0';
        }
        return (strpos($current_uri, $path) === 0) ? 'w-full' : 'w-0';
    }
    ?>

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
                    <div class="flex items-center gap-2 text-xs">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        <span>Mon-Sun: 00:00 - 23:59</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?= setting('social_facebook') ?>" target="_blank" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                            <i class="fab fa-facebook-f w-4 h-4 flex items-center justify-center"></i>
                        </a>
                        <a href="<?= setting('social_google', 'https://google.com') ?>" target="_blank" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                            <i class="fab fa-google w-4 h-4 flex items-center justify-center"></i>
                        </a>
                        <a href="<?= setting('social_twitter', 'https://twitter.com') ?>" target="_blank" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                            <i class="fab fa-x-twitter w-4 h-4 flex items-center justify-center"></i>
                        </a>
                        <a href="<?= setting('social_tiktok', 'https://tiktok.com') ?>" target="_blank" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                            <i class="fab fa-tiktok w-4 h-4 flex items-center justify-center"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm relative z-50">
            <div class="container mx-auto px-4 py-3 md:py-4">
                <div class="flex items-center justify-between">
                    
                    <?php include 'logo.php'; ?>

                    <div class="hidden lg:flex items-center gap-8">
                        <a href="/" class="relative text-sm font-bold <?= is_active('/', $current_uri) ?> hover:text-orange-600 transition-colors group py-2">
                            Trang chủ
                            <span class="absolute bottom-0 left-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full <?= is_active_bar('/', $current_uri) ?>"></span>
                        </a>
                        <a href="/gioi-thieu" class="relative text-sm font-semibold <?= is_active('/gioi-thieu', $current_uri) ?> hover:text-orange-600 transition-colors group py-2">
                            Giới thiệu
                            <span class="absolute bottom-0 left-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full <?= is_active_bar('/gioi-thieu', $current_uri) ?>"></span>
                        </a>
                        <a href="/dich-vu" class="relative text-sm font-semibold <?= is_active('/dich-vu', $current_uri) ?> hover:text-orange-600 transition-colors group py-2">
                            Dịch vụ
                            <span class="absolute bottom-0 left-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full <?= is_active_bar('/dich-vu', $current_uri) ?>"></span>
                        </a>
                        <a href="/kho-giao-dien" class="relative text-sm font-semibold <?= is_active('/kho-giao-dien', $current_uri) ?> hover:text-orange-600 transition-colors group py-2">
                            Kho giao diện
                            <span class="absolute bottom-0 left-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full <?= is_active_bar('/kho-giao-dien', $current_uri) ?>"></span>
                        </a>
                        <a href="/tin-tuc" class="relative text-sm font-semibold <?= is_active('/tin-tuc', $current_uri) ?> hover:text-orange-600 transition-colors group py-2">
                            Tin tức
                            <span class="absolute bottom-0 left-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full <?= is_active_bar('/tin-tuc', $current_uri) ?>"></span>
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
            <a href="/" class="px-4 py-3 font-semibold rounded-xl flex items-center gap-3 transition-colors <?= $current_uri === '/' ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                <i data-lucide="home" class="w-5 h-5"></i> Trang chủ
            </a>
            <a href="/kho-giao-dien" class="px-4 py-3 font-semibold rounded-xl flex items-center gap-3 transition-colors <?= strpos($current_uri, '/kho-giao-dien') === 0 ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                <i data-lucide="layout-template" class="w-5 h-5"></i> Kho giao diện
            </a>
            <a href="/dich-vu" class="px-4 py-3 font-semibold rounded-xl flex items-center gap-3 transition-colors <?= strpos($current_uri, '/dich-vu') === 0 ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                <i data-lucide="briefcase" class="w-5 h-5"></i> Dịch vụ
            </a>
            <a href="/gioi-thieu" class="px-4 py-3 font-semibold rounded-xl flex items-center gap-3 transition-colors <?= strpos($current_uri, '/gioi-thieu') === 0 ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                <i data-lucide="info" class="w-5 h-5"></i> Giới thiệu
            </a>
            <a href="/tin-tuc" class="px-4 py-3 font-semibold rounded-xl flex items-center gap-3 transition-colors <?= strpos($current_uri, '/tin-tuc') === 0 ? 'text-orange-600 bg-orange-50' : 'text-gray-700 hover:bg-gray-50' ?>">
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