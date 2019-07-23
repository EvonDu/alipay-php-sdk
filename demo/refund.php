<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/demo.php");
$client = new AlipayClient($config);
$data = $client->trade->refund([
    "out_trade_no"  => "1234567",
    "refund_amount" => 0.01
]);
var_dump($data);