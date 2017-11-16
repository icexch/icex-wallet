<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:11
 */

namespace Icex\IcexWallet\Providers;

use Icex\IcexWallet\Containers\Nodes\Bitcoin;
use Icex\IcexWallet\Containers\Nodes\BtcCash;
use Icex\IcexWallet\Containers\Nodes\Dash;
use Icex\IcexWallet\Containers\Nodes\Monero;

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
			->register('monero', new Monero());
	}

	public function register()
	{
		$this->app->singleton(WalletRegistry::class);
	}

}