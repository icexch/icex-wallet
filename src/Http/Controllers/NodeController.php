<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 15:28
 */

namespace Icex\IcexWallet\Http\Controllers;

use Icex\IcexWallet\Registry\WalletRegistry;

class NodeController extends BaseController
{
    protected $wallet;

    /**
     * NodesController constructor.
     * @param WalletRegistry $wallet
     */
    public function __construct(WalletRegistry $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * execute method getinfo for node
     *
     * @param string $node
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo($node)
    {
        $node_wallet = $this->wallet->get($node);

        $node_wallet_info = $node_wallet->getInfo();

        if (!$node_wallet_info) {
            return $this->responseJson(['error' => $node_wallet->getError()], $node);
        }

        return $this->responseJson($node_wallet_info, $node);
    }
}