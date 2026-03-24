<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/services/MediaService.php';
require_once __DIR__ . '/services/MinioClient.php';

$file = [
    'name' => 'test_favicon.ico',
    'type' => 'image/vnd.microsoft.icon',
    'tmp_name' => '/tmp/test_favicon.ico',
    'error' => 0,
    'size' => 100
];

$icoData = base64_decode('AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA////A');
file_put_contents('/tmp/test_favicon.ico', $icoData);

// Temporary add error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

$result = MediaService::upload($file, 'setting');
print_r($result);
