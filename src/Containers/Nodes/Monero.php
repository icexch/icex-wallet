<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletContainer;
use Icex\IcexWallet\Models\RPCClient;
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

    /**
     * Returns a new address for receiving payments
     *
     * @param $params
     * @return mixed
     */
    public function newAddress($params)
    {
        // TODO implement new addres method for monero
        return false;
    }
}