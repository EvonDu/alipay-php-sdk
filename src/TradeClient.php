<?php
namespace evondu\alipay;

class TradeClient extends BaseClient {
    /**
     * 页面支付
     * @return mixed
     */
    public function payPage(Array $params=[], $notify_url="", $return_url=""){
        //参数判断
        RequestParams::checkRequire($params ,[
            'out_trade_no',
            'total_amount',
            'subject',
        ]);

        //执行调用
        $build = new RequestBuild($this->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "FAST_INSTANT_TRADE_PAY");
        $build->setBizContents($params);
        $this->execute("alipay.trade.page.pay", $build);
    }

    /**
     * 页面支付
     * @return mixed
     */
    public function payWap(Array $params=[], $notify_url="", $return_url=""){
        //参数判断
        RequestParams::checkRequire($params ,[
            'out_trade_no',
            'total_amount',
            'subject',
        ]);

        //执行调用
        $build = new RequestBuild($this->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "FAST_INSTANT_TRADE_PAY");
        $build->setBizContents($params);
        $this->execute("alipay.trade.wap.pay", $build);
    }


    public function query(Array $params=[]){
        //参数判断
        RequestParams::checkRequire($params ,[
            ['out_trade_no', 'trade_no ']
        ]);

        //执行调用
        $build = new RequestBuild($this->config);
        $build->setBizContents($params);
        $this->execute("alipay.trade.query", $build);
    }
}