<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/demo.php");
$client = new AlipayClient($config);
$data = $client->trade->close([
    "out_trade_no"  => "1234567",
]);
var_dump($data);