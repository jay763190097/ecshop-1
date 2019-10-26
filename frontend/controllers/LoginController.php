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

    /**
     * 登录
     * @return array|string
     */
    public function actionLogin(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $date = $request->post();
            if($date['type'] == 'code'){
                $mobile_phone = $request->post('new_phone2');
                if(self::Is_mobile($mobile_phone)){

                }else{
                    return ['code'=>'3000','message'=> '该手机号码不合法'];
                }
            }else{
                if(self::Is_mobile($date['new_phone3'])){
                    $user_date = EcsUsers::find()->andWhere(['mobile_phone'=>$date['new_phone3']])->asArray()->one();
                    if($user_date){
                        if($user_date['password'] == md5($date['password_val'])){
                            yii::$app->session['user_date']=$user_date;
                            return ['code'=>'20000','message'=>'登录成功！'];
                        }else{
                            return ['code'=>'50000','message'=>'密码错误！'];
                        }
                    }else{
                        return ['code'=>'50000','message'=>'用户不存在，请通过验证码登录！'];
                    }
                }else{
                    return ['code'=>'50000','message'=> '该手机号码不合法'];
                }

            }

        }
        return $this->render('login');
    }

    public function actionForgotPassword(){
        return $this->render('forgotpassword');
    }
    /**
     * 退出登录
     * @return array
     */
    public function actionOutlogin(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $user_id = $request->post('user_id');
            Yii::$app->session->remove('user_date');
            $date = [
                'last_login'=>time()
            ];
            $bool = EcsUsers::edit($date,$user_id);
            if($bool){
                return ['code'=>'20000','message'=>'退出成功！'];
            }else{
                return ['code'=>'50000','message'=> '退出失败！'];
            }

        }
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