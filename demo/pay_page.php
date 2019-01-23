<?php
require '../vendor/autoload.php';
use evondu\alipay\PaymentClient;

$config = include("config/test.php");
$client = new PaymentClient($config);
$client->payPage([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],UrlTo("notify.php"),UrlTo("return.php"));

//Url函数
function UrlTo($path){
    return $_SERVER["SERVER_PORT"] == "80" ?
        dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])."/$path" :
        dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"])."/$path";
}