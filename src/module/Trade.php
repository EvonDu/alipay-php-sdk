<?php
namespace evondu\alipay\module;

use evondu\alipay\core\BaseModule;
use evondu\alipay\core\Request;
use evondu\alipay\lib\Parameter;

/**
 * 支付宝支付模块
 * Class Trade
 * @package evondu\alipay\module
 */
class Trade extends BaseModule {
    /**
     * alipay.trade.page.pay(统一收单下单并支付页面接口)
     * @param array $params
     * @param string $notify_url
     * @param string $return_url
     * @return null
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
        $url = $this->app->execute->url("alipay.trade.page.pay", $build);

        //返回
        return $url;
    }

    /**
     * alipay.trade.wap.pay(手机网站支付接口2.0)
     * @param array $params
     * @param string $notify_url
     * @param string $return_url
     * @return null
     */
    public function payWap(Array $params=[], $notify_url="", $return_url=""){
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
        $url = $this->app->execute->url("alipay.trade.wap.pay", $build);

        //返回
        return $url;
    }

    /**
     * alipay.trade.app.pay(app支付接口2.0)
     * @param array $params
     * @param string $notify_url
     * @param string $return_url
     * @return null
     */
    public function payApp(Array $params=[], $notify_url="", $return_url=""){
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
        $build->setBizContent("product_code", "QUICK_MSECURITY_PAY");
        $build->setBizContents($params);
        $url = $this->app->execute->url("alipay.trade.app.pay", $build);

        //返回
        return $url;
    }

    /**
     * alipay.trade.precreate(统一收单线下交易预创建)(二维码支付)
     * @param array $params
     * @param string $notify_url
     * @return null
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
        $data = $this->app->execute->get("alipay.trade.precreate", $build);

        //返回
        if(isset($data->alipay_trade_precreate_response))
            return $data->alipay_trade_precreate_response;
        else
            return null;
    }

    /**
     * alipay.trade.query(统一收单线下交易查询)
     * @param array $params
     * @return null
     */
    public function query(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no']
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.query", $build);

        //判断并返回
        if(isset($data->alipay_trade_query_response))
            return $data->alipay_trade_query_response;
        else
            return null;
    }

    /**
     * alipay.trade.close(统一收单交易关闭接口)
     * @param array $params
     * @return mixed
     */
    public function close(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no']
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.close", $build);

        //判断并返回
        if(isset($data->alipay_trade_close_response))
            return $data->alipay_trade_close_response;
        else
            return null;
    }

    /**
     * alipay.trade.cancel(统一收单交易撤销接口)
     * @param array $params
     * @return null
     */
    public function cancel(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no']
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.cancel", $build);

        //判断并返回
        if(isset($data->alipay_trade_cancel_response))
            return $data->alipay_trade_cancel_response;
        else
            return null;
    }

    /**
     * alipay.trade.refund(统一收单交易退款接口)
     * @param array $params
     * @return null
     */
    public function refund(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no'],
            "refund_amount",
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.refund", $build);

        //判断并返回
        if(isset($data->alipay_trade_refund_response))
            return $data->alipay_trade_refund_response;
        else
            return null;
    }

    /**
     * alipay.trade.fastpay.refund.query(统一收单交易退款查询)
     * @param array $params
     * @return mixed
     */
    public function refundQuery(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['out_trade_no', 'trade_no'],
            ['out_request_no']
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.fastpay.refund.query", $build);

        //判断并返回
        if(isset($data->alipay_trade_fastpay_refund_query_response))
            return $data->alipay_trade_fastpay_refund_query_response;
        else
            return null;
    }

    /**
     * alipay.trade.order.settle(统一收单交易结算接口)
     * @param array $params
     * @return mixed
     */
    public function orderSettle(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_trade_no',
            'trade_no',
            'royalty_parameters'
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.order.settle", $build);

        //判断并返回
        if(isset($data->alipay_trade_order_settle_response))
            return $data->alipay_trade_order_settle_response;
        else
            return null;
    }
}