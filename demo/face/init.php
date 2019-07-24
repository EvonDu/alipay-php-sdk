<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;

$config = include("../config/demo.php");
$client = new AlipayClient($config);
$result = $client->face->initialize([
    "zimmetainfo" => '{"apdidToken":"MbLQ_45P9SUByswW9DFq31DcL1v-r8r18qxiXvTJMcBR7tAcbAEAAA==","appName":"com.alipay.zoloz.smile","appVersion":"3.10.0.346","bioMetaInfo":"4.2.0:287358976,2","deviceModel":"rk3288","deviceType":"android","machineInfo":{"cameraDriveVer":"","cameraModel":"AstraP1","cameraName":"AstraP1","cameraVer":"","ext":"","group":"","machineCode":"XPx6N2y57fMDACi/mSXUc9LR","machineModel":"rk3288","machineVer":"5.1.1"},"merchantInfo":{"alipayStoreCode":"TEST","appId":"2018061260352252","areaCode":"TEST","brandCode":"TEST","deviceMac":"TEST","deviceNum":"TEST_ZOLOZ_TEST","geo":"0.000000,0.000000","merchantId":"2088131541502701","partnerId":"2088131541502701","storeCode":"TEST","wifiMac":"TEST","wifiName":"TEST"},"osVersion":"5.1.1","remoteLogID":"3b9ee91c1e794070a9a1bf9b60cce0611752387705","zimVer":"1.0.0"}',
]);

var_dump($result);
echo $result->result;
