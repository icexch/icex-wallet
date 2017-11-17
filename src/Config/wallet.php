<?php
/**
 * Created by PhpStorm.
 * User: Warchiefs
 * Date: 14.11.17
 * Time: 20:13
 */

return [
    'nodes' => [
        'bitcoin' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => ''
        ],

        'btc-cash' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => ''
        ],

        'dash' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => ''
        ],

        'monero' => [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => ''
        ],

        // etc
    ],

    'methods' => [
        'getinfo' => 'getInfo',
        'getblockchaininfo' => 'getBlockChainInfo',
        'getnetworkinfo' => 'getNetworkInfo',
        'getconnectioncount' => 'getConnectionCount',
        'getdifficulty' => 'getDifficulty',
        'getmininginfo' => 'getMiningInfo',
        'getpeerinfo' => 'getPeerInfo',
    ],
];