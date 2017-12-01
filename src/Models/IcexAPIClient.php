<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 01.12.17
 * Time: 20:08
 */

namespace Icex\IcexWallet\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class IcexAPIClient {

	protected $client;
	public $API_URL = 'http://api.icex.ch/api/';

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function request($method, array $params = [], $request = 'GET')
	{

		$url = $this->API_URL.$method;

		$response = $this->client->request($request, $url, [
			'query' => $params
		]);

		if($response->getStatusCode() == '200') {
			return json_decode($response->getBody());
		}

		Log::error('IcexAPIClient error: ', ['reponse' =>  $response]);

		return false;
	}
}