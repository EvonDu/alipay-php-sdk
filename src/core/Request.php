<?php
namespace evondu\alipay\core;

/**
 * @property \evondu\alipay\core\Config $config
 */
class Request{
    /**
     * @var Config
     */
    protected $config;
    protected $method;
    protected $common;
    protected $biz_content;

    /**
     * @param $value
     */
    public function setMethod($value){
        $this->method = $value;
    }

    /**
     * RequestBuild constructor.
     * @param Config $config
     */
    public function __construct(Config $config){
        $this->config = $config;
        $this->common = [
            "app_id"        => $this->config->getAppId(),
            "charset"       => $this->config->getCharset(),
            "sign_type"     => $this->config->getSignType(),
            "timestamp"     => date("Y-m-d H:i:s"),
            "format"        => "JSON",
            "version"       => "1.0",
        ];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setCommonParam($key, $value){
        if($value != null)
            $this->common[$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setBizContent($key, $value){
        if($value != null)
            $this->biz_content[$key] = $value;
    }

    /**
     * @param array $params
     */
    public function setBizContents(Array $params){
        foreach ($params as $key => $value){
            $this->setBizContent($key, $value);
        }
    }

    /**
     * @return string
     */
    public function getBizContentString(){
        ksort($this->biz_content);
        return json_encode($this->biz_content,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $method
     * @return array
     */
    public function getRequest($method = null){
        $request = $this->common;
        if(!empty($method))
            $request["method"] = $method;
        if(!empty($this->biz_content))
            $request["biz_content"] = $this->getBizContentString();
        return $request;
    }
}