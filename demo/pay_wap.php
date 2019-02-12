<?php
require '../vendor/autoload.php';
require './lib/UrlHelp.php';//Demo用的URL帮助类，用于获取相对URL路径设置Notify，实际使用时不用使用

use evondu\alipay\AlipayClient;

$config = include("config/test.php");
$client = new AlipayClient($config);
$notify_url = UrlHelp::to("notify.php"); //Notify的URL
$return_url = UrlHelp::to("return.php"); //Return的URL
$client->trade->payWap([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],$notify_url,$return_url);