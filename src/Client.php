<?php

namespace MoiPayWay;

class Client
{
    public const TEST_BASE = 'https://dev.moipayway.co';
    public const LIVE_BASE = 'https://api.moipayway.co';

    public Account $account;
    public Authentication $authentication;
    public Card $card;
    public Misc $misc;
    public Omnichain $omnichain;
    public Simulation $simulation;
    public User $user;
    public Verification $verification;
    public Wallet $wallet;

    public function __construct(
        private string $apiKey = '',
        private string $environment = 'test',
        private int $timeoutSeconds = 30
    ) {
        $environment = strtolower($environment);
        if ($environment !== 'test' && $environment !== 'live') {
            throw new \InvalidArgumentException('environment must be test or live');
        }
        $this->environment = $environment;
        $this->apiKey = trim($apiKey);

        $this->account = new Account($this);
        $this->authentication = new Authentication($this);
        $this->card = new Card($this);
        $this->misc = new Misc($this);
        $this->omnichain = new Omnichain($this);
        $this->simulation = new Simulation($this);
        $this->user = new User($this);
        $this->verification = new Verification($this);
        $this->wallet = new Wallet($this);
    }

    public function baseUrl(): string
    {
        return $this->environment === 'live' ? self::LIVE_BASE : self::TEST_BASE;
    }

    public function request(string $method, string $path, array $body = [], bool $auth = true): array
    {
        $method = strtoupper($method);
        $url = rtrim($this->baseUrl(), '/') . '/' . ltrim($path, '/');

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];
        if ($auth) {
            if ($this->apiKey === '') {
                throw new \InvalidArgumentException('apiKey is required');
            }
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
