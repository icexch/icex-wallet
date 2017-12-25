<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Ethereum extends WalletRpcContainer {

	protected $gas = 21000;
	protected $gasPrice = 60;

	/**
	 * @var string
	 */
	protected $node = 'ethereum';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/eth/main');
        $response = json_decode($response);

        return $response->height;
    }

	/**
	 * @return bool
	 */
	protected function getLocalHeight()
	{
		if (!($info = $this->client->eth_syncing())) {
			return false;
		}

		return hexdec($info['currentBlock']);
	}

	/**
	 * @param $account
	 *
	 * @return mixed
	 */
    public function createWallet($account)
    {
        return $this->executeMethod('personal_newAccount', [$account]);
    }

	/**
	 * @param $account
	 *
	 * @return bool
	 */
    public function getWallets($account)
    {
	    //TODO
    }

	/**
	 * @return mixed
	 */
    public function getAccounts()
    {
        return $this->executeMethod('personal_listAccounts');
    }


    public function getAccount($wallet)
    {
        //TODO
    }


    public function getAccountBalance($account = null)
    {
	    //TODO
    }

	/**
	 * @param $wallet
	 *
	 * @return mixed
	 */
    public function getWalletBalance($wallet)
    {
        return $this->executeMethod('eth_getBalance', [$wallet]);
    }

    public function sendToAccount($from_account, $to_account, $amount)
    {
	    //TODO
    }

	/**
	 * @param $from_wallet
	 * @param $to_wallet
	 * @param $amount
	 *
	 * @return mixed
	 */
    public function sendToWallet($from_wallet, $to_wallet, $amount)
    {
        return $this->executeMethod('eth_sendTransaction',
	        [
            'from' => $from_wallet,
            'to' => $to_wallet,
            'value' => $amount,
            'gas' => $this->gas,
            'gasPrice' => $this->gasPrice
            ]
        );
    }

	/**
	 * @param      $hash
	 * @param bool $transaction_objects if true - return tx object, false - only txid's
	 *
	 * @return mixed
	 */
    public function getBlock($hash, $transaction_objects = true)
    {
	    return $this->executeMethod('eth_getBlockByHash', [$hash, $transaction_objects]);
    }

	/**
	 * @param      $height
	 * @param bool $transaction_objects if true - return tx object, false - only txid's
	 *
	 * @return mixed
	 */
    public function getBlockByHeight($height, $transaction_objects = true)
    {
    	return $this->executeMethod('eth_getBlockByNumber', [$height, $transaction_objects]);
    }

	/**
	 * @param bool $transaction_objects if true - return tx object, false - only txid's
	 *
	 * @return mixed
	 */
    public function getLastBlock($transaction_objects = true)
    {
	    $height = $this->executeMethod('eth_blockNumber');

	    return $this->getBlockByHeight($height, $transaction_objects);
    }

	/**
	 * @param $txid
	 *
	 * @return mixed
	 */
    public function getTx($txid)
    {
	    return $this->executeMethod('eth_getTransactionByHash', [$txid]);
    }
}