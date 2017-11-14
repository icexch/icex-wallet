<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:06
 */

namespace Icex\IcexWallet\Containers;

use Icex\IcexWallet\Contracts\WalletContract;
use JsonRPC\Client;


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

		$client = new Client('http://'.$credentials['host'].':'.$credentials['port']);
		return $client->getHttpClient()
			->withUsername($credentials['user'])
			->withPassword($credentials['password']);
	}

	public function getInfo()
	{
		//
	}

}