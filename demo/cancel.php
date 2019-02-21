<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/test.php");
$client = new AlipayClient($config);
$data = $client->trade->cancel([
    "out_trade_no"  => "1234567",
]);
var_dump($data);