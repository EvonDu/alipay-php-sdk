<?php
namespace evondu\alipay;

use evondu\alipay\core\Config;
use evondu\alipay\core\Execute;
use evondu\alipay\core\Sign;
use evondu\alipay\module\Auth;
use evondu\alipay\module\Trade;
use evondu\alipay\module\Fund;

/**
 * @property \evondu\alipay\core\Config $config
 * @property \evondu\alipay\core\Sign $sign
 * @property \evondu\alipay\core\Execute $execute
 * @property \evondu\alipay\module\Auth $auth
 * @property \evondu\alipay\module\Trade $trade
 * @property \evondu\alipay\module\Fund $fund
 */
class AlipayClient{
    /**
     * @var Config $config
     * @var Sign $sign
     * @var Execute $execute
     * @var Auth $auth
     * @var Trade $trade
     * @var Fund $fund
     */
    public $config;
    public $sign;
    public $execute;
    public $auth;
    public $trade;
    public $fund;

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
        $this->fund = new Fund($this);
    }
}