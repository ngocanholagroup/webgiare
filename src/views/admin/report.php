<?php include 'includes/admin-header.php'; ?>

<main class="p-6 overflow-y-auto h-full">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Báo cáo & Thống kê</h2>
            <p class="text-sm text-slate-500 mt-1">Xem dữ liệu truy cập từ Google Analytics 4.</p>
        </div>
        
        <!-- Toggle Config Button -->
        <button onclick="document.getElementById('config-modal').classList.toggle('hidden')" 
                class="flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 text-sm font-medium transition">
            <i data-lucide="help-circle" class="w-4 h-4"></i> Hướng dẫn cấu hình
        </button>
    </div>

    <!-- Config Modal -->
    <div id="config-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative animate-fade-in-up">
            <button onclick="document.getElementById('config-modal').classList.add('hidden')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            
            <h3 class="text-lg font-bold text-slate-800 mb-4">Cấu hình GA4</h3>
            
            <div class="mb-4 text-sm text-slate-600">
                <p>Để kích hoạt báo cáo, vui lòng thực hiện:</p>
                <ol class="list-decimal list-inside mt-2 space-y-1">
                    <li>Vào trang <a href="/admin/setting" class="text-blue-600 hover:underline">Cài đặt chung</a> để nhập <strong>GA4 Property ID</strong>.</li>
                    <li>Tải file <code>ga4-credentials.json</code> vào thư mục <code>src/config/</code>.</li>
                </ol>
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('config-modal').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg text-sm font-medium transition">Đóng</button>
                <a href="/admin/setting" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 text-sm font-medium transition">Đến trang Cài đặt</a>
            </div>
        </div>
    </div>

    <!-- Report Display -->
    
    <!-- Debug Info Block -->
    <?php if (!empty($debugInfo)): ?>
    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg mb-6 text-sm text-yellow-800">
        <h4 class="font-bold mb-2 flex items-center gap-2">
            <i data-lucide="info" class="w-4 h-4"></i> Thông tin Debug (Tạm thời):
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <span class="font-semibold">GA4 Property ID (Database):</span> 
                <code><?= htmlspecialchars($debugInfo['raw_property_id']) ?></code>
            </div>
            <div>
                <span class="font-semibold">GA4 Measurement ID (Database):</span> 
                <code><?= htmlspecialchars($debugInfo['raw_measurement_id']) ?></code>
            </div>
            <div>
                <span class="font-semibold">Final Property ID Used:</span> 
                <code><?= htmlspecialchars($debugInfo['final_property_id']) ?></code>
            </div>
            <div>
                <span class="font-semibold">Credentials File:</span> 
                <code><?= htmlspecialchars($debugInfo['credentials_exists']) ?></code>
            </div>
            <div class="col-span-1 md:col-span-2">
                <span class="font-semibold">Credentials Path:</span> 
                <code class="break-all"><?= htmlspecialchars($debugInfo['credentials_path']) ?></code>
            </div>
            
            <div class="col-span-1 md:col-span-2 text-red-600">
                <span class="font-semibold">GA Error:</span> 
                <code><?= htmlspecialchars($debugInfo['ga_error'] ?? 'None') ?></code>
            </div>
            <div class="col-span-1 md:col-span-2">
                <span class="font-semibold">Data Status:</span> 
                <code><?= htmlspecialchars($debugInfo['ga_data_status'] ?? 'Unknown') ?></code>
            </div>
            <div class="col-span-1 md:col-span-2">
                <span class="font-semibold">Library Status:</span> 
                <code><?= htmlspecialchars($debugInfo['library_status'] ?? 'Unknown') ?></code>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- 1. GA4 API Charts (Hiển thị nếu có dữ liệu từ API) -->
    <?php if (!empty($gaError)): ?>
        <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
            <div>
                <strong>Lỗi kết nối GA4 API:</strong> <?= htmlspecialchars($gaError) ?>
                <p class="text-sm mt-1">Vui lòng kiểm tra lại <strong>GA4 Property ID</strong> trong Cài đặt và file <code>config/ga4-credentials.json</code>.</p>
            </div>
        </div>
    <?php endif; ?>

    <?php if (is_array($gaData)): ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <!-- Nếu dữ liệu trống (0 users) -->
        <?php if (empty($gaData)): ?>
            <div class="bg-blue-50 text-blue-800 p-4 rounded-lg mb-6 flex items-center gap-3">
                <i data-lucide="info" class="w-5 h-5"></i>
                <div>
                    <strong>Kết nối thành công!</strong>
                    <p class="text-sm mt-1">Tuy nhiên, chưa có dữ liệu truy cập nào trong 7 ngày qua. Hãy thử truy cập trang web để tạo dữ liệu mới.</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                    <i data-lucide="line-chart" class="w-5 h-5 text-blue-600"></i>
                    Thống kê truy cập (7 ngày qua - Realtime API)
                </h3>
                <span class="text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded">Dữ liệu từ Google Analytics 4</span>
            </div>
            
            <div class="h-[350px]">
                <canvas id="gaChart"></canvas>
            </div>

            <!-- Stats Summary Row -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 border-t border-slate-100 pt-6">
                <?php 
                    $totalUsers = array_sum(array_column($gaData, 'users'));
                    $totalViews = array_sum(array_column($gaData, 'views'));
                    $totalEvents = array_sum(array_column($gaData, 'events'));
                    // Avg Duration (Weighted average is better, but simple average for now)
                    $avgDuration = count($gaData) > 0 ? array_sum(array_column($gaData, 'avg_duration')) / count($gaData) : 0;
                ?>
                <div class="text-center">
                    <p class="text-xs text-slate-500 uppercase">Users</p>
                    <p class="text-xl font-bold text-blue-600"><?= number_format($totalUsers) ?></p>
                </div>
                <div class="text-center">
                    <p class="text-xs text-slate-500 uppercase">Page Views</p>
                    <p class="text-xl font-bold text-orange-600"><?= number_format($totalViews) ?></p>
                </div>
                <div class="text-center">
                    <p class="text-xs text-slate-500 uppercase">Avg. Time</p>
                    <p class="text-xl font-bold text-slate-700"><?= number_format($avgDuration, 1) ?>s</p>
                </div>
                <div class="text-center">
                    <p class="text-xs text-slate-500 uppercase">Total Clicks/Events</p>
                    <p class="text-xl font-bold text-green-600"><?= number_format($totalEvents) ?></p>
                </div>
            </div>

            <!-- Top Pages Table (GA4) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                <!-- Col 1: Top Pages -->
                <?php if (!empty($gaTopPages)): ?>
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                    <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-600"></i>
                        Top Trang Xem Nhiều
                    </h4>
                    <div class="overflow-x-auto rounded-lg border border-slate-100 bg-white">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-700 font-medium border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3">Tiêu đề trang</th>
                                    <th class="px-4 py-3 text-right">Views</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($gaTopPages as $page): ?>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 max-w-xs truncate" title="<?= htmlspecialchars($page['title']) ?>">
                                        <?= htmlspecialchars($page['title']) ?>
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-blue-600">
                                        <?= number_format($page['views']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Col 2: Devices & Locations -->
                <div class="space-y-6">
                    <!-- Devices -->
                    <?php if (!empty($gaDevices)): ?>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <i data-lucide="smartphone" class="w-4 h-4 text-purple-600"></i>
                            Thiết bị truy cập
                        </h4>
                        <div class="flex items-center justify-center h-48">
                            <canvas id="deviceChart"></canvas>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Locations -->
                    <?php if (!empty($gaLocations)): ?>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-red-600"></i>
                            Quốc gia / Thành phố
                        </h4>
                        <div class="overflow-hidden rounded-lg border border-slate-100 bg-white">
                            <table class="w-full text-left text-sm text-slate-600">
                                <tbody class="divide-y divide-slate-100">
                                    <?php foreach ($gaLocations as $loc): ?>
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-2">
                                            <div class="font-medium text-slate-800"><?= htmlspecialchars($loc['location']) ?></div>
                                            <div class="text-xs text-slate-400"><?= htmlspecialchars($loc['country']) ?></div>
                                        </td>
                                        <td class="px-4 py-2 text-right font-bold text-slate-700">
                                            <?= number_format($loc['users']) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Acquisition Sources (Full Width) -->
            <?php if (!empty($gaChannels)): ?>
            <div class="mt-8 pt-6 border-t border-slate-100">
                <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-orange-600"></i>
                    Nguồn truy cập (Acquisition)
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach ($gaChannels as $channel): ?>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200 text-center">
                        <div class="text-xs text-slate-500 uppercase mb-1"><?= htmlspecialchars($channel['channel']) ?></div>
                        <div class="text-lg font-bold text-slate-800"><?= number_format($channel['users']) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Main Chart
                const ctx = document.getElementById('gaChart');
                if (ctx) {
                    const gaData = <?= json_encode($gaData) ?>;
                    
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: gaData.map(row => {
                                const d = row.date;
                                return d.substring(6,8) + '/' + d.substring(4,6);
                            }),
                            datasets: [
                                {
                                    label: 'Users',
                                    data: gaData.map(row => row.users),
                                    borderColor: '#2563eb',
                                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                                    fill: true,
                                    tension: 0.4
                                },
                                {
                                    label: 'Views',
                                    data: gaData.map(row => row.views),
                                    borderColor: '#ea580c',
                                    backgroundColor: 'rgba(234, 88, 12, 0.1)',
                                    fill: true,
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'top' } },
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                }

                // Device Chart (Pie)
                const ctxDevice = document.getElementById('deviceChart');
                if (ctxDevice) {
                    const deviceData = <?= json_encode($gaDevices ?? []) ?>;
                    if (deviceData.length > 0) {
                        new Chart(ctxDevice, {
                            type: 'doughnut',
                            data: {
                                labels: deviceData.map(d => d.device),
                                datasets: [{
                                    data: deviceData.map(d => d.users),
                                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { position: 'bottom' } }
                            }
                        });
                    }
                }
            });
        </script>
    <?php else: ?>
        <!-- GA4 Not Connected State -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="bar-chart-2" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Chưa kết nối Google Analytics 4</h3>
            <p class="text-slate-500 max-w-md mx-auto mb-6">
                Vui lòng cấu hình <strong>GA4 Property ID</strong> và <strong>Service Account Credentials</strong> để xem báo cáo thống kê truy cập.
            </p>
            <button onclick="document.getElementById('config-modal').classList.remove('hidden')" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 font-medium transition">
                <i data-lucide="settings" class="w-5 h-5"></i> Cấu hình ngay
            </button>
        </div>
    <?php endif; ?>

</main>

<script>
    lucide.createIcons();
</script>
