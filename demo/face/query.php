<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->face->query(["ftoken" => "fp0043186881629d204224d7003cad9e18a",]);

var_dump($result);