<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletContainer;

class Monero extends WalletContainer {

	/**
	 * Bitcoin constructor.
	 * @param null|array $credentials
	 */
	public function __construct($credentials = null)
	{
		$this->node = 'monero';
		$this->client = $this->getClient($credentials);
	}

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