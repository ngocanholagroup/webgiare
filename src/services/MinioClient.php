<?php

class MinioClient {
    private $endpoint;
    private $accessKey;
    private $secretKey;
    private $region;

    public function __construct($endpoint, $accessKey, $secretKey, $region = 'us-east-1') {
        $this->endpoint = rtrim($endpoint, '/');
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->region = $region;
    }

    private function signRequest($method, $bucket, $object, $payload = '', $contentType = 'application/octet-stream') {
        $uri = '/' . $bucket . '/' . ltrim($object, '/');
        $host = parse_url($this->endpoint, PHP_URL_HOST);
        $port = parse_url($this->endpoint, PHP_URL_PORT);
        if ($port) {
            $host .= ':' . $port;
        }

        $date = gmdate('Ymd');
        $amzDate = gmdate('Ymd\THis\Z');
        
        $payloadHash = hash('sha256', $payload);

        $headers = [
            'host' => $host,
            'x-amz-content-sha256' => $payloadHash,
            'x-amz-date' => $amzDate
        ];

        if ($method === 'PUT') {
            $headers['content-type'] = $contentType;
        }

        ksort($headers);

        $canonicalHeaders = '';
        $signedHeaders = '';
        foreach ($headers as $key => $value) {
            $canonicalHeaders .= $key . ':' . trim($value) . "\n";
            $signedHeaders .= $key . ';';
        }
        $signedHeaders = rtrim($signedHeaders, ';');

        $canonicalRequest = $method . "\n"
            . $uri . "\n"
            . "\n"
            . $canonicalHeaders . "\n"
            . $signedHeaders . "\n"
            . $payloadHash;

        $algorithm = 'AWS4-HMAC-SHA256';
        $credentialScope = $date . '/' . $this->region . '/s3/aws4_request';
        $stringToSign = $algorithm . "\n"
            . $amzDate . "\n"
            . $credentialScope . "\n"
            . hash('sha256', $canonicalRequest);

        $kSecret = 'AWS4' . $this->secretKey;
        $kDate = hash_hmac('sha256', $date, $kSecret, true);
        $kRegion = hash_hmac('sha256', $this->region, $kDate, true);
        $kService = hash_hmac('sha256', 's3', $kRegion, true);
        $kSigning = hash_hmac('sha256', 'aws4_request', $kService, true);
        $signature = hash_hmac('sha256', $stringToSign, $kSigning);

        $authorizationHeader = $algorithm . ' '
            . 'Credential=' . $this->accessKey . '/' . $credentialScope . ', '
            . 'SignedHeaders=' . $signedHeaders . ', '
            . 'Signature=' . $signature;

        $httpHeaders = [];
        foreach ($headers as $key => $value) {
            $httpHeaders[] = $key . ': ' . $value;
        }
        $httpHeaders[] = 'Authorization: ' . $authorizationHeader;

        return $httpHeaders;
    }

    public function putObject($bucket, $object, $payload, $contentType = 'application/octet-stream') {
        $headers = $this->signRequest('PUT', $bucket, $object, $payload, $contentType);
        $url = $this->endpoint . '/' . $bucket . '/' . ltrim($object, '/');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 200;
    }

    public function deleteObject($bucket, $object) {
        $headers = $this->signRequest('DELETE', $bucket, $object);
        $url = $this->endpoint . '/' . $bucket . '/' . ltrim($object, '/');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 204 || $httpCode === 200;
    }
}
