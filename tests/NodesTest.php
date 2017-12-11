<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 16:11
 */

use Icex\IcexWallet\Containers\Nodes\{
    Bitcoin,
    BtcCash,
    Dash,
    Litecoin,
    Monero,
    Neo,
    Nem,
    Ethereum,
    EthereumClassic
};
use PHPUnit\Framework\TestCase;


class NodesTest extends TestCase
{
    private $class_names = [
        'bitcoin' => Bitcoin::class,
        'btc-cash' => BtcCash::class,
        'dash' => Dash::class,
        'litecoin' => Litecoin::class,
        'monero' => Monero::class,
        'neo' => Neo::class,
        'nem' => Nem::class,
        'ethereum' => Ethereum::class,
        'ethereum-classic' => EthereumClassic::class,
    ];

    // fill your credentials
    // test key - for on or off testing node
    private $credentials = [
        'bitcoin' => [
            'host' => '192.168.121.2',
            'port' => '8332',
            'user' => 'icexwlbitcoin',
            'password' => 'wnhrELWXQZRh5NPSjbprJFeJFE7ZkT',
            'test' => 0,
        ],

        'btc-cash' => [
            'host' => '192.168.121.10',
            'port' => '8332',
            'user' => 'bitcoin',
            'password' => 'password',
            'test' => 0
        ],

        'dash' => [
            'host' => '192.168.121.11',
            'port' => '9998',
            'user' => 'dashrpc',
            'password' => 'TFubreGaK/kcZBgz4NWAAXF55wPkJRUFcquivcTt1xT2',
            'test' => 0,
        ],

	    'litecoin' => [
		    'host' => '192.168.121.4',
		    'port' => '9332',
		    'user' => 'bitcoin',
		    'password' => 'password',
		    'test' => 0,
	    ],

        'monero' => [
            'host' => '192.168.121.12',
            'port' => '18081',
            'user' => 'icex',
            'password' => 'secure',
            'test' => false,
        ],

        'nem' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false,
        ],

        'neo' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false,
        ],

        'ethereum' => [
            'host' => '192.168.121.8',
            'port' => '8545',
            'user' => '',
            'password' => '',
            'test' => 1,
        ],

        'ethereum-classic' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false,
        ],
    ];

    /**
     * checking rpc server response
     *
     * @param $response
     */
    private function assertRpcResponseSuccess($response)
    {
        $this->assertNotFalse($response);
        if (is_array($response) && isset($response['errors'])) {
            if ($response['errors']) {
                $this->fail('error');
            }
        }
    }

	public function testNodesGetAccountAddress()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}

			$node = new $this->class_names[$node_name]($credentials);

			//eth
			$check = $node->checkNode();
			$response = $node->getAccounts();
			//$response = $node->client->getrawtransaction('fb128b353871e101fee59e4aa4d1044ecd91a1a23f130f09807bfa7fa2992c8e', 1);

			//$response = $node->getWalletBalance('1PqCKDQk332UosseXynFWXWbZjGMQHeDcr');

			//$response = $node->getWalletBalance('1Bdyw9pCsPQ9zn8QxR93KWW1ZnTFavgGx4');

			//$response = $node->client->listtransactions();

			dd($check, $response);

			$this->assertRpcResponseSuccess($response);
		}
	}
}