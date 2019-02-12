<?php
namespace evondu\alipay\core;

class Config{
    /**
     * 属性
     */
    protected $app_id;
    protected $merchant_private_key;
    protected $alipay_public_key;
    protected $charset                  = "UTF-8";
    protected $sign_type                = "RSA2";
    protected $gatewayUrl               = "https://openapi.alipay.com/gateway.do";

    /**
     * Request constructor.
     * @param $params
     */
    public function __construct($params){
        $this->app_id = isset($params['app_id']) ? $params['app_id'] : $this->app_id;
        $this->merchant_private_key = isset($params['merchant_private_key']) ? $params['merchant_private_key'] : $this->merchant_private_key;
        $this->alipay_public_key = isset($params['alipay_public_key']) ? $params['alipay_public_key'] : $this->alipay_public_key;
        $this->charset = isset($params['charset']) ? $params['charset'] : $this->charset;
        $this->sign_type = isset($params['sign_type']) ? $params['sign_type'] : $this->sign_type;
        $this->gatewayUrl = isset($params['gatewayUrl']) ? $params['gatewayUrl'] : $this->gatewayUrl;
    }

    /**
     * @return mixed
     */
    public function getAppId(){
        return $this->app_id;
   }

    /**
     * @param $vluae
     */
    public function setAppId($vluae){
       $this->app_id = $vluae;
   }

    /**
     * @return mixed
     */
    public function getMerchantPrivateKey(){
        return $this->merchant_private_key;
    }

    /**
     * @param $vluae
     */
    public function setMerchantPrivateKey($vluae){
        $this->merchant_private_key = $vluae;
    }

    /**
     * @return mixed
     */
    public function getAlipayPublicKey(){
        return $this->alipay_public_key;
    }

    /**
     * @param $vluae
     */
    public function setAlipayPublicKey($vluae){
        $this->alipay_public_key = $vluae;
    }

    /**
     * @return string
     */
    public function getCharset(){
        return $this->charset;
    }

    /**
     * @param $vluae
     */
    public function setCharset($vluae){
        $this->charset = $vluae;
    }

    /**
     * @return string
     */
    public function getSignType(){
        return $this->sign_type;
    }

    /**
     * @param $vluae
     */
    public function setSignType($vluae){
        $this->sign_type = $vluae;
    }

    /**
     * @return string
     */
    public function getGatewayUrl(){
        return $this->gatewayUrl;
    }

    /**
     * @param $vluae
     */
    public function setGatewayUrl($vluae){
        $this->gatewayUrl = $vluae;
    }
}