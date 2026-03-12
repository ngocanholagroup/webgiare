<?php
// src/models/GoogleAnalyticsService.php

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Google\Analytics\Data\V1beta\RunReportRequest;

class GoogleAnalyticsService {
    private $propertyId;
    private $credentialsPath;
    private $client;

    public function __construct($propertyId, $credentialsPath) {
        $this->propertyId = $propertyId;
        $this->credentialsPath = $credentialsPath;

        // Chỉ khởi tạo client nếu thư viện đã được cài và class tồn tại
        if (class_exists(BetaAnalyticsDataClient::class)) {
            try {
                $this->client = new BetaAnalyticsDataClient([
                    'credentials' => $this->credentialsPath
                ]);
            } catch (Exception $e) {
                // Xử lý lỗi khởi tạo (ví dụ: file credentials không tồn tại)
                $this->client = null;
            }
        }
    }

    public function isAvailable() {
        return $this->client !== null;
    }

    /**
     * Lấy báo cáo cơ bản: Users, Views, Engagement theo ngày
     */
    public function getBasicReport($startDate = '7daysAgo', $endDate = 'today') {
        if (!$this->isAvailable()) return ['error' => 'Library not installed or Credentials missing'];

        try {
            // 1. Cấu hình request
            $request = (new RunReportRequest())
                ->setProperty('properties/' . $this->propertyId)
                ->setDateRanges([
                    new DateRange(['start_date' => $startDate, 'end_date' => $endDate]),
                ])
                ->setDimensions([
                    new Dimension(['name' => 'date']), // Nhóm theo ngày
                ])
                ->setMetrics([
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'averageSessionDuration']),
                    new Metric(['name' => 'eventCount']), // Tổng số click/sự kiện
                ]);

            // 2. Gọi API
            $response = $this->client->runReport($request);

            // 3. Parse kết quả
            $data = [];
            foreach ($response->getRows() as $row) {
                $data[] = [
                    'date' => $row->getDimensionValues()[0]->getValue(), // YYYYMMDD
                    'users' => $row->getMetricValues()[0]->getValue(),
                    'views' => $row->getMetricValues()[1]->getValue(),
                    'avg_duration' => $row->getMetricValues()[2]->getValue(),
                    'events' => $row->getMetricValues()[3]->getValue(),
                ];
            }
            return $data;

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getTopPages($startDate = '7daysAgo', $endDate = 'today', $limit = 10) {
        if (!$this->isAvailable()) return [];

        try {
            // 1. Cấu hình request
            $request = (new RunReportRequest())
                ->setProperty('properties/' . $this->propertyId)
                ->setDateRanges([
                    new DateRange(['start_date' => $startDate, 'end_date' => $endDate]),
                ])
                ->setDimensions([
                    new Dimension(['name' => 'pageTitle']),
                    new Dimension(['name' => 'fullPageUrl']),
                ])
                ->setMetrics([
                    new Metric(['name' => 'screenPageViews']),
                ])
                ->setOrderBys([
                    new OrderBy([
                        'metric' => new MetricOrderBy(['metric_name' => 'screenPageViews']),
                        'desc' => true
                    ])
                ])
                ->setLimit($limit);

            // 2. Gọi API
            $response = $this->client->runReport($request);

            // 3. Parse kết quả
            $data = [];
            foreach ($response->getRows() as $row) {
                $data[] = [
                    'title' => $row->getDimensionValues()[0]->getValue(),
                    'url' => $row->getDimensionValues()[1]->getValue(),
                    'views' => $row->getMetricValues()[0]->getValue(),
                ];
            }
            return $data;

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Lấy báo cáo thiết bị truy cập (Desktop, Mobile, Tablet)
     */
    public function getDeviceReport($startDate = '7daysAgo', $endDate = 'today') {
        if (!$this->isAvailable()) return [];

        try {
            $request = (new RunReportRequest())
                ->setProperty('properties/' . $this->propertyId)
                ->setDateRanges([new DateRange(['start_date' => $startDate, 'end_date' => $endDate])])
                ->setDimensions([new Dimension(['name' => 'deviceCategory'])])
                ->setMetrics([new Metric(['name' => 'activeUsers'])]);

            $response = $this->client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $data[] = [
                    'device' => ucfirst($row->getDimensionValues()[0]->getValue()),
                    'users' => $row->getMetricValues()[0]->getValue(),
                ];
            }
            return $data;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Lấy báo cáo nguồn truy cập (Organic, Direct, Referral...)
     */
    public function getAcquisitionReport($startDate = '7daysAgo', $endDate = 'today') {
        if (!$this->isAvailable()) return [];

        try {
            $request = (new RunReportRequest())
                ->setProperty('properties/' . $this->propertyId)
                ->setDateRanges([new DateRange(['start_date' => $startDate, 'end_date' => $endDate])])
                ->setDimensions([new Dimension(['name' => 'sessionDefaultChannelGroup'])])
                ->setMetrics([new Metric(['name' => 'activeUsers'])])
                ->setOrderBys([
                    new OrderBy([
                        'metric' => new MetricOrderBy(['metric_name' => 'activeUsers']),
                        'desc' => true
                    ])
                ]);

            $response = $this->client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $data[] = [
                    'channel' => $row->getDimensionValues()[0]->getValue(),
                    'users' => $row->getMetricValues()[0]->getValue(),
                ];
            }
            return $data;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Lấy báo cáo địa lý (Quốc gia/Thành phố)
     */
    public function getLocationReport($startDate = '7daysAgo', $endDate = 'today', $limit = 5) {
        if (!$this->isAvailable()) return [];

        try {
            $request = (new RunReportRequest())
                ->setProperty('properties/' . $this->propertyId)
                ->setDateRanges([new DateRange(['start_date' => $startDate, 'end_date' => $endDate])])
                ->setDimensions([new Dimension(['name' => 'city']), new Dimension(['name' => 'country'])])
                ->setMetrics([new Metric(['name' => 'activeUsers'])])
                ->setOrderBys([
                    new OrderBy([
                        'metric' => new MetricOrderBy(['metric_name' => 'activeUsers']),
                        'desc' => true
                    ])
                ])
                ->setLimit($limit);

            $response = $this->client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $city = $row->getDimensionValues()[0]->getValue();
                // Nếu city là (not set) thì lấy country
                if ($city == '(not set)' || empty($city)) {
                    $city = $row->getDimensionValues()[1]->getValue(); // Country name
                }
                
                $data[] = [
                    'location' => $city,
                    'country' => $row->getDimensionValues()[1]->getValue(),
                    'users' => $row->getMetricValues()[0]->getValue(),
                ];
            }
            return $data;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
