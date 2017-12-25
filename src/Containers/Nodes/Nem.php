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

	/**
	 * @var string
	 */
    protected $node = 'nem';

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('http://103.11.64.51:7890/chain/last-block');
        $response = json_decode($response);

        return $response->height;
    }

	/**
	 * @return bool
	 */
    protected function getLocalHeight()
    {
	    if (!($info = $this->request('chain/height'))) {
		    return false;
	    }

	    return $info['height'];
    }

    /**
     * @return bool|array
     */
    public function createAccount()
    {
        return $this->request('account/generate');
    }

    /**
     * @param array $params
     * @return array|bool
     */
    public function getAccount($params)
    {
        return $this->request('account/get', $params);
    }

    /**
     * @param array $params
     * @return array|bool
     */
    public function coinHistory($params = [])
    {
    	return $this->request('account/transfers/all', $params);
    }
}