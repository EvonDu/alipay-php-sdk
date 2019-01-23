<?php
namespace evondu\alipay;

class PaymentClient extends BaseClient {
    /**
     * 页面支付
     * @return mixed
     */
    public function payPage(Array $params=[], $notify_url="", $return_url=""){
        $build = new RequestBuild($this->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContents($params);
        $this->execute("alipay.trade.page.pay", $build);
    }

    /**
     * 页面支付
     * @return mixed
     */
    public function payWap(Array $params=[], $notify_url="", $return_url=""){
        $build = new RequestBuild($this->config);
        $build->setCommonParam("notify_url", $notify_url);
        $build->setCommonParam("return_url", $return_url);
        $build->setBizContent("product_code", "FAST_INSTANT_TRADE_PAY");
        $build->setBizContents($params);
        $this->execute("alipay.trade.wap.pay", $build);
    }
}