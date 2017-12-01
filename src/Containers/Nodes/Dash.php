<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:16
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Dash extends WalletRpcContainer {
    protected $node = 'dash';

    /**
     * @param array $params
     * @return mixed
     */
    public function sign($params = []) {
        return call_user_func_array([$this->client, 'signmessage'], $params);
    }
}