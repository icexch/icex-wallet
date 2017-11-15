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

    /**
     * Bitcoin constructor.
     * @param null|array $credentials
     */
    public function __construct($credentials = null)
	{
		$this->node = 'bitcoin';
		$this->client = $this->getClient($credentials);
	}

    /**
     * execute getinfo method
     *
     * @return mixed
     */
    public function getInfo()
	{
		return $this->client->getinfo();
	}

}