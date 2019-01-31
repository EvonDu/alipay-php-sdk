<?php
namespace evondu\alipay;

class AuthClient extends BaseClient {
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
        $url = "https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=".$this->config->getAppId()."&scope=$scope&redirect_uri=$redirect_uri";
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

        $build = new RequestBuild($this->config);
        $build->setCommonParam("grant_type","authorization_code");
        $build->setCommonParam("code",$_GET["auth_code"]);
        $params = $build->getRequest("alipay.system.oauth.token");
        $result = $this->curl($params);
        if(!isset($result->alipay_system_oauth_token_response))
            throw new \Exception("获取access_token失败");

        return $result->alipay_system_oauth_token_response;
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

    /**
     * 获取用户信息
     */
    public function getUserInfo(){
        $access_token = $this->getAccessToken(self::SCOPE_USER);
        $build = new RequestBuild($this->config);
        $build->setCommonParam("auth_token",$access_token);
        $params = $build->getRequest("alipay.user.info.share");
        $result = $this->curl($params);

        if(isset($result->alipay_user_info_share_response))
            return $result->alipay_user_info_share_response;
        else
            return false;
    }
}