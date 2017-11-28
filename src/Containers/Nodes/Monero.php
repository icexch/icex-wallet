<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletContainer;
use Icex\IcexWallet\Models\RPCClient;
use Icex\IcexWallet\Containers\WalletRpcContainer;

class Monero extends WalletRpcContainer {

    protected $node = 'monero';

	/**
	 * execute getinfo method
	 *
	 * @return mixed
	 */
	public function getInfo()
	{
		return $this->client->get_info();
	}

	public function getBlockChainInfo()
	{
		return $this->client->getblockcount();
	}

	public function getConnectionCount()
	{
		return $this->client->get_connections();
	}

	public function createAccount($params = [ ])
	{
		return call_user_func_array([$this->client, 'create_wallet'], $params);
	}

	public function send($params = [ ])
	{
		return call_user_func_array([$this->client, 'transfer'], $params);
	}

	public function getAccountAddress($params)
	{
		return call_user_func_array([$this->client, 'getaddress'], $params);
	}

	public function getBalance($params)
	{
		return call_user_func_array([$this->client, 'getbalance'], $params);
	}

	public function coinHistory()
	{
		return call_user_func_array([$this->client, 'get_transfers'], []);
	}
}