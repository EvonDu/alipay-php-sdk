<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->face->pay([
    "out_trade_no"  => uniqid(),
    "auth_code"     => "fp0043186881629d204224d7003cad9e18a",
    "subject"       => "可口可乐",
    "total_amount"  => "0.01",
]);

var_dump($result);