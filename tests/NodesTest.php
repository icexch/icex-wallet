<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 16:11
 */

use Icex\IcexWallet\Containers\Nodes\Bitcoin;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class NodesTest extends TestCase
{
    public function testBitcoinGetInfoTest()
    {
        $node = new Bitcoin;

        $this->assertNotFalse($node->getInfo());
    }
}