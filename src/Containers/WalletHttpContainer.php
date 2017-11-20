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
     * @param       $method
     * @param array $params
     *
     * @return null|array
     */
    public function request($method, array $params = [])
    {
        $uri = $this->uri_construct($method, $params);
        $client = new Client();
        try {
            $request = $client->request('GET', $uri, [
                'http_errors' => false,
            ]);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return null;
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