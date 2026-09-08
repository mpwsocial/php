# MoiPayWay PHP SDK

```bash
composer require mpwsocial/php
```

```php
use MoiPayWay\Client;

$mpw = new Client(getenv('MOIPAYWAY_API_KEY'), 'test');

$wallet = $mpw->wallet->create([
    'code' => 'NGN',
    'meta' => [
        'name' => 'Operations',
        'user_id' => 'user-uuid',
    ],
]);

$order = $mpw->wallet->collection->initiate([
    'order_reference_code' => 'ORD-1001',
    'meta' => [
        'amount' => '5000',
        'narration' => 'Invoice 1001',
        'wallet_id' => 'wallet-uuid',
        'user_id' => 'user-uuid',
    ],
]);

$individual = $mpw->user->account->individual->create([/* ... */]);
$jobTypes = $mpw->user->misc->jobTypes();
$lookup = $mpw->verification->lookup(['code' => 'cac' /* ... */]);
```

Collection paths are methods on the client:

- `POST wallet/create` → `$mpw->wallet->create($body)`
- `POST wallet/collection/initiate` → `$mpw->wallet->collection->initiate($body)`
- `POST user/account/individual/create` → `$mpw->user->account->individual->create($body)`
- `GET user/misc/job-types` → `$mpw->user->misc->jobTypes()`
- `POST verification/lookup` → `$mpw->verification->lookup($body)`
- `POST omnichain/wallet/evm/eoa/create-wallet` → `$mpw->omnichain->wallet->evm->eoa->createWallet($body)`

`test` uses `https://dev.moipayway.co`. `live` uses `https://api.moipayway.co`.

```php
$ok = Client::verifyWebhook(
    $rawBody,
    $_SERVER['HTTP_X_MPW_WEBHOOK_SIGNATURE'] ?? '',
    $_SERVER['HTTP_X_MPW_WEBHOOK_TIMESTAMP'] ?? '',
    getenv('MOIPAYWAY_API_KEY')
);
```
