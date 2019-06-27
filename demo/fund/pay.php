<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;
use evondu\alipay\lib\Url;

$config = include("../config/qiyi.php");
$client = new AlipayClient($config);
$time = time();
$notify_url = Url::to("notify.php");
$result = $client->fund->pay([
    "auth_no"           => "2019062710002001480548328172",
    "out_trade_no"      => $time,
    "body"              => "预授权金额交易",
    "subject"           => "预授权金额交易",
    "buyer_id"          => "2088502478066482",
    "seller_id"         => "2088131541502701",
    "total_amount"      => "0.01",
],$notify_url);

var_dump($result);
?>