<?php

namespace MoiPayWay;

class Account
{
    public AccountMerchant $merchant;

    public function __construct(private Client $client)
    {
        $this->merchant = new AccountMerchant($client);
    }

}

class AccountMerchant
{
    public AccountMerchantProduct $product;
    public AccountMerchantTeam $team;

    public function __construct(private Client $client)
    {
        $this->product = new AccountMerchantProduct($client);
        $this->team = new AccountMerchantTeam($client);
    }

    public function resendWebhook(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/resend-webhook', $body, true);
    }

    public function updateNotification(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/update-notification', $body, true);
    }
}

class AccountMerchantProduct
{
    public AccountMerchantProductSubscription $subscription;

    public function __construct(private Client $client)
    {
        $this->subscription = new AccountMerchantProductSubscription($client);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/update', $body, true);
    }

    public function view(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/view', $body, true);
    }
}

class AccountMerchantProductSubscription
{
    public function __construct(private Client $client)
    {
    }

    public function class_(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/subscription/class', $body, true);
    }

    public function classProductType(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/subscription/class-product-type', $body, true);
    }

    public function finalise(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/subscription/finalise', $body, true);
    }

    public function history(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/subscription/history', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/product/subscription/initiate', $body, true);
    }
}

class AccountMerchantTeam
{
    public AccountMerchantTeamPermission $permission;

    public function __construct(private Client $client)
    {
        $this->permission = new AccountMerchantTeamPermission($client);
    }

    public function add(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/add', $body, true);
    }

    public function logs(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/logs', $body, true);
    }

    public function remove(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/remove', $body, true);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/update', $body, true);
    }

    public function view(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/view', $body, true);
    }
}

class AccountMerchantTeamPermission
{
    public function __construct(private Client $client)
    {
    }

    public function add(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/permission/add', $body, true);
    }

    public function remove(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/permission/remove', $body, true);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/permission/update', $body, true);
    }

    public function view(array $body = []): array
    {
        return $this->client->request('POST', 'account/merchant/team/permission/view', $body, true);
    }
}

class Authentication
{
    public function __construct(private Client $client)
    {
    }

    public function connect(array $body = []): array
    {
        return $this->client->request('POST', 'authentication/connect', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'authentication/initiate', $body, false);
    }

    public function signOut(array $body = []): array
    {
        return $this->client->request('POST', 'authentication/sign-out', $body, true);
    }

    public function validate(array $body = []): array
    {
        return $this->client->request('POST', 'authentication/validate', $body, true);
    }
}

class Card
{
    public function __construct(private Client $client)
    {
    }

    public function close(array $body = []): array
    {
        return $this->client->request('POST', 'card/close', $body, true);
    }

    public function create(array $body = []): array
    {
        return $this->client->request('POST', 'card/create', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'card/details', $body, true);
    }

    public function freeze(array $body = []): array
    {
        return $this->client->request('POST', 'card/freeze', $body, true);
    }

    public function fund(array $body = []): array
    {
        return $this->client->request('POST', 'card/fund', $body, true);
    }

    public function resubscribe(array $body = []): array
    {
        return $this->client->request('POST', 'card/resubscribe', $body, true);
    }

    public function supported(array $body = []): array
    {
        return $this->client->request('POST', 'card/supported', $body, true);
    }

    public function unfreeze(array $body = []): array
    {
        return $this->client->request('POST', 'card/unfreeze', $body, true);
    }

    public function updateSecuritySettings(array $body = []): array
    {
        return $this->client->request('POST', 'card/update-security-settings', $body, true);
    }

    public function withdraw(array $body = []): array
    {
        return $this->client->request('POST', 'card/withdraw', $body, true);
    }
}

class Misc
{
    public function __construct(private Client $client)
    {
    }

    public function actions(array $body = []): array
    {
        return $this->client->request('POST', 'actions', $body, true);
    }

    public function codes(array $body = []): array
    {
        return $this->client->request('POST', 'codes', $body, true);
    }

    public function countries(array $body = []): array
    {
        return $this->client->request('POST', 'countries', $body, true);
    }

    public function fileUpload(array $body = []): array
    {
        return $this->client->request('POST', 'file-upload', $body, true);
    }

    public function paymentPurpose(array $body = []): array
    {
        return $this->client->request('POST', 'payment-purpose', $body, true);
    }

    public function products(array $body = []): array
    {
        return $this->client->request('POST', 'products', $body, true);
    }

    public function stateProvinceRegion(array $body = []): array
    {
        return $this->client->request('POST', 'state-province-region', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'supported-currencies', $body, true);
    }
}

class Omnichain
{
    public OmnichainStorage $storage;
    public OmnichainTokenization $tokenization;
    public OmnichainWallet $wallet;

    public function __construct(private Client $client)
    {
        $this->storage = new OmnichainStorage($client);
        $this->tokenization = new OmnichainTokenization($client);
        $this->wallet = new OmnichainWallet($client);
    }

}

class OmnichainStorage
{
    public function __construct(private Client $client)
    {
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/storage/details', $body, true);
    }

    public function upload(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/storage/upload', $body, true);
    }
}

class OmnichainTokenization
{
    public OmnichainTokenizationErc1155 $erc1155;
    public OmnichainTokenizationErc20 $erc20;
    public OmnichainTokenizationErc721 $erc721;
    public OmnichainTokenizationSep41 $sep41;

    public function __construct(private Client $client)
    {
        $this->erc1155 = new OmnichainTokenizationErc1155($client);
        $this->erc20 = new OmnichainTokenizationErc20($client);
        $this->erc721 = new OmnichainTokenizationErc721($client);
        $this->sep41 = new OmnichainTokenizationSep41($client);
    }

}

class OmnichainTokenizationErc1155
{
    public function __construct(private Client $client)
    {
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/balance', $body, true);
    }

    public function burn(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/burn', $body, true);
    }

    public function deploy(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/deploy', $body, true);
    }

    public function mint(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/mint', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/transactions', $body, true);
    }

    public function transfer(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc1155/transfer', $body, true);
    }
}

class OmnichainTokenizationErc20
{
    public function __construct(private Client $client)
    {
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/balance', $body, true);
    }

    public function burn(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/burn', $body, true);
    }

    public function chains(array $body = []): array
    {
        return $this->client->request('GET', 'omnichain/tokenization/erc20/chains', $body, true);
    }

    public function deploy(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/deploy', $body, true);
    }

    public function mint(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/mint', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/transactions', $body, true);
    }

    public function transfer(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc20/transfer', $body, true);
    }
}

class OmnichainTokenizationErc721
{
    public function __construct(private Client $client)
    {
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/balance', $body, true);
    }

    public function burn(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/burn', $body, true);
    }

    public function deploy(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/deploy', $body, true);
    }

    public function mint(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/mint', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/transactions', $body, true);
    }

    public function transfer(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/erc721/transfer', $body, true);
    }
}

class OmnichainTokenizationSep41
{
    public function __construct(private Client $client)
    {
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/balance', $body, true);
    }

    public function burn(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/burn', $body, true);
    }

    public function deploy(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/deploy', $body, true);
    }

    public function mint(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/mint', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/transactions', $body, true);
    }

    public function transfer(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/tokenization/sep41/transfer', $body, true);
    }
}

class OmnichainWallet
{
    public OmnichainWalletEvm $evm;
    public OmnichainWalletStellar $stellar;

    public function __construct(private Client $client)
    {
        $this->evm = new OmnichainWalletEvm($client);
        $this->stellar = new OmnichainWalletStellar($client);
    }

}

class OmnichainWalletEvm
{
    public OmnichainWalletEvmEoa $eoa;

    public function __construct(private Client $client)
    {
        $this->eoa = new OmnichainWalletEvmEoa($client);
    }

}

class OmnichainWalletEvmEoa
{
    public OmnichainWalletEvmEoaOperations $operations;
    public OmnichainWalletEvmEoaTransfer $transfer;

    public function __construct(private Client $client)
    {
        $this->operations = new OmnichainWalletEvmEoaOperations($client);
        $this->transfer = new OmnichainWalletEvmEoaTransfer($client);
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/balance', $body, true);
    }

    public function chains(array $body = []): array
    {
        return $this->client->request('GET', 'omnichain/wallet/evm/eoa/chains', $body, true);
    }

    public function createWallet(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/create-wallet', $body, true);
    }

    public function generateAddress(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/generate-address', $body, true);
    }

    public function supportedStablecoin(array $body = []): array
    {
        return $this->client->request('GET', 'omnichain/wallet/evm/eoa/supported-stablecoin', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/transactions', $body, true);
    }
}

class OmnichainWalletEvmEoaOperations
{
    public function __construct(private Client $client)
    {
    }

    public function broadcastTransaction(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/operations/broadcast-transaction', $body, true);
    }

    public function estimateGas(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/operations/estimate-gas', $body, true);
    }

    public function signTransaction(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/operations/sign-transaction', $body, true);
    }
}

class OmnichainWalletEvmEoaTransfer
{
    public function __construct(private Client $client)
    {
    }

    public function nativeToken(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/transfer/native-token', $body, true);
    }

    public function stablecoin(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/evm/eoa/transfer/stablecoin', $body, true);
    }
}

class OmnichainWalletStellar
{
    public OmnichainWalletStellarEoa $eoa;

    public function __construct(private Client $client)
    {
        $this->eoa = new OmnichainWalletStellarEoa($client);
    }

}

class OmnichainWalletStellarEoa
{
    public OmnichainWalletStellarEoaOperations $operations;
    public OmnichainWalletStellarEoaTransfer $transfer;

    public function __construct(private Client $client)
    {
        $this->operations = new OmnichainWalletStellarEoaOperations($client);
        $this->transfer = new OmnichainWalletStellarEoaTransfer($client);
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/balance', $body, true);
    }

    public function createWallet(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/create-wallet', $body, true);
    }

    public function generateAddress(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/generate-address', $body, true);
    }

    public function supportedStablecoin(array $body = []): array
    {
        return $this->client->request('GET', 'omnichain/wallet/stellar/eoa/supported-stablecoin', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/transactions', $body, true);
    }
}

class OmnichainWalletStellarEoaOperations
{
    public function __construct(private Client $client)
    {
    }

    public function createTrustline(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/operations/create-trustline', $body, true);
    }

    public function estimateGas(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/operations/estimate-gas', $body, true);
    }
}

class OmnichainWalletStellarEoaTransfer
{
    public function __construct(private Client $client)
    {
    }

    public function nativeToken(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/transfer/native-token', $body, true);
    }

    public function stablecoin(array $body = []): array
    {
        return $this->client->request('POST', 'omnichain/wallet/stellar/eoa/transfer/stablecoin', $body, true);
    }
}

class Simulation
{
    public SimulationCard $card;
    public SimulationCollection $collection;
    public SimulationDirectDebit $directDebit;
    public SimulationTransfer $transfer;

    public function __construct(private Client $client)
    {
        $this->card = new SimulationCard($client);
        $this->collection = new SimulationCollection($client);
        $this->directDebit = new SimulationDirectDebit($client);
        $this->transfer = new SimulationTransfer($client);
    }

}

class SimulationCard
{
    public function __construct(private Client $client)
    {
    }

    public function spend(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/card/spend', $body, true);
    }
}

class SimulationCollection
{
    public function __construct(private Client $client)
    {
    }

    public function initiatedOrder(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/collection/initiated-order', $body, true);
    }

    public function staticVirtualAccount(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/collection/static-virtual-account', $body, true);
    }

    public function staticWalletAddress(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/collection/static-wallet-address', $body, true);
    }
}

class SimulationDirectDebit
{
    public function __construct(private Client $client)
    {
    }

    public function status(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/direct-debit/status', $body, true);
    }
}

class SimulationTransfer
{
    public function __construct(private Client $client)
    {
    }

    public function initiatedOrder(array $body = []): array
    {
        return $this->client->request('POST', 'simulation/transfer/initiated-order', $body, true);
    }
}

class User
{
    public UserAccount $account;
    public UserMisc $misc;
    public UserSubscription $subscription;
    public UserVerification $verification;

    public function __construct(private Client $client)
    {
        $this->account = new UserAccount($client);
        $this->misc = new UserMisc($client);
        $this->subscription = new UserSubscription($client);
        $this->verification = new UserVerification($client);
    }

}

class UserAccount
{
    public UserAccountBusiness $business;
    public UserAccountIndividual $individual;

    public function __construct(private Client $client)
    {
        $this->business = new UserAccountBusiness($client);
        $this->individual = new UserAccountIndividual($client);
    }

}

class UserAccountBusiness
{
    public function __construct(private Client $client)
    {
    }

    public function create(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/business/create', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/business/details', $body, true);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/business/update', $body, true);
    }
}

class UserAccountIndividual
{
    public function __construct(private Client $client)
    {
    }

    public function create(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/individual/create', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/individual/details', $body, true);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'user/account/individual/update', $body, true);
    }
}

class UserMisc
{
    public function __construct(private Client $client)
    {
    }

    public function businessIndustryList(array $body = []): array
    {
        return $this->client->request('POST', 'user/misc/business-industry-list', $body, true);
    }

    public function businessProductServiceType(array $body = []): array
    {
        return $this->client->request('GET', 'user/misc/business-product-service-type', $body, false);
    }

    public function businessRegistrationType(array $body = []): array
    {
        return $this->client->request('POST', 'user/misc/business-registration-type', $body, true);
    }

    public function businessTradeType(array $body = []): array
    {
        return $this->client->request('POST', 'user/misc/business-trade-type', $body, true);
    }

    public function countries(array $body = []): array
    {
        return $this->client->request('POST', 'user/misc/countries', $body, true);
    }

    public function jobTypes(array $body = []): array
    {
        return $this->client->request('POST', 'user/misc/job-types', $body, true);
    }

    public function sourceOfFundsType(array $body = []): array
    {
        return $this->client->request('GET', 'user/misc/source-of-funds-type', $body, false);
    }
}

class UserSubscription
{
    public function __construct(private Client $client)
    {
    }

    public function class_(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/class', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/initiate', $body, true);
    }

    public function products(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/products', $body, true);
    }

    public function requery(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/requery', $body, true);
    }

    public function status(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/status', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'user/subscription/transactions', $body, true);
    }
}

class UserVerification
{
    public function __construct(private Client $client)
    {
    }

    public function bulkProcess(array $body = []): array
    {
        return $this->client->request('POST', 'user/verification/bulk-process', $body, true);
    }

    public function requirement(array $body = []): array
    {
        return $this->client->request('POST', 'user/verification/requirement', $body, true);
    }

    public function singleProcess(array $body = []): array
    {
        return $this->client->request('POST', 'user/verification/single-process', $body, true);
    }
}

class Verification
{
    public function __construct(private Client $client)
    {
    }

    public function lookup(array $body = []): array
    {
        return $this->client->request('POST', 'verification/lookup', $body, true);
    }
}

class Wallet
{
    public WalletChannel $channel;
    public WalletCollection $collection;
    public WalletExchange $exchange;
    public WalletMpwt $mpwt;
    public WalletTransfer $transfer;

    public function __construct(private Client $client)
    {
        $this->channel = new WalletChannel($client);
        $this->collection = new WalletCollection($client);
        $this->exchange = new WalletExchange($client);
        $this->mpwt = new WalletMpwt($client);
        $this->transfer = new WalletTransfer($client);
    }

    public function create(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/create', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/details', $body, true);
    }

    public function transactions(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transactions', $body, true);
    }

    public function update(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/update', $body, true);
    }
}

class WalletChannel
{
    public WalletChannelTransferRecipient $transferRecipient;
    public WalletChannelVirtualAccount $virtualAccount;
    public WalletChannelWalletAddress $walletAddress;

    public function __construct(private Client $client)
    {
        $this->transferRecipient = new WalletChannelTransferRecipient($client);
        $this->virtualAccount = new WalletChannelVirtualAccount($client);
        $this->walletAddress = new WalletChannelWalletAddress($client);
    }

}

class WalletChannelTransferRecipient
{
    public WalletChannelTransferRecipientBank $bank;
    public WalletChannelTransferRecipientMobileMoney $mobileMoney;
    public WalletChannelTransferRecipientWalletAddress $walletAddress;

    public function __construct(private Client $client)
    {
        $this->bank = new WalletChannelTransferRecipientBank($client);
        $this->mobileMoney = new WalletChannelTransferRecipientMobileMoney($client);
        $this->walletAddress = new WalletChannelTransferRecipientWalletAddress($client);
    }

}

class WalletChannelTransferRecipientBank
{
    public function __construct(private Client $client)
    {
    }

    public function add(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/add', $body, true);
    }

    public function countries(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/countries', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/details', $body, true);
    }

    public function institutions(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/institutions', $body, true);
    }

    public function requirements(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/requirements', $body, true);
    }

    public function resolve(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/resolve', $body, true);
    }

    public function sampleAccount(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/sample-account', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/supported-currencies', $body, true);
    }

    public function supportedRouteType(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/bank/supported-route-type', $body, true);
    }
}

class WalletChannelTransferRecipientMobileMoney
{
    public function __construct(private Client $client)
    {
    }

    public function add(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/add', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/details', $body, true);
    }

    public function sampleAccount(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/sample-account', $body, true);
    }

    public function supportedCountries(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/supported-countries', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/supported-currencies', $body, true);
    }

    public function supportedNetworks(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/mobile-money/supported-networks', $body, true);
    }
}

class WalletChannelTransferRecipientWalletAddress
{
    public function __construct(private Client $client)
    {
    }

    public function add(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/wallet-address/add', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/transfer-recipient/wallet-address/details', $body, true);
    }
}

class WalletChannelVirtualAccount
{
    public function __construct(private Client $client)
    {
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/virtual-account/details', $body, true);
    }

    public function generate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/virtual-account/generate', $body, true);
    }

    public function resubscribe(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/virtual-account/resubscribe', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/virtual-account/supported-currencies', $body, true);
    }

    public function supportedInstitutions(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/virtual-account/supported-institutions', $body, true);
    }
}

class WalletChannelWalletAddress
{
    public function __construct(private Client $client)
    {
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/wallet-address/details', $body, true);
    }

    public function generate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/wallet-address/generate', $body, true);
    }

    public function supportedTokens(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/channel/wallet-address/supported-tokens', $body, true);
    }
}

class WalletCollection
{
    public WalletCollectionMethod $method;

    public function __construct(private Client $client)
    {
        $this->method = new WalletCollectionMethod($client);
    }

    public function calculator(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/calculator', $body, true);
    }

    public function designOptions(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/design-options', $body, true);
    }

    public function info(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/info', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/initiate', $body, true);
    }

    public function supportedMethods(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/supported-methods', $body, true);
    }
}

class WalletCollectionMethod
{
    public function __construct(private Client $client)
    {
    }

    public function authorize3ds(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/authorize-3ds', $body, true);
    }

    public function authorizeOtp(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/authorize-otp', $body, true);
    }

    public function charge(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/charge', $body, true);
    }

    public function confirmation(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/confirmation', $body, true);
    }

    public function create(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/create', $body, true);
    }

    public function details(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/details', $body, true);
    }

    public function link(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/link', $body, true);
    }

    public function resendOtp(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/resend-otp', $body, true);
    }

    public function supportedCountries(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/supported-countries', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/supported-currencies', $body, true);
    }

    public function supportedInstitutions(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/supported-institutions', $body, true);
    }

    public function supportedNetworks(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/supported-networks', $body, true);
    }

    public function terminate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/collection/method/terminate', $body, true);
    }
}

class WalletExchange
{
    public WalletExchangeCryptotocrypto $cryptotocrypto;
    public WalletExchangeCryptotofiat $cryptotofiat;
    public WalletExchangeFiattocrypto $fiattocrypto;
    public WalletExchangeFiattofiat $fiattofiat;

    public function __construct(private Client $client)
    {
        $this->cryptotocrypto = new WalletExchangeCryptotocrypto($client);
        $this->cryptotofiat = new WalletExchangeCryptotofiat($client);
        $this->fiattocrypto = new WalletExchangeFiattocrypto($client);
        $this->fiattofiat = new WalletExchangeFiattofiat($client);
    }

}

class WalletExchangeCryptotocrypto
{
    public WalletExchangeCryptotocryptoExternal $external;

    public function __construct(private Client $client)
    {
        $this->external = new WalletExchangeCryptotocryptoExternal($client);
    }

}

class WalletExchangeCryptotocryptoExternal
{
    public WalletExchangeCryptotocryptoExternalBridge $bridge;
    public WalletExchangeCryptotocryptoExternalSwap $swap;

    public function __construct(private Client $client)
    {
        $this->bridge = new WalletExchangeCryptotocryptoExternalBridge($client);
        $this->swap = new WalletExchangeCryptotocryptoExternalSwap($client);
    }

}

class WalletExchangeCryptotocryptoExternalBridge
{
    public WalletExchangeCryptotocryptoExternalBridgeUsdc $usdc;

    public function __construct(private Client $client)
    {
        $this->usdc = new WalletExchangeCryptotocryptoExternalBridgeUsdc($client);
    }

}

class WalletExchangeCryptotocryptoExternalBridgeUsdc
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/bridge/usdc/fees', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/bridge/usdc/initiate', $body, true);
    }

    public function status(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/bridge/usdc/status', $body, true);
    }

    public function supportedChains(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/bridge/usdc/supported-chains', $body, true);
    }
}

class WalletExchangeCryptotocryptoExternalSwap
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/swap/fees', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/swap/initiate', $body, true);
    }

    public function status(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/swap/status', $body, true);
    }

    public function supportedPairs(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotocrypto/external/swap/supported-pairs', $body, true);
    }
}

class WalletExchangeCryptotofiat
{
    public WalletExchangeCryptotofiatExternal $external;

    public function __construct(private Client $client)
    {
        $this->external = new WalletExchangeCryptotofiatExternal($client);
    }

}

class WalletExchangeCryptotofiatExternal
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotofiat/external/fees', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotofiat/external/initiate', $body, true);
    }

    public function supportedPairs(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/cryptotofiat/external/supported-pairs', $body, true);
    }
}

class WalletExchangeFiattocrypto
{
    public WalletExchangeFiattocryptoWallet $wallet;

    public function __construct(private Client $client)
    {
        $this->wallet = new WalletExchangeFiattocryptoWallet($client);
    }

}

class WalletExchangeFiattocryptoWallet
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattocrypto/wallet/fees', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattocrypto/wallet/initiate', $body, true);
    }

    public function supportedPairs(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattocrypto/wallet/supported-pairs', $body, true);
    }
}

class WalletExchangeFiattofiat
{
    public WalletExchangeFiattofiatWallet $wallet;

    public function __construct(private Client $client)
    {
        $this->wallet = new WalletExchangeFiattofiatWallet($client);
    }

}

class WalletExchangeFiattofiatWallet
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattofiat/wallet/fees', $body, true);
    }

    public function initiate(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattofiat/wallet/initiate', $body, true);
    }

    public function supportedPairs(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/exchange/fiattofiat/wallet/supported-pairs', $body, true);
    }
}

class WalletMpwt
{
    public function __construct(private Client $client)
    {
    }

    public function balance(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/mpwt/balance', $body, true);
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/mpwt/fees', $body, true);
    }

    public function fund(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/mpwt/fund', $body, true);
    }
}

class WalletTransfer
{
    public WalletTransferCross $cross;
    public WalletTransferDirect $direct;

    public function __construct(private Client $client)
    {
        $this->cross = new WalletTransferCross($client);
        $this->direct = new WalletTransferDirect($client);
    }

}

class WalletTransferCross
{
    public function __construct(private Client $client)
    {
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/cross/fees', $body, true);
    }

    public function single(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/cross/single', $body, true);
    }

    public function supportedRoutes(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/cross/supported-routes', $body, true);
    }
}

class WalletTransferDirect
{
    public function __construct(private Client $client)
    {
    }

    public function bulk(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/bulk', $body, true);
    }

    public function fees(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/fees', $body, true);
    }

    public function queue(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/queue', $body, true);
    }

    public function single(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/single', $body, true);
    }

    public function supportedCurrencies(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/supported-currencies', $body, true);
    }

    public function supportedNetwork(array $body = []): array
    {
        return $this->client->request('POST', 'wallet/transfer/direct/supported-network', $body, true);
    }
}
