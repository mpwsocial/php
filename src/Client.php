<?php

namespace MoiPayWay;

class Client
{
    public const TEST_BASE = 'https://dev.moipayway.co';
    public const LIVE_BASE = 'https://api.moipayway.co';

    public function __construct(
        private string $apiKey,
        private string $environment = 'test',
        private int $timeoutSeconds = 30
    ) {
        $environment = strtolower($environment);
        if ($environment !== 'test' && $environment !== 'live') {
            throw new \InvalidArgumentException('environment must be test or live');
        }
        $this->environment = $environment;
        $this->apiKey = trim($apiKey);
        if ($this->apiKey === '') {
            throw new \InvalidArgumentException('apiKey is required');
        }
    }

    public function baseUrl(): string
    {
        return $this->environment === 'live' ? self::LIVE_BASE : self::TEST_BASE;
    }

    /**
     * Call any endpoint from the MoiPayWay API docs.
     * Pass $auth = false for documented catalog GETs such as /user/misc/countries.
     */
    public function request(string $method, string $path, array $body = [], bool $auth = true): array
    {
        $method = strtoupper($method);
        $url = rtrim($this->baseUrl(), '/') . '/' . ltrim($path, '/');

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];
        if ($auth) {
            $headers[] = 'Authorization: Bearer ' . $this->apiKey;
        }

        $ch = curl_init($url);
        $opts = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => $this->timeoutSeconds,
            CURLOPT_CONNECTTIMEOUT => 10,
        ];
        if ($method !== 'GET' && $method !== 'HEAD') {
            $opts[CURLOPT_POSTFIELDS] = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } elseif ($method === 'GET' && $body !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($body);
            curl_setopt($ch, CURLOPT_URL, $url);
        }
        curl_setopt_array($ch, $opts);

        $raw = curl_exec($ch);
        $errno = curl_errno($ch);
        $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($errno) {
            throw new ApiException('Unable to reach MoiPayWay', $http);
        }

        $decoded = json_decode((string)$raw, true);
        if (!is_array($decoded)) {
            throw new ApiException('Invalid JSON response', $http);
        }

        $status = strtolower((string)($decoded['status'] ?? ''));
        if ($status === 'failed' || $status === 'error') {
            throw new ApiException((string)($decoded['message'] ?? 'Request failed'), $http, $decoded);
        }

        return $decoded;
    }

    public function post(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body, true);
    }

    public function get(string $path, bool $auth = true): array
    {
        return $this->request('GET', $path, [], $auth);
    }

    public function createWallet(array $body): array
    {
        return $this->post('wallet/create', $body);
    }

    public function walletDetails(array $body): array
    {
        return $this->post('wallet/details', $body);
    }

    public function walletTransactions(array $body): array
    {
        return $this->post('wallet/transactions', $body);
    }

    public function initiateCollection(array $body): array
    {
        return $this->post('wallet/collection/initiate', $body);
    }

    public function collectionInfo(string $orderReferenceCode): array
    {
        return $this->post('wallet/collection/info', [
            'order_reference_code' => $orderReferenceCode,
        ]);
    }

    public function createCollectionMethod(array $body): array
    {
        return $this->post('wallet/collection/method/create', $body);
    }

    public function directTransfer(array $body): array
    {
        return $this->post('wallet/transfer/direct/single', $body);
    }

    public function createIndividual(array $body): array
    {
        return $this->post('user/account/individual/create', $body);
    }

    public function individualDetails(array $body): array
    {
        return $this->post('user/account/individual/details', $body);
    }

    public function createBusiness(array $body): array
    {
        return $this->post('user/account/business/create', $body);
    }

    public function countries(): array
    {
        return $this->get('user/misc/countries', false);
    }

    public function jobTypes(): array
    {
        return $this->get('user/misc/job-types', false);
    }

    public function businessIndustries(): array
    {
        return $this->get('user/misc/business-industry-list', false);
    }

    public function businessRegistrationTypes(): array
    {
        return $this->get('user/misc/business-registration-type', false);
    }

    public function businessTradeTypes(): array
    {
        return $this->get('user/misc/business-trade-type', false);
    }

    public function businessProductServiceTypes(): array
    {
        return $this->get('user/misc/business-product-service-type', false);
    }

    public function sourceOfFundsTypes(): array
    {
        return $this->get('user/misc/source-of-funds-type', false);
    }

    public static function verifyWebhook(
        string $rawBody,
        string $signatureHeader,
        string $timestampHeader,
        string $apiKey,
        int $toleranceSeconds = 300
    ): bool {
        return Webhooks::verify($rawBody, $signatureHeader, $timestampHeader, $apiKey, $toleranceSeconds);
    }
}
