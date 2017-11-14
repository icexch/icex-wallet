<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:06
 */

namespace Icexch\IcexchWallet\Containers;

use Icexch\IcexchWallet\Contracts\WalletContract;
use JsonRPC\Client;


class WalletContainer implements WalletContract {

	protected $client;

	/**
	 * Get JSON-RPC client instance
	 * for current node
	 *
	 * @param string $node_key
	 *
	 * @return Client
	 */
	protected function getClient($node_key = 'bitcoin')
	{
		$credentials = config('wallet.'.$node_key);

		$client = new Client('http://'.$credentials['host'].':'.$credentials['port']);
		return $client->getHttpClient()
			->withUsername($credentials['user'])
			->withPassword($credentials['passwords']);
	}

	public function getInfo()
	{
		//
	}

}