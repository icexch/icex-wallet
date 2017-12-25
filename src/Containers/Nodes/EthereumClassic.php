<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

class EthereumClassic extends Ethereum {

	/**
	 * @var string
	 */
    protected $node = 'ethereum-classic';

	/**
	 * @return number
	 */
    protected function getGlobalHeight()
    {
        return hexdec($this->http_request('https://etcchain.com/gethProxy/eth_blockNumber'));
    }
}