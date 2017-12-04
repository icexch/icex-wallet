<?php
/**
 * Created by PhpStorm.
 * User: Wariefs
 * Date: 14.11.17
 * Time: 20:08
 */

namespace Icex\IcexWallet\Containers\Nodes;

use Icex\IcexWallet\Containers\WalletRpcContainer;

class Bitcoin extends WalletRpcContainer {

    protected $node = 'bitcoin';

	public function checkNode()
	{
		return $this->client->getinfo();
	}

	/**
	 * Check availability of node address
	 *
	 * @param $address
	 *
	 * @return bool
	 */
	protected function validateAddress($address) {
		$wallet_data = $this->client->validateaddress($address);

		if(!$wallet_data || (isset($wallet['is_valid']) && !$wallet['is_valid']) ) {
			return false;
		}

		return $wallet_data;
	}

	/**
	 * Returns the current bitcoin address for receiving payments to this account.
	 * If <account> does not exist,
	 * it will be created along with an associated new address that will be returned.
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function createWallet($account) {
		return call_user_func_array([$this->client, 'getaccountaddress'], [$account]);
	}

	/**
	 * Returns Object that has account names as keys, account balances as values.
	 *
	 * @return mixed
	 */
	public function getAccounts() {
		return $this->client->listaccounts();
	}

	/**
	 * Returns the list of addresses for the given account.
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function getWallets($account) {
		return call_user_func_array([$this->client, 'getaddressesbyaccount'], [$account]);
	}

	/**
	 * Returns the account associated with the given address.
	 *
	 * @param $wallet
	 *
	 * @return mixed
	 */
	public function getAccount($wallet) {
		return call_user_func_array([$this->client, 'getaccount'], [$wallet]);
	}

	/**
	 * If [account] is not specified, returns the server's total available balance.
	 * If [account] is specified, returns the balance in the account.
	 *
	 * @param $account
	 *
	 * @return mixed
	 */
	public function getAccountBalance($account = null) {
		return call_user_func_array([$this->client, 'getbalance'], ($account) ? [$account]: []);
	}

	/**
	 * Returns balance of account associated with current wallet address
	 *
	 * @param $wallet
	 *
	 * @return bool|mixed
	 */
	public function getWalletBalance($wallet) {

		if(!$wallet_data = $this->validateAddress($wallet)) {
			return false;
		}

		$account = $this->getAccount($wallet_data['account']);

		if(!$account) {
			return false;
		}

		return $this->getAccountBalance($account);
	}
}