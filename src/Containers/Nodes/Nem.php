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
     * @return null|string
     */
    public function getInfo()
    {
        return $this->request('node/info');
    }

    /**
     * @return null|string
     */
    public function getBlockChainInfo()
    {
        return $this->request('chain/height');
    }

    /**
     * @return null|string
     */
    public function getPeerInfo()
    {
        return $this->request('node/peer-list/all');
    }
}