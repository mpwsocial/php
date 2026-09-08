<?php

namespace MoiPayWay;

class Webhooks
{
    /**
     * Verify an inbound MoiPayWay webhook.
     * Signed as HMAC-SHA256 of "{timestamp}.{rawBody}" with the merchant API key.
     * Header: X-MPW-Webhook-Signature: sha256=<hex>
     */
    public static function verify(
        string $rawBody,
        string $signatureHeader,
        string $timestampHeader,
        string $apiKey,
        int $toleranceSeconds = 300
    ): bool {
        if ($rawBody === '' || $signatureHeader === '' || $timestampHeader === '' || $apiKey === '') {
            return false;
        }

        if (!ctype_digit($timestampHeader)) {
            return false;
        }

        $age = abs(time() - (int)$timestampHeader);
        if ($toleranceSeconds > 0 && $age > $toleranceSeconds) {
            return false;
        }

        $provided = $signatureHeader;
        if (stripos($provided, 'sha256=') === 0) {
            $provided = substr($provided, 7);
        }

        $expected = hash_hmac('sha256', $timestampHeader . '.' . $rawBody, $apiKey);
        return hash_equals($expected, $provided);
    }
}
