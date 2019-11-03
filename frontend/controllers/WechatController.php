<?php


namespace frontend\controllers;


class WechatController
{


    public static $config = [
        'appid' => '',
        'appsecret' => '',
        'redirect_uri' => '',
    ];

    /**
     * Wechat constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        self::$config = $config;
    }

    /**
     * 自动登录
     */
    public function autoLogin()
    {
        if (!empty($_REQUEST['code'])) {
//            log('code已获得', __LINE__);
            $this->getToken();
            if (!$this->checkToken()) {
                $this->refreshToken();
            }

            return $this->getUserInfo();
        } else {
            $this->getCode();
        }
    }

    /**
     * 微信auth2.0 授权
     * @param string $redirect_uri 授权后返回url
     * @param string $scope 应用授权作用域
     * snsapi_base 不弹出授权页面，直接跳转，只能获取用户openid
     * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、地区。并且，未关注的情况下，只要用户授权，也能获取其信息）
     */
    private function getCode()
    {
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?";
        $queryArr = [
            'appid' => self::$config['appid'],
            'redirect_uri' => self::$config['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'snsapi_userinfo',
            'state' => 'getcode',
        ];
        $url .= http_build_query($queryArr);
        $url .= '#wechat_redirect';
        header('Location:' . $url);
        die;
    }

    /**
     * 通过code换取临时access_token
     */
    private function getToken()
    {
        if ($_REQUEST['code']) {
            $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?';
            $queryArr = [
                'appid' => self::$config['appid'],
                'secret' => self::$config['appsecret'],
                'code' => $_REQUEST['code'],
                'grant_type' => 'authorization_code',
            ];
            $url .= http_build_query($queryArr);
            $res = file_get_contents($url);
            $data = json_decode($res, true);


            if ($data['access_token']) {
                self::$config['access_token'] = $data['access_token'];
                self::$config['openid'] = $data['openid'];
                self::$config['refresh_token'] = $data['refresh_token'];
                return self::$config['access_token'];
            } else {
                return false;
            }
        } else {
            $this->getCode();
        }
    }

    /**
     * 验证临时access_token有效性
     */
    private function checkToken()
    {
        if (self::$config['access_token'] && self::$config['openid']) {
            $url = 'https://api.weixin.qq.com/sns/auth?';
            $queryArr = [
                'access_token' => self::$config['token'],
                'openid' => self::$config['openid'],
            ];
            $url .= http_build_query($queryArr);
            $res = file_get_contents($url);
            $data = json_decode($res, true);

            if ($data['errcode'] == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*
     * 刷新临时access_token
     * @param string $refresh_token
     */
    private function refreshToken()
    {
        if (!self::$config['refresh_token']) {
            return false;
        } else {
            $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?';
            $queryArr = [
                'appid' => self::$config['appid'],
                'grant_type' => 'refresh_token',
                'refresh_token' => self::$config['refresh_token']
            ];
            $url .= http_build_query($queryArr);
            $res = file_get_contents($url);
            $data = json_decode($res, true);
            if ($data['access_token']) {
                self::$config['access_token'] = $data['access_token'];
                return $data;
            } else {
                return false;
            }
        }
    }

    /**
     * 获取用户基本信息
     */
    private function getUserInfo()
    {
        //用户授权
        $url = "https://api.weixin.qq.com/sns/userinfo?";
        $queryArr = [
            'access_token' => self::$config['access_token'],
            'openid' => self::$config['openid'],
            'lang' => 'zh_CN',
        ];
        $url .= http_build_query($queryArr);
        $res = file_get_contents($url);
        $data = json_decode($res, true);
        if ($data['openid']) {
            return $data;
        } else {
            return false;
        }

    }

}