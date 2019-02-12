<?php
namespace evondu\alipay;

use evondu\alipay\core\Config;
use evondu\alipay\core\Execute;
use evondu\alipay\core\Sign;
use evondu\alipay\module\Auth;
use evondu\alipay\module\Trade;

/**
 * @property \evondu\alipay\core\Config $config
 * @property \evondu\alipay\core\Sign $sign
 * @property \evondu\alipay\core\Execute $execute
 * @property \evondu\alipay\module\Auth $auth
 * @property \evondu\alipay\module\Trade $trade
 */
class AlipayClient{
    /**
     * 属性
     */
    public $config;
    public $execute;
    public $trade;

    /**
     * 构造函数
     * AlipayClient constructor.
     * @param $params
     */
    public function __construct($params){
        // 初始化核心类
        $this->config = new Config($params);
        $this->sign = new Sign($this->config);
        $this->execute = new Execute($this->config, $this->sign);

        // 初始化接口模块类
        $this->auth = new Auth($this);
        $this->trade = new Trade($this);
    }
}