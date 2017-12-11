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
    protected $node = 'neo';

    protected function getBlocksCount()
    {
        $response = $this->http_request('https:/neoscan.io//api/main_net/v1/get_all_nodes');
        $response = json_decode($response);

        return array_column($response, 'height')[0];
    }

    public function checkNode()
    {
        if (!($info = $this->client->getblockcount())) {
            return [
                'result' => false,
                'sync' => false,
            ];
        }

        $selfBlockCount = $info;
        $blockCount = $this->getBlocksCount();

        if ($blockCount > $selfBlockCount) {
            return [
                'result' => true,
                'sync' => false,
            ];
        }

        return [
            'result' => true,
            'sync' => true,
        ];
    }


	public function getInfo()
	{
		return $this->client->getblockcount();
	}

	public function getConnectionCount()
	{
		return $this->client->getconnectioncount();
	}

	public function send($params)
	{
		return call_user_func_array([$this->client, 'sendtoaddress'], $params);
	}

	public function getBalance($params)
	{
		return call_user_func_array([$this->client, 'getbalance'], $params);
	}

	public function coinHistory($params = [])
	{
		return call_user_func_array([$this->client, 'getrawtransaction'], $params);
	}
}