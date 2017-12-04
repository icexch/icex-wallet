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
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false,
        ],

        'btc-cash' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false
        ],

        'dash' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'test' => false,
        ],

        'monero' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
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
            'test' => false,
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
	/*
    public function testNodesGetBlockChainInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getBlockChainInfo();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getInfo();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetNetworkInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getNetworkInfo();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetConnectionCount()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getConnectionCount();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetDifficulty()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getDifficulty();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetMiningInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getMiningInfo();

            $this->assertRpcResponseSuccess($response);
        }
    }

    public function testNodesGetPeerInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            $response = $node->getPeerInfo();

            $this->assertRpcResponseSuccess($response);
        }
    }

	public function testNodesCreateAccount()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->createAccount();

			$this->assertRpcResponseSuccess($response);
		}
	}

	public function testNodesSend()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->send(['test_account', 'test_account1', 1]);

			$this->assertRpcResponseSuccess($response);
		}
	}

	public function testNodesGetAccount()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$new_address = $node->createAccount();

			$response = $node->getAccount([$new_address]);

			$this->assertRpcResponseSuccess($response);
		}
	}
	*/
	public function testNodesGetAccountAddress()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->getWalletBalance('1DdSXmfRMFQzYeeaLGntwdhJ48tbTvVh16');


			$this->assertRpcResponseSuccess($response);
		}
	}
	/*
	public function testNodesGetBalance()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->getBalance();

			$this->assertRpcResponseSuccess($response);
		}
	}

	public function testNodesCoinHistory()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->coinHistory();

			$this->assertRpcResponseSuccess($response);
		}
	}

	public function testNodesSign()
	{
		foreach ($this->credentials as $node_name => $credentials) {
			if (!$credentials['test']) {
				continue;
			}
			$node = new $this->class_names[$node_name]($credentials);

			$response = $node->sign(['hexstring']);

			$this->assertRpcResponseSuccess($response);
		}
	}

	public function testCrossRate()
	{
		$carbon = new \Carbon\Carbon();
		$guzzle = new \GuzzleHttp\Client();
		$icex = new \Icex\IcexWallet\Models\IcexAPIClient($guzzle);

		$cross_rate = (new \Icex\IcexWallet\Containers\ConversionContainer($carbon, $icex))->cross_rate('BTC', 'EUR');

		$this->assertTrue($cross_rate);
	}*/
}