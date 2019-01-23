<?php
require '../vendor/autoload.php';
use evondu\alipay\AuthClient;

header("Content-Type: text/html;charset=utf-8");
$config = include("config/test.php");
$client = new AuthClient($config);
$userInfo = $client->getUserInfo();
var_dump($userInfo);