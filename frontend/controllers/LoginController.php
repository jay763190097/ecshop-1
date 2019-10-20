<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/21 0021
 * Time: 0:33
 */

namespace frontend\controllers;

use frontend\models\EcsUsers;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class LoginController extends Controller
{
    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    public function actionLogin(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $mobile_phone = $request->post('new_phone2');
            if(self::Is_mobile($mobile_phone)){

            }else{
                return ['code'=>'3000','message'=> '该手机号码不合法'];
            }
        }
        return $this->render('login');
    }

    //判断手机号码的合法性
    public static function Is_mobile($phoneNumber)
    {
        if (preg_match("/^1[3456789]\d{9}$/", $phoneNumber)) {
            return true;
        } else {
            return false;
        }
    }
}