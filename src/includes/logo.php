<a href="/" class="flex items-center gap-2.5 group" title="Về trang chủ">

    <?php if ($logo = setting('site_logo_url')): ?>
        <div class="rounded-lg overflow-hidden">
            <img
                src="<?= $logo ?>"
                alt="<?= setting('company_name', 'HolaGroup') ?>"
                class="h-10 w-auto object-contain"
            >
        </div>
    <?php else: ?>
        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-lg
                    flex items-center justify-center text-white shadow-lg shadow-orange-500/20
                    group-hover:rotate-12 transition-transform duration-300">
            <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
        </div>
    <?php endif; ?>

    <div class="leading-tight">
        <span class="block text-xl font-extrabold text-slate-600">
            <?= setting('company_name', 'HolaGroup') ?>
        </span>
        <span class="block text-[10px] font-bold tracking-[0.2em]
                     text-orange-500 uppercase">
            <?= setting('company_slogan', 'Tech Solution') ?>
        </span>
    </div>

</a>
