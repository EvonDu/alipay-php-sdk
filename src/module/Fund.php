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
class Fund extends BaseModule {
    //alipay.fund.auth.order.app.freeze(线上资金授权冻结接口)
    public function freeze(Array $params=[], $notify_url=""){
        //参数判断
        Parameter::checkRequire($params ,[
            'out_order_no',
            'out_request_no',
            'order_title',
            'amount',
            'product_code',
            ["payee_user_id","payee_logon_id"],
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setBizContents($params);
        $url = $this->app->execute->sdkExecute("alipay.fund.auth.order.app.freeze", $build);

        //返回
        return $url;
    }

    //alipay.fund.auth.order.unfreeze(资金授权解冻)
    public function unfreeze(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            'auth_no',
            'out_request_no',
            'remark',
            'amount',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $result = $this->app->execute->get("alipay.fund.auth.order.unfreeze", $build);

        //返回结果
        if(isset($result->alipay_fund_auth_order_unfreeze_response))
            return $result->alipay_fund_auth_order_unfreeze_response;
        else
            return null;
    }

    //alipay.trade.pay(授权转支付)
    public function pay(Array $params=[], $return_url){
        //参数判断
        Parameter::checkRequire($params ,[
            'auth_no',                  //授权号
            'out_trade_no',             //商户订单号
            'body',                     //支付说明
            'subject',                  //剩余资金解冻说明
            'buyer_id',                 //买家用户ID(通过预授权冻结接口返回的payer_user_id字段获取)
            'seller_id',                //卖家用户ID(通过预授权冻结接口返回的payee_user_id字段获取)
            'total_amount',             //总支付金额
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "PRE_AUTH_ONLINE");
        $build->setBizContent("auth_confirm_mode", "COMPLETE");
        $build->setBizContents($params);
        $result = $this->app->execute->get("alipay.trade.pay", $build);

        //返回结果
        if(isset($result->alipay_trade_pay_response))
            return $result->alipay_trade_pay_response;
        else
            return null;
    }

    //alipay.fund.auth.operation.detail.query(资金授权操作查询)
    public function operation(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['auth_no', 'out_request_no'],
            ['operation_id', 'out_request_no ']
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $result = $this->app->execute->get("alipay.fund.auth.operation.detail.query", $build);

        //返回结果
        if(isset($result->alipay_fund_auth_operation_detail_query_response))
            return $result->alipay_fund_auth_operation_detail_query_response;
        else
            return null;
    }

    //alipay.fund.auth.operation.cancel(资金授权撤销接口)
    public function cancel(Array $params=[]){
        //参数判断
        Parameter::checkRequire($params ,[
            ['auth_no', 'out_request_no'],
            ['operation_id', 'out_request_no '],
            'remark',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $result = $this->app->execute->get("alipay.fund.auth.operation.cancel", $build);

        //返回结果
        if(isset($result->alipay_fund_auth_operation_cancel_response))
            return $result->alipay_fund_auth_operation_cancel_response;
        else
            return null;
    }
}