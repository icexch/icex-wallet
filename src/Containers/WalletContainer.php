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
     * WalletContainer constructor.
     * @param null $credentials
     */
    public function __construct($credentials = null)
    {
        if (!$credentials) {
            $credentials = config('wallet.'.$this->node);
        }

        $this->client = $this->getClient($credentials);
    }

    /**
     * Get JSON-RPC client instance
     * for current node
     *
     * @param array $credentials
     * @return mixed
     * @internal param string $node_key
     *
     */
	protected function getClient(array $credentials)
	{
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