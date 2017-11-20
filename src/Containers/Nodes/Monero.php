<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

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

}