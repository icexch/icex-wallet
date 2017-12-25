<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 15.11.17
 * Time: 12:19
 */

namespace Icex\IcexWallet\Containers\Nodes;

class BtcCash extends Bitcoin {

	/**
	 * @var string
	 */
	protected $node = 'btc-cash';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https://bch-insight.bitpay.com/api/status?q=getInfo');
        $response = json_decode($response);

        return $response->info->blocks;
    }
}