<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $title ?? 'Web Giá Rẻ - Thiết kế website trọn gói uy tín, chuyên nghiệp' ?></title>
    
    <meta name="description" content="<?= $description ?? 'Dịch vụ thiết kế website giá rẻ, chuẩn SEO tại TP.HCM. Kho giao diện đẹp, load nhanh, bảo hành trọn đời. Tư vấn giải pháp chuyển đổi số toàn diện cho doanh nghiệp.' ?>">
    
    <meta name="keywords" content="thiết kế web giá rẻ, làm web trọn gói, web chuẩn seo, thiết kế website hcm, holagroup">
    
    <meta name="author" content="HolaGroup Tech Team">
    <meta name="copyright" content="HolaGroup">
    
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="og:site_name" content="HolaGroup - Web Giá Rẻ">
    <meta property="og:title" content="<?= $title ?? 'Web Giá Rẻ - Thiết kế website chuyên nghiệp' ?>">
    <meta property="og:description" content="<?= $description ?? 'Dịch vụ thiết kế website chuẩn SEO, giao diện hiện đại, tối ưu trải nghiệm người dùng.' ?>">
    <meta property="og:image" content="<?= $og_image ?? 'http://yourdomain.com/assets/images/social-share-default.jpg' ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="vi_VN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $title ?? 'Web Giá Rẻ - Thiết kế website chuyên nghiệp' ?>">
    <meta name="twitter:description" content="<?= $description ?? 'Dịch vụ thiết kế website chuẩn SEO, giao diện hiện đại.' ?>">
    <meta name="twitter:image" content="<?= $og_image ?? 'http://yourdomain.com/assets/images/social-share-default.jpg' ?>">

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ProfessionalService",
      "name": "HolaGroup - Web Giá Rẻ",
      "image": "http://yourdomain.com/assets/logo.png",
      "@id": "http://yourdomain.com",
      "url": "http://yourdomain.com",
      "telephone": "0973157932",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "119 Đường Lê Bôi, Phường 7, Quận 8",
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
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "08:00",
        "closes": "18:00"
      },
      "sameAs": [
        "https://www.facebook.com/holagroup",
        "https://twitter.com/holagroup",
        "https://www.instagram.com/holagroup"
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
        /* Smooth scrolling cho toàn trang */
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <header class="fixed w-full top-0 z-50 transition-all duration-300" id="main-header">
        
        <div class="bg-slate-900 text-white py-2 text-xs md:text-sm hidden md:block border-b border-slate-800">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <a href="mailto:sale@holagroup.com.vn" class="flex items-center gap-2 opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                        <i data-lucide="mail" class="w-3.5 h-3.5"></i> sale@holagroup.com.vn
                    </a>
                    <a href="tel:0973157932" class="flex items-center gap-2 opacity-80 hover:opacity-100 hover:text-orange-400 transition">
                        <i data-lucide="phone" class="w-3.5 h-3.5"></i> 0973.157.932
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/tin-tuc" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">Tin tức</a>
                    <a href="/tuyen-dung" class="opacity-80 hover:opacity-100 hover:text-orange-400 transition">Tuyển dụng</a>
                </div>
            </div>
        </div>

        <nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm relative">
            <div class="container mx-auto px-4 py-3 md:py-4">
                <div class="flex items-center justify-between">
                    
                    <a href="/" class="flex items-center gap-2.5 group" title="Về trang chủ Web Giá Rẻ">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20 group-hover:rotate-12 transition-transform duration-300">
                            <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                        </div>
                        <div class="leading-tight">
                            <span class="block text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700">HolaGroup</span>
                            <span class="block text-[10px] font-bold tracking-[0.2em] text-orange-500 uppercase">Tech Solution</span>
                        </div>
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
                            Blog
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>

                    <div class="hidden lg:flex">
                        <a href="/lien-he" class="group bg-slate-900 hover:bg-orange-600 text-white text-sm font-bold px-6 py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-slate-900/20 hover:shadow-orange-500/30 flex items-center gap-2 transform hover:-translate-y-0.5">
                            <span>Báo giá ngay</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-lg transition-colors" aria-label="Mở menu">
                        <i data-lucide="menu" class="w-7 h-7"></i>
                    </button>

                </div>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute w-full left-0 top-full shadow-2xl transition-all duration-300 origin-top z-50">
                <div class="flex flex-col p-4 space-y-2 max-h-[80vh] overflow-y-auto">
                    <a href="/" class="px-4 py-3 text-orange-600 bg-orange-50 font-semibold rounded-lg flex items-center gap-3">
                        <i data-lucide="home" class="w-5 h-5"></i> Trang chủ
                    </a>
                    <a href="/kho-giao-dien" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg flex items-center gap-3">
                        <i data-lucide="layout-template" class="w-5 h-5"></i> Kho giao diện
                    </a>
                    <a href="/dich-vu" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg flex items-center gap-3">
                        <i data-lucide="briefcase" class="w-5 h-5"></i> Dịch vụ
                    </a>
                    <a href="/gioi-thieu" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg flex items-center gap-3">
                        <i data-lucide="info" class="w-5 h-5"></i> Giới thiệu
                    </a>
                    <a href="/tin-tuc" class="px-4 py-3 text-gray-700 hover:text-orange-600 hover:bg-gray-50 font-semibold rounded-lg flex items-center gap-3">
                        <i data-lucide="newspaper" class="w-5 h-5"></i> Tin tức
                    </a>
                    
                    <div class="h-px bg-gray-100 my-2"></div>
                    
                    <a href="/lien-he" class="px-4 py-3 text-center text-white bg-orange-500 hover:bg-orange-600 font-bold rounded-lg shadow-md transition-colors">
                        Liên hệ báo giá
                    </a>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="h-[72px] md:h-[106px]"></div>

    <main class="flex-grow">