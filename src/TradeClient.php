<?php
namespace evondu\alipay;

use evondu\alipay\lib\Parameter;
use evondu\alipay\core\Request;

/**
 * @property AlipayClient $app
 */
class TradeClient{
    private $app;

    public function __construct(&$app)
    {
        $this->app = $app;
    }

    /**
     * 页面支付
     * @return mixed
     */
    public function payPage(Array $params=[], $notify_url="", $return_url=""){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_trade_no',
            'total_amount',
            'subject',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "FAST_INSTANT_TRADE_PAY");
        $build->setBizContents($params);
        $this->execute("alipay.trade.page.pay", $build);
    }

    /**
     * 手机支付
     * @return mixed
     */
    public function payWap(Array $params=[], $notify_url="", $return_url=""){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_trade_no',
            'total_amount',
            'subject',
        ]);

        //执行调用
        $build = new Request($this->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "FAST_INSTANT_TRADE_PAY");
        $build->setBizContents($params);
        $this->execute("alipay.trade.wap.pay", $build);
    }

    /**
     * 线下交易预创建(二维码支付)
     * @param array $params
     * @param string $notify_url
     */
    public function precreate(Array $params=[], $notify_url=""){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_trade_no',
            'total_amount',
            'subject',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setBizContents($params);
        var_dump($build->getRequest());
        //$this->execute("alipay.trade.precreate", $build);
    }

    /**
     * 订单查询
     * @param array $params
     */
    public function query(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no ']
        ]);

        //执行调用
        $build = new Request($this->config);
        $build->setBizContents($params);
        $this->execute("alipay.trade.query", $build);
    }
}