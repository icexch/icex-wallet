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
     * NodeController constructor.
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

        $method_name = $this->config['methods'][$method] ?? null;

        if (!$method_name || !method_exists($node_wallet, $method_name)) {
            return $this->responseJson(['error' => "Unavailable method {$method}"], $node);
        }

        $response = $node_wallet->$method_name($request->input());

        if ($response === false) {
            return $this->responseJson(['error' => $node_wallet->getError()], $node);
        }

        return $this->responseJson($response, $node);
    }
}