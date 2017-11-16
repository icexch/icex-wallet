<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 16:11
 */

use Icex\IcexWallet\Containers\Nodes\Bitcoin;
use PHPUnit\Framework\TestCase;


class NodesTest extends TestCase
{
    public function testBitcoinGetInfoTest()
    {
        // fill your credentials
        $credentials = [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => ''
        ];

        $node = new Bitcoin($credentials);

        $info = $node->getInfo();

        // if rpc client have error this method will return false
        $this->assertNotFalse($info);
        $this->assertEmpty($info['error']);
    }
}