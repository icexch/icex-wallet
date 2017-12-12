<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:11
 */

namespace Icex\IcexWallet\Providers;

use Icex\IcexWallet\Containers\Nodes\{
    Bitcoin, BtcCash, Dash, Litecoin, Monero, Neo, Nem, Ethereum, EthereumClassic
};
use Icex\IcexWallet\Registry\WalletRegistry;
use Illuminate\Support\ServiceProvider;

class WalletProvider extends ServiceProvider{

	public function boot()
	{

		$this->publishes([
			__DIR__.'/../Config/wallet.php' => config_path('wallet.php'),
		]);

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

		$this->app->make(WalletRegistry::class)
			->register('bitcoin', new Bitcoin())
			->register('btc-cash', new BtcCash())
			->register('dash', new Dash())
			->register('litecoin', new Litecoin())
			->register('monero', new Monero())
            ->register('neo', new Neo())
            ->register('nem', new Nem())
            ->register('ethereum', new Ethereum())
            ->register('ethereum-classic', new EthereumClassic());
	}

	public function register()
	{
		$this->app->singleton(WalletRegistry::class);
	}

}