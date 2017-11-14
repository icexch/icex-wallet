<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 19:54
 */

namespace Icex\IcexWallet\Contracts;

interface WalletContract {

	/**
	 * Get info about node
	 *
	 * @return mixed
	 */
	public function getInfo();

}