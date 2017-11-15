<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 19:52
 */

namespace Icex\IcexWallet\Registry;

use Icex\IcexWallet\Contracts\WalletContract as Contract;

class WalletRegistry
{

	protected $collectors = [];

	/**
	 * Register container instance.
	 * Used in provider.
	 *
	 * @param                        $name
	 * @param Contract $instance
	 *
	 * @return $this
	 */
	function register ($name, Contract $instance) {

		$this->collectors[$name] = $instance;

		return $this;
	}

	/**
	 * Get needed instance or default from config.
	 * Used in controllers, jobs, models etc.
	 *
	 * @param null $name
	 *
	 * @return Contract
	 * @throws \Exception
	 */
	function get($name) {

		if (isset($this->collectors[$name])) {
			return $this->collectors[$name];
		} else {
			throw new \Exception("Invalid wallet node");
		}
	}

}