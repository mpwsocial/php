# MoiPayWay PHP SDK

Official PHP client for MoiPayWay merchant REST APIs.

```bash
composer require moipayway/php
```

```php
use MoiPayWay\Client;

$mpw = new Client(getenv('MOIPAYWAY_API_KEY'), 'test');

$countries = $mpw->countries();
$wallet = $mpw->createWallet([
    'code' => 'NGN',
    'meta' => [
        'name' => 'Operations',
        'user_id' => 'user-uuid',
    ],
]);

$order = $mpw->initiateCollection([
    'order_reference_code' => 'ORD-' . time(),
    'meta' => [
        'amount' => '5000',
        'narration' => 'Invoice 1001',
        'wallet_id' => 'wallet-uuid',
        'user_id' => 'user-uuid',
    ],
]);
```

Any documented path:

```php
$mpw->request('POST', 'wallet/details', ['wallet_id' => '...']);
```

Webhook verification:

```php
$ok = Client::verifyWebhook(
    $rawBody,
    $_SERVER['HTTP_X_MPW_WEBHOOK_SIGNATURE'] ?? '',
    $_SERVER['HTTP_X_MPW_WEBHOOK_TIMESTAMP'] ?? '',
    getenv('MOIPAYWAY_API_KEY')
);
```

Environment: `test` → `https://dev.moipayway.co`, `live` → `https://api.moipayway.co`.

Do not put API keys in source control. This package does not wrap cron, system, partner, or share-link internals.
