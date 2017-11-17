<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 15:28
 */

namespace Icex\IcexWallet\Http\Controllers;

use Icex\IcexWallet\Registry\WalletRegistry;
use Illuminate\Http\Request;

class NodeController extends BaseController
{
    protected $wallet;
    protected $config;

    /**
     * NodesController constructor.
     * @param WalletRegistry $wallet
     */
    public function __construct(WalletRegistry $wallet)
    {
        $this->wallet = $wallet;
        $this->config = config('wallet') ?? require_once __DIR__ . '/../../Config/wallet.php';
    }

    /**
     * execute node method
     *
     * @param string $node
     * @param string $method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function executeMethod($node, $method, Request $request)
    {
        $node_wallet = $this->wallet->get($node);

        if (!isset($this->config['methods'][$method])) {
            return $this->responseJson(['error' => "unavailable method {$method}"], $node);
        }

        $method = $this->config['methods'][$method];
        $response = $node_wallet->$method($request->input());

        if ($response === false) {
            return $this->responseJson(['error' => $node_wallet->getError()], $node);
        }

        return $this->responseJson($response, $node);
    }
}