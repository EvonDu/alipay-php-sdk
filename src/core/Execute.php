<?php
namespace evondu\alipay\core;

/**
 * @property \evondu\alipay\core\Config $config
 * @property \evondu\alipay\core\sign $sign
 */
class Execute{
    public $config;
    public $sign;

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
}