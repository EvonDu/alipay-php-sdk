<?php
namespace evondu\alipay\module;

use evondu\alipay\core\BaseModule;
use evondu\alipay\core\Request;
use evondu\alipay\lib\Url;

class Auth extends BaseModule {
    /**
     * @const string SCOPE_BASE
     * @const string SCOPE_USER
     */
    const SCOPE_BASE = "auth_base";
    const SCOPE_USER = "auth_user";

    /**
     * @var string|null $user_id
     * @var string|null $access_token
     */
    public $user_id;
    public $access_token;

    /**
     * 进行授权
     * @param string $scope
     * @return int|string
     */
    public function oauth($scope = self::SCOPE_BASE){
        if(!isset($_GET["auth_code"]))
            return $this->toAuth(Url::current(), $scope);
        else{
            $response = $this->requestAccessToken($_GET["auth_code"]);
            $this->user_id = $response->user_id;
            $this->access_token = $response->access_token;
        }
    }

    /**
     * 使用auth_code换取access_token和user_id
     * @return int
     * @throws \Exception
     */
    public function requestAccessToken($auth_code){
        $build = new Request($this->app->config);
        $build->setCommonParam("grant_type","authorization_code");
        $build->setCommonParam("code",$auth_code);
        $data = $this->app->execute->get("alipay.system.oauth.token",$build);
        if(!isset($data->alipay_system_oauth_token_response))
            throw new \Exception("获取access_token失败");

        return $data->alipay_system_oauth_token_response;
    }

    /**
     * 获取user_id
     * @return mixed
     */
    public function getUserId(){
        return $this->user_id;
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo(){
        //判断认证
        if(empty($this->user_id) || empty($this->access_token))
            throw new \Exception("请先进行认证");

        //调用接口
        $build = new Request($this->app->config);
        $build->setCommonParam("auth_token",$this->access_token);
        $result = $this->app->execute->get("alipay.user.info.share", $build);

        //返回
        if(isset($result->alipay_user_info_share_response))
            return $result->alipay_user_info_share_response;
        else
            return false;
    }

    /**
     * 获取access_token
     * @return mixed
     */
    public function getAccessToken(){
        return $this->access_token;
    }

    /**
     * 获取认证地址
     * @param $redirectUrl
     * @param string $scope
     * @return string
     */
    public function getAuthUrl($redirect_uri, $scope = self::SCOPE_BASE){
        $url = "https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=".$this->app->config->getAppId()."&scope=$scope&redirect_uri=$redirect_uri";
        return $url;
    }

    /**
     * 前往授权获取auth_code
     * @param $redirect_uri
     * @return string
     */
    protected function toAuth($redirect_uri, $scope = self::SCOPE_BASE){
        $url = $this->getAuthUrl($redirect_uri, $scope);
        header("Location: $url");
        die;
    }
}