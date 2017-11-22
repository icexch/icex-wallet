<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 20.11.2017
 * Time: 16:43
 */

namespace Icex\IcexWallet\Containers;

use GuzzleHttp\Client;

abstract class WalletHttpContainer extends WalletContainer
{
    protected $error;

    /**
     * WalletHttpContainer constructor.
     * @param null $credentials
     */
    public function __construct($credentials = null)
    {
        parent::__construct($credentials);

        $this->client = new Client();
    }

    /**
     * Construct an url for request
     *
     * @param       $method
     * @param array $params
     *
     * @return string
     */
    public function uri_construct($method, array $params = [])
    {
        $url = "http://{$this->credentials['host']}:{$this->credentials['port']}/{$method}";
        if(!empty($params)) {
            $params = http_build_query($params);
            $url .= "?{$params}";
        }

        return $url;
    }

    /**
     * Send request
     *
     * @param $method
     * @param array $params
     *
     * @param string $http_method
     * @return array|bool
     */
    public function request($method, array $params = [], $http_method = 'GET')
    {
        $uri = $this->uri_construct($method, $params);
        try {
            $request = $this->client->request($http_method, $uri, [
                'http_errors' => false,
            ]);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }

        $response = $request->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * get response error
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
    }
}