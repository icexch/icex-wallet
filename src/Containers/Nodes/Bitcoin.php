<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:08
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletContainer;


class Bitcoin extends WalletContainer {

	public function __construct()
	{
		$this->node = 'bitcoin';
		$this->client = $this->getClient();
	}

	public function getInfo()
	{
		return $this->client->getinfo();
	}

}