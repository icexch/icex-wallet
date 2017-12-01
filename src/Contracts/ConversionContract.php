<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 30.11.17
 * Time: 18:36
 */

namespace Icex\IcexWallet\Contracts;

interface ConversionContract {

	/**
	 * Convert currencies
	 *
	 * @param      $from
	 * @param      $to
	 * @param null $date
	 *
	 * @return mixed
	 */
	public function cross_rate($from, $to, $date = null);

}