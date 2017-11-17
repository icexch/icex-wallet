<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 16:11
 */

use Icex\IcexWallet\Containers\Nodes\Bitcoin;
use Icex\IcexWallet\Containers\Nodes\BtcCash;
use Icex\IcexWallet\Containers\Nodes\Dash;
use Icex\IcexWallet\Containers\Nodes\Monero;
use PHPUnit\Framework\TestCase;


class NodesTest extends TestCase
{
    private $class_names = [
        'bitcoin' => Bitcoin::class,
        'btc-cash' => BtcCash::class,
        'dash' => Dash::class,
        'monero' => Monero::class,
    ];

    // fill your credentials
    // test key - for on or off testing node
    private $credentials = [
        'bitcoin' => [
            'host' => '192.168.121.2',
            'port' => '8332',
            'user' => 'icexwlbitcoin',
            'password' => 'wnhrELWXQZRh5NPSjbprJFeJFE7ZkT',
            'test' => true,
        ],

        'btc-cash' => [
            'host' => '192.168.121.10',
            'port' => '8332',
            'user' => 'bitcoin',
            'password' => 'password',
            'test' => true
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
}