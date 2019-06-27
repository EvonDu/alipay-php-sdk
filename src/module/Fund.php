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
            'order_title',
            'remark',
        ]);

        //执行调用
        $build = new Request($this->app->config);
        $build->setBizContents($params);
        $url = $this->app->execute->get("alipay.fund.auth.order.unfreeze", $build);

        //返回
        return $url;
    }
}