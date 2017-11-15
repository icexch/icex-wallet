<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 15.11.17
 * Time: 12:19
 */

namespace Icex\IcexWallet\Containers\Nodes;

class BtcCash extends Bitcoin {

	public function __construct()
	{
		parent::__construct();
		$this->node = 'btc-cash';
		$this->client = $this->getClient();
	}

}