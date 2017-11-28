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

	public function getClient(array $credentials)
	{
		return (new EthereumClient($credentials))->client;
	}

	public function getInfo()
	{
		return $this->client->callMethod('eth_protocolVersion', []);
	}

	public function getBlockChainInfo()
	{
		return $this->client->callMethod('eth_blockNumber', []);
	}

	public function getMiningInfo()
	{
		return $this->client->callMethod('eth_mining', []);
	}

	public function getPeerInfo()
	{
		return $this->client->callMethod('net_peerCount', []);
	}

	public function createAccount($params = [ ])
	{
		return $this->client->callMethod('personal_newAccount', $params);
	}

	public function send($params = [ ])
	{
		return $this->client->callMethod('eth_sendTransaction', $params);
	}

	public function getBalance($params)
	{
		return $this->client->callMethod('eth_getBalance', $params);
	}

	public function coinHistory()
	{
		return $this->client->callMethod('eth_getFilterChanges', []);
	}
}