# 支付宝支付SDK简化版
该项目依据蚂蚁金服的[API接口文档](https://docs.open.alipay.com/api)重构支付宝的PHP-SDK，项目剥离原本官方SDK带的PHP框架和众多沉余代码，可以在项目中利用Composer简单的引入和使用，并适用于现在的各大PHP框架。

# 安装方法
`$ composer require evondu/alipay-php-sdk`

# 简单示例
这里以网页支付为例，只用必填参数做调用（选填参数请参考[官方文档](https://docs.open.alipay.com/api_1/alipay.trade.page.pay)）
```
//引入Composer自动加载(例如YII等PHP框架则不需要，因为框架本身已经引入)
require './vendor/autoload.php';
//引入类名空间
use evondu\alipay\AlipayClient;
// 初始化客户端
$client = new AlipayClient([
    'app_id' => "2017051207218***",                             //应用ID
    'merchant_private_key' => "***",                            //应用私钥
    'alipay_public_key' => "***",                               //支付宝公钥
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",    //沙盒环境时使用，正式环境去掉即可
]);
// 调用接口:alipay.trade.page.pay
$client->trade->payPage([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],"支付通知地址(notify_url)","支付返回地址(return_url)");
```

# API
### 手机网站支付接口（alipay.trade.wap.pay）
```
$client->trade->payWap([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],"支付通知地址(notify_url)","支付返回地址(return_url)");
```

### 统一收单线下交易预创建（alipay.trade.precreate）
```
$data = $client->trade->precreate([
    "out_trade_no"  => time(),
    "total_amount"  => "0.01",
    "subject"       => "标题",
    "body"          => "支付内容",
],"支付通知地址(notify_url)");
```

### 统一收单线下交易查询（alipay.trade.query）
```
$data = $client->trade->query([
    "out_trade_no"  => "1234567",
]);
```

### 统一收单交易关闭接口（alipay.trade.close）
```
$data = $client->trade->close([
    "out_trade_no"  => "1234567",
]);
```

### 统一收单交易撤销接口（alipay.trade.cancel）
```
$data = $client->trade->cancel([
    "out_trade_no"  => "1234567",
]);
```

### 统一收单交易退款接口（alipay.trade.refund）
```
$data = $client->trade->refund([
    "out_trade_no"  => "1234567",
    "refund_amount" => 0.01
]);
```

### 统一收单交易退款查询（alipay.trade.fastpay.refund.query）
```
$data = $client->trade->refundQuery([
    "out_trade_no"  => "1234567",
    "out_request_no" => "1234567"
]);
```