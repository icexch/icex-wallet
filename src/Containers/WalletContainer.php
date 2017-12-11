<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:06
 */

namespace Icex\IcexWallet\Containers;

use Icex\IcexWallet\Contracts\WalletContract;

abstract class WalletContainer implements WalletContract {

    protected $node;
    public $client;
    protected $credentials;

    /**
     * WalletContainer constructor.
     * @param null $credentials
     */
    public function __construct($credentials = null)
    {
        if (!$credentials) {
            $credentials = config('wallet.nodes.'.$this->node);
        }
        $this->credentials = $credentials;
    }

    public function checkNode()
    {
        // TODO: Implement checkNode() method.
    }

    public function getAccounts()
    {
        // TODO: Implement getAccounts() method.
    }

    public function getAccount($wallet)
    {
        // TODO: Implement getAccount() method.
    }

    public function createWallet($account)
    {
        // TODO: Implement createWallet() method.
    }

    public function getWallets($account)
    {
        // TODO: Implement getWallets() method.
    }

    public function getAccountBalance($account)
    {
        // TODO: Implement checkNode() method.
    }

    public function getWalletBalance($wallet)
    {
        // TODO: Implement checkNode() method.
    }
}