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
	protected $client;
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
}