<?php
require '../../vendor/autoload.php';

use evondu\alipay\AlipayClient;
use evondu\alipay\lib\Url;

$config = include("../config/qiyi.php");
$client = new AlipayClient($config);
$time = time();
$notify_url = Url::to("notify.php");
$str = $client->fund->freeze([
    "out_order_no"      => $time,
    "out_request_no"    => $time,
    "order_title"       => "可口可乐",
    "amount"            => 0.01,
    "payee_logon_id"    => "chen@people71.com"
],$notify_url);

//echo $str;
//print_r($str);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
</head>
<body>
    <button id="J_btn" class="btn btn-default">支付</button>
</body>
</html>
<script>
    var btn = document.querySelector('#J_btn');
    var orderStr = "<?=$str?>";
    console.log(orderStr);
    btn.addEventListener('click', function(){
        ap.tradePay({
            orderStr: orderStr
        }, function(res){
            ap.alert(res.resultCode);
        });
    });
</script>
