<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->fund->cancel([
    "auth_no"       => "2019062710002001480548444438",
    "operation_id"  => "20190627423203374805",
    'remark'        => "撤销测试",
]);

var_dump($result);
