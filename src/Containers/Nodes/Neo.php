<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Neo extends WalletRpcContainer {

	/**
	 * @var string
	 */
    protected $node = 'neo';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https:/neoscan.io//api/main_net/v1/get_all_nodes');
        $response = json_decode($response);

        return array_column($response, 'height')[0];
    }

	/**
	 * @return bool
	 */
	protected function getLocalHeight()
	{
		if (!($info = $this->client->getblockcount())) {
			return false;
		}

		return $info;
	}

	/**
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function coinHistory($params = [])
	{
		return $this->executeMethod('getrawtransaction', $params);
	}
}