<?php
require '../vendor/autoload.php';

use evondu\alipay\AlipayClient;
use evondu\alipay\module\Auth;

header("Content-Type: text/html;charset=utf-8");
$config = include("config/me.php");
$client = new AlipayClient($config);
$client->auth->oauth(Auth::SCOPE_USER);
$info = $client->auth->getUserInfo();
var_dump($info);