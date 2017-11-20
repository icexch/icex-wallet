<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 20.11.2017
 * Time: 16:43
 */

namespace Icex\IcexWallet\Containers;

use Icex\IcexWallet\Models\RPCClient;

abstract class WalletRpcContainer extends WalletContainer
{
    /**
     * WalletRpcContainer constructor.
     * @param null $credentials
     */
    public function __construct($credentials = null)
    {
        parent::__construct($credentials);

        $this->client = $this->getClient($this->credentials);
    }

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
        return new RPCClient($credentials['user'], $credentials['password'], $credentials['host'], $credentials['port']);
    }

    /**
     * get response error
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->client->error;
    }

    /**
     * Execute getinfo method
     *
     * Response example:
     * {"result":
     * {"deprecation-warning":"WARNING: getinfo is deprecated and will be fully removed in 0.16. Projects should transition to using getblockchaininfo, getnetworkinfo, and getwalletinfo before upgrading to 0.16",
     * "version":150000,
     * "protocolversion":70015,
     * "blocks":492939,
     * "timeoffset":0,
     * "connections":0,
     * "proxy":"",
     * "difficulty":1452839779145.919,
     * "testnet":false,
     * "paytxfee":0.00000000,
     * "relayfee":0.00001000,
     * "errors":""},
     * "error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getInfo()
    {
        return $this->client->getinfo();
    }

    /**
     * Execute getblockchaininfo
     *
     * Response example:
     * {"result":
     * {"chain":"main",
     * "blocks":492939,
     * "headers":492939,
     * "bestblockhash":"0000000000000000001f7b836bb70fb0daf3780180ad5c20a7f42e0699ca6afc",
     * "difficulty":1452839779145.919,
     * "mediantime":1509716122,
     * "verificationprogress":0.9862044815397726,
     * "chainwork":"000000000000000000000000000000000000000000a98d6e714ba13c08374714",
     * "pruned":false,
     * "softforks":
     * [{"id":"bip34",
     * "version":2,
     * "reject":{"status":true}},
     * {"id":"bip66","version":3,
     * "reject":{"status":true}},
     * {"id":"bip65","version":4,
     * "reject":{"status":true}}],
     * "bip9_softforks":
     * {"csv":
     * {"status":"active","startTime":1462060800,"timeout":1493596800,"since":419328},
     * "segwit":
     * {"status":"active","startTime":1479168000,"timeout":1510704000,"since":481824}}},
     * "error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getBlockChainInfo()
    {
        return $this->client->getblockchaininfo();
    }

    /**
     * Execute getnetworkinfo
     *
     * Response example:
     * {"result":
     * {"version":150000,
     * "subversion":"/Satoshi:0.15.0/",
     * "protocolversion":70015,
     * "localservices":"000000000000000d",
     * "localrelay":true,
     * "timeoffset":0,
     * "networkactive":true,
     * "connections":0,
     * "networks":
     * [{"name":"ipv4","limited":false,"reachable":true,"proxy":"","proxy_randomize_credentials":false},
     * {"name":"ipv6","limited":false,"reachable":true,"proxy":"","proxy_randomize_credentials":false},
     * {"name":"onion","limited":true,"reachable":false,"proxy":"","proxy_randomize_credentials":false}],
     * "relayfee":0.00001000,"incrementalfee":0.00001000,"localaddresses":[],"warnings":""},
     * "error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getNetworkInfo()
    {
        return $this->client->getnetworkinfo();
    }

    /**
     * Execute getconnectioncount
     *
     * Response example:
     * {"result":0,"error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getConnectionCount()
    {
        return $this->client->getconnectioncount();
    }

    /**
     * Execute getdifficulty
     *
     * Response example:
     * {"result":1452839779145.919,"error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->client->getdifficulty();
    }

    /**
     * Execute getmininginfo
     *
     * Response example:
     * {"result":
     * {"blocks":492939,
     * "currentblocksize":0,
     * "currentblockweight":0,
     * "currentblocktx":0,
     * "difficulty":1452839779145.919,
     * "errors":"",
     * "networkhashps":9.694199351420545e+18,
     * "pooledtx":55221,
     * "chain":"main"},
     * "error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getMiningInfo()
    {
        return $this->client->getmininginfo();
    }

    /**
     * Execute getpeerinfo
     *
     * Response example:
     *  {"result":[ ~peers data~ ],"error":null,"id":"curltest"}
     *
     * @return mixed
     */
    public function getPeerInfo()
    {
        return $this->client->getpeerinfo();
    }

    /**
     * Returns a new address for receiving payments
     *
     * @param $params
     * @return mixed
     */
    public function newAddress($params)
    {
        return call_user_func_array([$this->client, 'getnewaddress'], $params);
    }
}