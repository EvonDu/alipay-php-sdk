<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->fund->unfreeze([
    "auth_no"           => "2019070410002001480556497569",
    "out_request_no"    => "1561536353",
    "remark"            => "交易取消",
    "amount"            => 0.01,
]);

var_dump($result);
