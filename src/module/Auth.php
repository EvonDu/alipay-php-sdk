<?php
namespace evondu\alipay\module;

use evondu\alipay\core\BaseModule;
use evondu\alipay\core\Request;

class Auth extends BaseModule {
    /**
     * 常量
     */
    const SCOPE_BASE = "auth_base";
    const SCOPE_USER = "auth_user";

    /**
     * 进行授权
     * @param string $scope
     * @return int|string
     */
    protected function oauth($scope = self::SCOPE_BASE){
        if(!isset($_GET["auth_code"]))
            return $this->toAuth($this->getCurrentUrl(), $scope);
        else{
            return $this->getToken();
        }
    }

    /**
     * 前往授权获取auth_code
     * @param $redirect_uri
     * @return string
     */
    protected function toAuth($redirect_uri, $scope = self::SCOPE_BASE){
        $url = "https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=".$this->app->config->getAppId()."&scope=$scope&redirect_uri=$redirect_uri";
        header("Location: $url");
        die;
    }

    /**
     * 获取当前URL
     * @return string
     */
    protected function getCurrentUrl(){
        return $_SERVER["SERVER_PORT"] == "80" ?
            $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] :
            $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    }

    /**
     * 使用auth_code换取access_token和user_id
     * @return int
     * @throws \Exception
     */
    public function getToken(){
        if(!isset($_GET["auth_code"]))
            throw new \Exception("请先进行授权，获取auth_code");

        $build = new Request($this->app->config);
        $build->setCommonParam("grant_type","authorization_code");
        $build->setCommonParam("code",$_GET["auth_code"]);
        $data = $this->app->execute->get("alipay.system.oauth.token",$build);
        if(!isset($data->alipay_system_oauth_token_response))
            throw new \Exception("获取access_token失败");

        return $data->alipay_system_oauth_token_response;
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo(){
        $access_token = $this->getAccessToken(self::SCOPE_USER);
        $build = new Request($this->app->config);
        $build->setCommonParam("auth_token",$access_token);
        $result = $this->app->execute->get("alipay.user.info.share", $build);

        if(isset($result->alipay_user_info_share_response))
            return $result->alipay_user_info_share_response;
        else
            return false;
    }

    /**
     * 获取access_token
     * @return mixed
     */
    public function getAccessToken($scope = self::SCOPE_BASE){
        return $this->oauth($scope)->access_token;
    }

    /**
     * 获取user_id
     * @return mixed
     */
    public function getUserId($scope = self::SCOPE_BASE){
        return $this->oauth($scope)->user_id;
    }
}