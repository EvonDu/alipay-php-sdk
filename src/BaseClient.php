<?php
namespace evondu\alipay;

/**
 * @property Config $config
 */
class BaseClient{
    /**
     * 属性
     */
    protected $config;

    /**
     * 构造函数
     * AlipayClient constructor.
     * @param $params
     */
    public function __construct($params){
        $this->config = new Config($params);
    }

    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    protected function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = $this->config->getCharset();
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }

    /**
     * 签名方法
     * @param array $params
     * @param string $signType
     * @return string
     * @throws \Exception
     */
    protected function sign($data, $signType = "RSA") {
        $priKey=$this->config->getMerchantPrivateKey();
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($priKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";

        if(!$res)
            throw new \Exception('您使用的私钥格式错误，请检查RSA私钥配置');

        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($data, $sign, $res);
        }

        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * 获取签名用字符串
     * @param $params
     * @return string
     */
    protected function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (!empty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->config->getCharset());
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }

    /**
     * 执行接口
     * @param array $params
     * @return null
     */
    protected function execute($method, RequestBuild $build){
        $params = $build->getRequest($method);
        $params["sign"] = $this->sign($this->getSignContent($params),$this->config->getSignType());
        $url = $this->config->getGatewayUrl() . "?" . http_build_query($params);
        header("Location: $url");
        return null;
    }
}