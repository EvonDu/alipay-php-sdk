<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;

header("Content-Type: text/html;charset=utf-8");
$config = include("config/me.php");
$client = new AlipayClient($config);
$userInfo = $client->auth->getUserInfo();
var_dump($userInfo);