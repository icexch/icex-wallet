<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 19:54
 */

namespace Icexch\IcexchWallet\Contracts;

interface WalletContract {

	/**
	 * Get info about node
	 *
	 * @return mixed
	 */
	public function getInfo();

}