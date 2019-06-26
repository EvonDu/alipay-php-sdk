<?php
namespace evondu\alipay\core;

/**
 * @property \evondu\alipay\core\Config $config
 * @property \evondu\alipay\core\sign $sign
 */
class Execute{
    public $config;
    public $sign;
    protected $alipaySdkVersion = "alipay-sdk-php-20180705";

    public function __construct(&$config, &$sign){
        $this->config = $config;
        $this->sign = $sign;
    }

    public function redirect($method, Request $build, $isSign=true){
        $params = $build->getRequest($method);
        if($isSign) $params["sign"] = $this->sign->getSignStr($params);
        $url = $this->config->getGatewayUrl() . "?" . http_build_query($params);
        header("Location: $url");
        return null;
    }

    public function get($method, Request $build, $isSign=true){
        $params = $build->getRequest($method);
        if($isSign) $params["sign"] = $this->sign->getSignStr($params);
        $url = $this->config->getGatewayUrl() . "?" . http_build_query($params);
        $result = file_get_contents($url);
        $data = json_decode($result);
        return $data;
    }

    public function url($method, Request $build, $isSign=true){
        $params = $build->getRequest($method);
        if($isSign) $params["sign"] = $this->sign->getSignStr($params);
        $url = $this->config->getGatewayUrl() . "?" . http_build_query($params);
        return $url;
    }

    public function sdkExecute($method, Request $build, $isSign=true){
        //添加参数并签名
        $params = $build->getRequest($method);
        $params["alipay_sdk"] = $this->alipaySdkVersion;
        ksort($params);
        if($isSign) $params["sign"] = $this->sign->getSignStr($params);

        //字符集转换
        foreach ($params as &$value) {
            $value = Tools::characet($value, $params['charset']);
        }

        //转码返回
        return http_build_query($params);
    }
}