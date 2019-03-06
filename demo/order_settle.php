<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("config/test.php");
$client = new AlipayClient($config);
$data = $client->trade->orderSettle([
    "out_trade_no"  => "1551864494",
    "trade_no" => "2019030622001429590501112145",
    "royalty_parameters" => [
        [
            "trans_out" => "2088102177350978",  //支付宝的UID
            "trans_in" => "2088102177350978",   //支付宝的UID
            "amount_percentage" => 100,         //只支持100
            "amount" => "0.01",
            "desc" => "分账描述"
        ]
    ]
]);
var_dump($data);