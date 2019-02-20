<?php
namespace evondu\alipay\module;

use evondu\alipay\core\BaseModule;
use evondu\alipay\core\Request;
use evondu\alipay\lib\Parameter;

class Trade extends BaseModule {
    /**
     * 页面支付
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
        $this->app->execute->redirect("alipay.trade.page.pay", $build);

        //返回
        return null;
    }

    /**
     * 手机支付
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
        $this->app->execute->redirect("alipay.trade.wap.pay", $build);

        //返回
        return null;
    }

    /**
     * 线下交易预创建(二维码支付)
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
        $this->app->execute->redirect("alipay.trade.precreate", $build);

        //返回
        return null;
    }

    /**
     * 订单查询
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
     * 订单退款
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
     * 退款查询
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
     * 退款查询
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
}