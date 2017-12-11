<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

class EthereumClassic extends Ethereum {
    protected $node = 'ethereum-classic';

    protected function getBlocksCount()
    {
        return hexdec($this->http_request('https://etcchain.com/gethProxy/eth_blockNumber'));
    }
}