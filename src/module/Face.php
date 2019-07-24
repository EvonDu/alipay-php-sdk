<?php
namespace evondu\alipay\module;

use evondu\alipay\core\Request;
use evondu\alipay\core\BaseModule;
use evondu\alipay\lib\Parameter;

/**
 * 支付宝资金(预授权模块)
 * Class Fund
 * @package evondu\alipay\module
 */
class Face extends BaseModule {
    //zoloz.authentication.customer.smilepay.initialize(人脸初始化唤起zim)
    public function initialize(Array $params=[], $notify_url=""){
        //参数判断
        Parameter::checkRequire($params ,[
            'zimmetainfo',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $data = $this->app->execute->get("zoloz.authentication.customer.smilepay.initialize", $build);

        //返回
        if(isset($data->zoloz_authentication_customer_smilepay_initialize_response))
            return $data->zoloz_authentication_customer_smilepay_initialize_response;
        else
            return null;
    }

    //alipay.trade.pay(统一收单交易支付接口[人脸])
    public function pay(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_trade_no',
            'auth_code',
            'subject',
            'total_amount',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContent("scene", "security_code");
        $build->setBizContent("timeout_express", "5m");
        $build->setBizContents($params);
        $data = $this->app->execute->get("alipay.trade.pay", $build);

        //返回
        if(isset($data->alipay_trade_pay_response))
            return $data->alipay_trade_pay_response;
        else
            return null;
    }

    //zoloz.authentication.customer.ftoken.query(人脸ftoken查询消费接口)
    public function query(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            'ftoken',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContent("biz_type", 1);
        $build->setBizContents($params);
        $data = $this->app->execute->get("zoloz.authentication.customer.ftoken.query", $build);

        //返回
        if(isset($data->zoloz_authentication_customer_ftoken_query_response))
            return $data->zoloz_authentication_customer_ftoken_query_response;
        else
            return null;
    }
}