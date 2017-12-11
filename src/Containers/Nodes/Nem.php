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

    protected function getBlocksCount()
    {
        $response = $this->http_request('http://103.11.64.51:7890/chain/last-block');
        $response = json_decode($response);

        return $response->height;
    }

    public function checkNode()
    {
        if (!($info = $this->request('chain/height'))) {
            return [
                'result' => false,
                'sync' => false,
            ];
        }

        $selfBlockCount = $info['height'];
        $blockCount = $this->getBlocksCount();

        if ($blockCount > $selfBlockCount) {
            return [
                'result' => true,
                'sync' => false,
            ];
        }

        return [
            'result' => true,
            'sync' => true,
        ];
    }

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
    public function getNetworkInfo()
    {
        return $this->request('debug/time-synchronization');
    }

    /**
     * @return bool|array
     */
    public function getConnectionCount()
    {
        return $this->request('debug/connections/incoming');
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
    public function createAccount()
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

    /**
     * @param array $params
     * @return array|bool
     */
    public function coinHistory($params = [])
    {
    	return $this->request('account/transfers/all', $params);
    }

    /**
     * @param array $params
     * @return array|bool
     */
    public function sign($params = [])
    {
        return $this->request('transaction/announce', $params, 'POST');
    }
}