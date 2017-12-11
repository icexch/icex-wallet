<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;
use Icex\IcexWallet\Models\EthereumClient;

class Ethereum extends WalletRpcContainer {
    protected $node = 'ethereum';
    // TODO переделать на обычный RPCClient
//	public function getClient(array $credentials)
//	{
//		return (new EthereumClient($credentials))->client;
//	}
//
//	public function getError()
//    {
//        return null;
//    }
//
//    public function executeMethod($method, $params = [])
//    {
//        return $this->client->callMethod($method, $params);
//    }

    protected function getBlocksCount()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/eth/main');
        $response = json_decode($response);

        return $response->height;
    }

    public function checkNode()
    {
        if (!($info = $this->client->eth_syncing())) {
            return [
                'result' => false,
                'sync' => false,
            ];
        }

        $selfBlockCount = hexdec($info['currentBlock']);
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

    public function createWallet($account)
    {
        return $this->client->callMethod('personal_newAccount', [$account]);
    }

    public function getWallets($account)
    {
        return false;
    }

    public function getAccounts()
    {
        return $this->client->callMethod('personal_listAccounts', []);
    }

    public function getAccount($wallet)
    {
        return false;
    }

    public function getAccountBalance($account = null)
    {
        return false;
    }

    public function getWalletBalance($wallet)
    {
        return $this->client->callMethod('eth_getBalance', [$wallet]);
    }

    public function sendToAccount($from_account, $to_account, $amount)
    {
        return false;
    }

    public function sendToWallet($from_wallet, $to_wallet, $amount)
    {
        return $this->client->callMethod('eth_sendTransaction', [
            'from' => $from_wallet,
            'to' => $to_wallet,
            'value' => $amount,
            'gas' => 21000,
            'gasPrice' => 60
        ]);
    }
}