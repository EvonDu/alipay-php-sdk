<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;
use evondu\alipay\lib\Url;

$config = include("config/test.php");
$client = new AlipayClient($config);
$notify_url = Url::to("notify.php"); //Notify的URL
$data = $client->trade->precreate([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],$notify_url);
var_dump($data);
?>
<img src="http://qr.liantu.com/api.php?text=<?=$data->qr_code?>"/>
