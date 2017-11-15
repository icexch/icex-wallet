<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:06
 */

namespace Icex\IcexWallet\Containers;

use Icex\IcexWallet\Contracts\WalletContract;
use Icex\IcexWallet\Models\RPCClient;


class WalletContainer implements WalletContract {

	protected $client;

	/**
	 * Get JSON-RPC client instance
	 * for current node
	 *
	 * @param string $node_key
	 *
	 * @return mixed
	 */
	protected function getClient($node_key = 'bitcoin')
	{
		$credentials = config('wallet.'.$node_key);

		return new RPCClient($credentials['user'], $credentials['password'], $credentials['host'], $credentials['port']);
	}

	public function getInfo()
	{
		// Implements in Nodes
	}

}