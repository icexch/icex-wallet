<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:11
 */

namespace Icexch\IcexchWallet\Providers;

use Illuminate\Support\ServiceProvider;

class WalletProvider extends ServiceProvider{

	public function boot()
	{
		$this->publishes([

		]);
	}

	public function register()
	{

	}

}