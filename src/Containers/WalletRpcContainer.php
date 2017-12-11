<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 20.11.2017
 * Time: 16:43
 */

namespace Icex\IcexWallet\Containers;

use Icex\IcexWallet\Models\RPCClient;

abstract class WalletRpcContainer extends WalletContainer
{
    /**
     * WalletRpcContainer constructor.
     * @param null $credentials
     */
    public function __construct($credentials = null)
    {
        parent::__construct($credentials);

        $this->client = $this->getClient($this->credentials);
    }

    /**
     * Get JSON-RPC client instance
     * for current node
     *
     * @param array $credentials
     * @return mixed
     * @internal param string $node_key
     *
     */
    protected function getClient(array $credentials)
    {
        return new RPCClient($credentials['user'], $credentials['password'], $credentials['host'], $credentials['port']);
    }

    public function executeMethod($method, $params = [])
    {
        return call_user_func_array([$this->client, $method], $params);
    }

    /**
     * get response error
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->client->error;
    }

    public function checkNode()
    {
        if (!($info = $this->client->getinfo())) {
            return [
                'result' => false,
                'sync' => false,
            ];
        }

        $selfBlockCount = $info['blocks'];
        $blockCount = $this->getBlocksCount();

        if ($blockCount > $selfBlockCount) {
            return [
                'result' => true,
                'sync' => false,
            ];
        }

        return [
            'result' => true,
            'sync' => true,
        ];
    }

    /**
     * Check availability of node address
     *
     * @param $address
     *
     * @return bool
     */
    protected function validateAddress($address) {
        $wallet_data = $this->client->validateaddress($address);

        if(!$wallet_data || (isset($wallet['is_valid']) && !$wallet['is_valid']) ) {
            return false;
        }

        return $wallet_data;
    }

    /**
     * Returns the current bitcoin address for receiving payments to this account.
     * If <account> does not exist,
     * it will be created along with an associated new address that will be returned.
     *
     * @param $account
     *
     * @return mixed
     */
    public function createWallet($account) {
        return call_user_func_array([$this->client, 'getaccountaddress'], [$account]);
    }

    /**
     * Returns Object that has account names as keys, account balances as values.
     *
     * @return mixed
     */
    public function getAccounts() {
        return $this->client->listaccounts();
    }

    /**
     * Returns the list of addresses for the given account.
     *
     * @param $account
     *
     * @return mixed
     */
    public function getWallets($account) {
        return call_user_func_array([$this->client, 'getaddressesbyaccount'], [$account]);
    }

    /**
     * Returns the account associated with the given address.
     *
     * @param $wallet
     *
     * @return mixed
     */
    public function getAccount($wallet) {
        return call_user_func_array([$this->client, 'getaccount'], [$wallet]);
    }

    /**
     * If [account] is not specified, returns the server's total available balance.
     * If [account] is specified, returns the balance in the account.
     *
     * @param $account
     *
     * @return mixed
     */
    public function getAccountBalance($account = null) {
        return call_user_func_array([$this->client, 'getbalance'], ($account) ? [$account]: []);
    }

    /**
     * Returns balance of account associated with current wallet address
     *
     * @param $wallet
     *
     * @return float
     */
    public function getWalletBalance($wallet) {

        if(!$wallet_data = $this->validateAddress($wallet)) {
            return false;
        }

        $account = $this->getAccount($wallet);

        if(!$account) {
            return false;
        }

        return $this->getAccountBalance($account);
    }

    /**
     * Get account's transactions list
     *
     * @param $account
     *
     * @return bool
     */
    public function getHistory($account)
    {
        if(!$account_check = $this->getWallets($account)) {
            return false;
        }

        return $this->client->listtransactions($account);
    }

    /**
     * Send coins from account to wallet
     *
     * @param $from_account
     * @param $to_wallet
     * @param $amount
     *
     * @return bool
     */
    public function sendToWallet($from_account, $to_wallet, $amount)
    {
        if(!$wallet_data = $this->validateAddress($to_wallet)) {
            return false;
        }

        if(!$account = $this->getWallets($from_account)) {
            return false;
        }

        return $this->client->sendfrom($from_account, $to_wallet, $amount);
    }

    /**
     * Send coins between accounts
     *
     * @param $from_account
     * @param $to_account
     * @param $amount
     *
     * @return bool
     */
    public function sendToAccount($from_account, $to_account, $amount)
    {

        if(!$account_from_wallets = $this->getWallets($from_account)) {
            return false;
        }

        if(!$account_to_wallets = $this->getWallets($to_account)) {
            return false;
        }

        return $this->client->sendfrom($from_account, $account_to_wallets[0], $amount);
    }
}