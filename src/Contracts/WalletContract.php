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
	 * Get block info by header hash
	 * https://bitcoin.org/en/developer-reference#getblock
	 *
	 * @param $hash
	 *
	 * @return mixed
	 */
	public function getBlock($hash);

	/**
	 * Get block info at the given height in the local best block chain.
	 * 1. hash -> https://bitcoin.org/en/developer-reference#getblockhash
	 * 2. this->getBlock(hash)
	 * @param $height
	 *
	 * @return mixed
	 */
	public function getBlockByHeight($height);

	/**
	 * Get info about of the most recent block on the best block chain.
	 * 1.hash -> https://bitcoin.org/en/developer-reference#getbestblockhash
	 * 2.this->getBlock(hash)
	 *
	 * @return mixed
	 */
	public function getLastBlock();

	/**
	 * Gets detailed information about an in-wallet transaction.
	 * https://bitcoin.org/en/developer-reference#gettransaction
	 *
	 * @param $txid
	 *
	 * @return mixed
	 */
	public function getTx($txid);

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

    /**
     * Send coins from user's account to wallet
     *
     * @param $from_account
     * @param $to_wallet
     * @param $amount
     *
     * @return mixed
     */
    public function sendToWallet($from_account, $to_wallet, $amount);

    /**
     * Send coins between two accounts.
     * Used first (to_accounts) wallet from list.
     *
     * @param $from_account
     * @param $to_account
     * @param $amount
     *
     * @return mixed
     */
    public function sendToAccount($from_account, $to_account, $amount);

	/**
	 * Get transactions history for account
	 *
	 * @param      $account
	 * @param null $type
	 *
	 * @return mixed
	 */
	public function history($account, $type = null);
}