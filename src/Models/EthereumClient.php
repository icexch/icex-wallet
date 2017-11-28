<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 28.11.17
 * Time: 14:24
 */
namespace Icex\IcexWallet\Models;

use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClient;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClientFactory;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\Client;

class EthereumClient {

	public $client;

	public function __construct(array $credentials)
	{
		$httpClient = new GuzzleClient(new GuzzleClientFactory(), $credentials['host'], $credentials['port']);
		$this->client = new Client($httpClient);
	}

}