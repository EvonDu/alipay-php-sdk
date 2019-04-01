<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;
use evondu\alipay\lib\Url;

$config = include("config/test.php");
$client = new AlipayClient($config);
$notify_url = Url::to("notify.php"); //Notify的URL
$return_url = Url::to("return.php"); //Return的URL
$url = $client->trade->payApp([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],$notify_url,$return_url);

header("Location: $url");