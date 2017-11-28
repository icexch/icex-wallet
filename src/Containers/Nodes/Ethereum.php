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
    protected $node = 'ethereum';

	public function getInfo()
	{
		return call_user_func_array([$this->client, 'eth_protocolVersion'], []);
	}

	public function getBlockChainInfo()
	{
		return call_user_func_array([$this->client, 'eth_blockNumber'], []);
	}

	public function getMiningInfo()
	{
		return call_user_func_array([$this->client, 'eth_mining'], []);
	}

	public function getPeerInfo()
	{
		return call_user_func_array([$this->client, 'net_peerCount'], []);
	}

	public function createAccount($params = [ ])
	{
		return call_user_func_array([$this->client, 'personal_newAccount'], $params);
	}

	public function send($params = [ ])
	{
		return call_user_func_array([$this->client, 'eth_sendTransaction'], $params);
	}

	public function getBalance($params)
	{
		return call_user_func_array([$this->client, 'eth_getBalance'], $params);
	}
}