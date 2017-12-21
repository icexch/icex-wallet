<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletContainer;
use Icex\IcexWallet\Models\RPCClient;
use Icex\IcexWallet\Containers\WalletRpcContainer;

class Monero extends WalletRpcContainer {

    protected $node = 'monero';


    /**
     * Get JSON-RPC client instance
     * for current node
     *
     * @param array $credentials
     * @return mixed
     * @internal param string $node_key
     *
     */
    protected function getClient(array $credentials)
    {
        return new RPCClient($credentials['user'], $credentials['password'], $credentials['host'], $credentials['port'], 'json_rpc');
    }

    protected function getBlocksCount()
    {
        $response = $this->http_request('https://moneroblocks.info/api/get_stats');
        $response = json_decode($response);

        return $response->height;
    }

    public function checkNode()
    {
    	$return = [
		    'result' => false,
		    'sync' => false,
	    ];

        if (!($info = $this->client->getblockcount())) {
            return $return;
        }

        $return['result'] = true;

        $selfBlockCount = $info['count'];
        $blockCount = $this->getBlocksCount();

	    $return['local_height'] = $selfBlockCount;
	    $return['global_height'] = $blockCount;

        if ($blockCount > $selfBlockCount) {
            return $return;
        }

        $return['sync'] = true;

        return $return;
    }

	/**
	 * execute getinfo method
	 *
	 * @return mixed
	 */
	public function getInfo()
	{
		return $this->client->get_info();
	}

	public function getBlockChainInfo()
	{
		return $this->client->getblockcount();
	}

	public function getConnectionCount()
	{
		return $this->client->get_connections();
	}

	public function createAccount($params = [ ])
	{
		return call_user_func_array([$this->client, 'create_wallet'], $params);
	}

	public function send($params = [ ])
	{
		return call_user_func_array([$this->client, 'transfer'], $params);
	}

	public function getAccountAddress($params)
	{
		return call_user_func_array([$this->client, 'getaddress'], $params);
	}

	public function getBalance($params)
	{
		return call_user_func_array([$this->client, 'getbalance'], $params);
	}

    /**
     * @param array $params
     * @return mixed
     */
    public function coinHistory($params = []) {
        return call_user_func_array([$this->client, 'get_transfers'], $params);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function sign($params = []) {
        return call_user_func_array([$this->client, 'sign'], $params);
    }

    public function getBlock($hash)
    {
	    return call_user_func_array([$this->client, 'getblock'], ['hash' => $hash]);
    }

    public function getBlockByHeight($height)
    {
	    return call_user_func_array([$this->client, 'getblock'], ['height' => $height]);
    }

    public function getLastBlock()
    {
	    return $this->getBlockByHeight($this->client->getlastblockheader());
    }

    public function getTx($txid)
    {
	    return call_user_func_array([$this->client, 'get_transfer_by_txid'], ['txid' => $txid]);
    }
}