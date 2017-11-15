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

	protected $node;
	protected $client;

    /**
     * Get JSON-RPC client instance
     * for current node
     *
     * @param null|array $credentials
     * @return mixed
     * @internal param string $node_key
     *
     */
	protected function getClient($credentials = null)
	{
	    if (!$credentials) {
            $credentials = config('wallet.'.$this->node);
        }

		return new RPCClient($credentials['user'], $credentials['password'], $credentials['host'], $credentials['port']);
	}

    /**
     * get response error
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->client->error;
    }

	public function getInfo()
	{
		// Implements in Nodes
	}

}