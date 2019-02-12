<?php
namespace evondu\alipay\core;

/**
 * @property \evondu\alipay\AlipayClient $app
 */
class BaseModule{
    /**
     * @var
     */
    protected $app;

    /**
     * 构造函数
     * Trade constructor.
     * @param $app
     */
    public function __construct(&$app){
        $this->app = $app;
    }
}