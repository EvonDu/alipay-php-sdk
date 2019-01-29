<?php
require '../vendor/autoload.php';
use evondu\alipay\TradeClient;

$config = include("config/test.php");
$client = new TradeClient($config);
$client->query([
    "out_trade_no"  => "1234567",
]);