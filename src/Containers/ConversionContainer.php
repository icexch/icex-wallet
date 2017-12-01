<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 30.11.17
 * Time: 18:35
 */

namespace Icex\IcexWallet\Containers;

use Carbon\Carbon;
use Icex\IcexWallet\Contracts\ConversionContract;
use Icex\IcexWallet\Models\IcexAPIClient;
use Swap\Builder;

class ConversionContainer implements ConversionContract {

	protected $time;
	protected $icex;
	protected $swap;
	protected $crypto_coins;
	protected $base_currency = 'USD';

	/**
	 * ConversionContainer constructor.
	 */
	public function __construct(Carbon $time, IcexAPIClient $icex)
	{
		$this->time = $time;

		$this->icex = $icex;
		$this->swap = (new Builder())
			->add('fixer')
			->build();
		$this->crypto_coins = $this->getAvailableCryptoCoins();
	}

	/**
	 * Get available crypto coins list
	 *
	 * @return array
	 */
	protected function getAvailableCryptoCoins()
	{
		$return = [];

		if($coins = $this->icex->request('coins', ['short' => 1])) {

			foreach ($coins->data as $key => $coin) {
				$return[$coin->short] = $coin;
			}

		}

		return json_decode(json_encode($return), 1);
	}

	/**
	 * Get crypto coin rate from ICEX API
	 * TODO: add date
	 *
	 * @param      $coin
	 * @param null $date
	 *
	 * @return bool
	 */
	protected function getCryptoRate($coin, $date = null)
	{
		$coin = $this->crypto_coins[$coin];
		if($response = $this->icex->request('coins/'.$coin['name']))  {
			return $response->data->price_usd;
		}

		return false;
	}

	/**
	 * Get fiat rate for USD
	 *
	 * @param      $currency
	 * @param null $date
	 *
	 * @return mixed
	 */
	protected function getFiatRate($currency, $date = null)
	{
		$pair = $currency.'/'.$this->base_currency;

		if(!$date) {
			$rate = $this->swap->latest($pair);
		} else {
			$rate = $this->swap->historical($pair, $date);
		}

		return $rate->getValue();
	}

	/**
	 * Get cross rate
	 *
	 * @param      $first
	 * @param      $second
	 * @param null $date
	 *
	 * @return float
	 */
	public function cross_rate($first, $second, $date = null)
	{
		if(array_key_exists($first, $this->crypto_coins)) {
			$first_usd = $this->getCryptoRate($first, $date);
		} else {
			$first_usd = $this->getFiatRate($first, $date);
		}

		if(array_key_exists($second, $this->crypto_coins)) {
			$second_usd = $this->getCryptoRate($second, $date);
		} else {
			$second_usd = $this->getFiatRate($second, $date);
		}

		return $first_usd * 1/$second_usd;
	}

}