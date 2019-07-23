<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->fund->operation([
    "auth_no"       => "2019062710002001480548328172",
    "operation_id"  => "20190627419977724805",
]);

var_dump($result);
