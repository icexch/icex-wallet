<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:08
 */

namespace Icexch\IcexchWallet\Containers\Nodes;

use Icexch\IcexchWallet\Containers\WalletContainer;

class Bitcoin extends WalletContainer {

	public function __construct()
	{
		$this->client = $this->getClient('bitcoin');
	}

	public function getInfo()
	{
		$result = $this->client->execute('getinfo');

		dd($result);
	}

}