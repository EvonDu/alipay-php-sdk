<?php
namespace evondu\alipay\core;

/**
 * @property Config $config
 */
class Sign{
    /**
     * @var Config
     */
    public $config;

    /**
     * 构造函数
     * @param Config $config
     */
    public function __construct(Config &$config){
        $this->config = $config;
    }

    /**
     * 签名方法
     * @param Config $config
     * @param $data
     * @param string $signType
     * @return string
     * @throws \Exception
     */
    public function sign($data, $signType = "RSA") {
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
     * 转换字符集编码
     * @param Config $config
     * @param $data
     * @param $targetCharset
     * @return string
     */
    public function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = $this->config->getCharset();
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }

    /**
     * 获取进行签名的内容
     * @param Config $config
     * @param $params
     * @return string
     */
    public function getSignContent($params) {
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
     * 获取签名结果字符串
     * @param Config $config
     * @param $params
     * @return string
     */
    public function getSignStr($params){
        $content = $this->getSignContent($params);
        return $this->sign($content, $this->config->getSignType());
    }
}