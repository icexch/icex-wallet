<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:16
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Litecoin extends WalletRpcContainer {
    protected $node = 'litecoin';

    protected function getBlocksCount()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/ltc/main');
        $response = json_decode($response);

        return $response->height;
    }
}