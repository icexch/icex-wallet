<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 16.11.17
 * Time: 19:17
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Clients\RPCClient;
use Icex\IcexWallet\Containers\WalletRpcContainer;

class Monero extends WalletRpcContainer {

	/**
	 * @var string
	 */
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

	/**
	 * @return mixed
	 */
    protected function getGlobalHeight()
    {
        $response = $this->http_request('https://moneroblocks.info/api/get_stats');
        $response = json_decode($response);

        return $response->height;
    }

	/**
	 * @return bool
	 */
	protected function getLocalHeight()
	{
		if (!($info = $this->client->getblockcount())) {
			return false;
		}

		return $info['count'];
	}

	/**
	 * @param        $filename
	 * @param        $password
	 * @param string $language
	 *
	 * @return mixed
	 */
	public function createAccount($filename, $password, $language = 'English')
	{
		return $this->executeMethod('create_wallet',
			[
				'filename' => $filename,
				'password' => $password,
				'language' => $language
			]);
	}

	/**
	 * @param $hash
	 *
	 * @return mixed
	 */
    public function getBlock($hash)
    {
	    return $this->executeMethod('getblock', ['hash' => $hash]);
    }

	/**
	 * @param $height
	 *
	 * @return mixed
	 */
    public function getBlockByHeight($height)
    {
	    return $this->executeMethod('getblock', ['height' => $height]);
    }

	/**
	 * @return mixed
	 */
    public function getLastBlock()
    {
    	$last_height = $this->executeMethod('lastblockheader');

	    return $this->getBlockByHeight($last_height);
    }

	/**
	 * @param $txid
	 *
	 * @return mixed
	 */
    public function getTx($txid)
    {
	    return $this->executeMethod('get_transfer_by_txid', ['txid' => $txid]);
    }
}