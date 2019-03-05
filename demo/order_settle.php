<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/test.php");
$client = new AlipayClient($config);
$data = $client->trade->orderSettle([
    "out_trade_no"  => "1551769891",
    "trade_no" => "2019030522001429590501111828",
    "royalty_parameters" => [
        [
            "trans_out" => "2016092600600686",
            "trans_in" => "2016092600600686",
            "amount" => "0.01",
            "amount_percentage" => "10",
            "desc" => "分账描述"
        ]
    ]
]);
var_dump($data);