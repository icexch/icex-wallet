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
	 * Check node connection
	 *
	 * @return mixed
	 */
	public function checkNode();

	/**
	 * Create new wallet for account
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function createWallet($account);

	/**
	 * Get all accounts for node
	 *
	 * @return mixed
	 */
	public function getAccounts();

	/**
	 * Get account's wallets
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function getWallets($account);

	/**
	 * Get account by wallet address
	 *
	 * @param $wallet
	 *
	 * @return mixed
	 */
	public function getAccount($wallet);

	/**
	 * Get total account balance
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function getAccountBalance($account);

	/**
	 * Get wallet balance
	 *
	 * @param $wallet
	 *
	 * @return mixed
	 */
	public function getWalletBalance($wallet);

}