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
    protected $node = 'bitcoin';

    protected function getBlocksCount()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/btc/main');
        $response = json_decode($response);

        return $response->height;
    }
}