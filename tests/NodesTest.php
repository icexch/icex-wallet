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
    ];

    /**
     * checking rpc server response
     *
     * @param $info
     */
    private function assertRpcResponseSuccess($info)
    {
        $this->assertNotFalse($info);
        $this->assertEmpty($info['errors']);
    }

    public function testNodesGetInfo()
    {
        foreach ($this->credentials as $node_name => $credentials) {
            if (!$credentials['test']) {
                continue;
            }
            $node = new $this->class_names[$node_name]($credentials);

            // if rpc client have error this method will return false
            $info = $node->getInfo();

            $this->assertRpcResponseSuccess($info);
        }
    }
}