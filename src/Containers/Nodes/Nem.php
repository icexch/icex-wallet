<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletHttpContainer;

class Nem extends WalletHttpContainer {
    protected $node = 'nem';

    /**
     * @return bool|array
     */
    public function getInfo()
    {
        return $this->request('node/info');
    }

    /**
     * @return bool|array
     */
    public function getBlockChainInfo()
    {
        return $this->request('chain/height');
    }

    /**
     * @return bool|array
     */
    public function getPeerInfo()
    {
        return $this->request('node/peer-list/all');
    }

    /**
     * @return bool|array
     */
    public function newAddress()
    {
        return $this->request('account/generate');
    }

    /**
     * @param array $params
     * @return array|bool
     */
    public function send($params)
    {
        return $this->request('transaction/prepare-announce', $params, 'POST');
    }

    /**
     * @param array $params
     * @return array|bool
     */
    public function getAccount($params)
    {
        return $this->request('account/get', $params);
    }
}