<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/test.php");
$client = new AlipayClient($config);
$data = $client->trade->refundQuery([
    "out_trade_no"  => "1234567",
    "out_request_no" => "1234567"
]);
var_dump($data);