# MoiPayWay PHP SDK

Official PHP SDK for the [MoiPayWay API](https://documenter.getpostman.com/view/11919136/2s93Joz7Bq).

Use this client to call every endpoint in that collection: wallets, collections, transfers, users, verification, cards, catalogs, omnichain, and the rest of the documented surface.

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

## API docs

Paths, methods, and request bodies are in the public collection:

[MoiPayWay API (Postman)](https://documenter.getpostman.com/view/11919136/2s93Joz7Bq)

Call any of those endpoints with `request()`:

```php
$mpw->request('POST', 'wallet/details', ['wallet_id' => '...']);
$mpw->request('GET', 'user/misc/countries', [], false);
```

- `test` → `https://dev.moipayway.co`
- `live` → `https://api.moipayway.co`
- Auth: `Authorization: Bearer <api_key>` (pass `auth: false` for documented catalog GETs)

## Webhooks

```php
$ok = Client::verifyWebhook(
    $rawBody,
    $_SERVER['HTTP_X_MPW_WEBHOOK_SIGNATURE'] ?? '',
    $_SERVER['HTTP_X_MPW_WEBHOOK_TIMESTAMP'] ?? '',
    getenv('MOIPAYWAY_API_KEY')
);
```
