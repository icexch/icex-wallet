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

    protected function getBlocksCount()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/eth/main');
        $response = json_decode($response);

        return $response->height;
    }

    public function checkNode()
    {
    	$return = [
		    'result' => false,
		    'sync' => false,
	    ];

        if (!($info = $this->client->eth_syncing())) {
            return $return;
        }

        $return['result'] = true;

        $selfBlockCount = hexdec($info['currentBlock']);
        $blockCount = $this->getBlocksCount();

	    $return['local_height'] = $selfBlockCount;
	    $return['global_height'] = $blockCount;

        if ($blockCount > $selfBlockCount) {
            return $return;
        }

        $return['sync'] = true;

        return $return;
    }

    public function createWallet($account)
    {
        return call_user_func_array([$this->client, 'personal_newAccount'], [$account]);
    }

    public function getWallets($account)
    {
        return false;
    }

    public function getAccounts()
    {
        return $this->client->personal_listAccounts();
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
        return call_user_func_array([$this->client, 'eth_getBalance'], [$wallet]);
    }

    public function sendToAccount($from_account, $to_account, $amount)
    {
        return false;
    }

    public function sendToWallet($from_wallet, $to_wallet, $amount)
    {
        return call_user_func_array(
        	[
        		$this->client,
		        'eth_sendTransaction'
	        ],
	        [
            'from' => $from_wallet,
            'to' => $to_wallet,
            'value' => $amount,
            'gas' => 21000,
            'gasPrice' => 60
            ]
        );
    }

    public function getBlock($hash, $transaction_objects = true)
    {
	    return call_user_func_array([$this->client, 'eth_getBlockByHash'], [$hash, $transaction_objects]);
    }

    public function getBlockByHeight($height, $transaction_objects = true)
    {
    	return call_user_func_array([$this->client, 'eth_getBlockByNumber'], [$height, $transaction_objects]);
    }

    public function getLastBlock($transaction_objects = true)
    {
	    $height = $this->client->eth_blockNumber();

	    return $this->getBlockByHeight($height, $transaction_objects);
    }

    public function getTx($txid)
    {
	    return call_user_func_array([$this->client, 'eth_getTransactionByHash'], [$txid]);
    }
}