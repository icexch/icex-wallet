<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:16
 */

namespace Icex\IcexWallet\Containers\Nodes;

class Dash extends Bitcoin {

	/**
	 * @var string
	 */
	protected $node = 'dash';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https://api.blockcypher.com/v1/dash/main');
        $response = json_decode($response);

        return $response->height;
    }
}