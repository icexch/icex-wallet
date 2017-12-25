<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:08
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Bitcoin extends WalletRpcContainer {

	/**
	 * @var string
	 */
	protected $node = 'bitcoin';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/btc/main');
        $response = json_decode($response);

        return $response->height;
    }

	/**
	 * @return bool
	 */
	protected function getLocalHeight()
	{
		if (!($info = $this->client->getinfo())) {
			return false;
		}

		return $info['blocks'];
	}
}