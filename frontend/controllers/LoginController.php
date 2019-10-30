<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/21 0021
 * Time: 0:33
 */

namespace frontend\controllers;

use frontend\models\EcsUsers;
use frontend\models\SxUserCode;
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
        define('IN_ECS','aaa');
        include 'sms/cls_sms.php';

        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $date = $request->post();

            if($date['type'] == 'code'){
                $mobile_phone = $request->post('new_phone2');
                if(self::Is_mobile($mobile_phone)){
                    //调用发送验证码
                    $sms = new \sms();
                    $code = rand ( 1000, 9999 );
                    $logincode = $sms->send($mobile_phone,$code);
                    if($logincode){
                        Yii::$app->db->createCommand()->insert('ecs_user_code',
                            [
                                'phone'     => $mobile_phone,
                                'code'      => $code,
                                'res'      => 0,
                                'date'      => date('Y-m-d H:i:s',time()),
                                'add_time'  =>time()

                            ])->execute();
                        return ['code'=>'20000','message'=>'发送成功！','mobile'=>$mobile_phone];
                    }else{
                        return ['code'=>'50000','message'=>'发送失败！'];
                    }

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


    /**
     * 验证码验证
     * @return array|string
     * @throws \yii\db\Exception
     */
    public function actionVerification(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $date = $request->post();
            if(self::Is_mobile($date['mobile'])){
                $rule = self::Verification($date['mobile'],$date['code']);
                if($rule != 1){
                    return ['code'=>'50000','message'=> $rule];
                }else{
                    $user = EcsUsers::find()->where(['mobile_phone' =>$date['mobile']])->asArray()->one();
                    if(!$user){

                        $add = Yii::$app->db->createCommand()->insert('ecs_users', [
                            'user_name'=>$date['mobile'],
                            'mobile_phone' =>$date['mobile'],
                            'password' => md5(123456),
                            'reg_time'=>time(),
                        ])->execute();
                        $user = EcsUsers::find()->where(['mobile_phone' => $date['mobile']])->asArray()->one();

                        if($add){
                            yii::$app->session['user_date']=$user;
                            return ['code'=>'20000','message'=> '登录成功'];
                        }else{
                            return ['code'=>'50000','message'=> '登录失败！'];
                        }
                    }else{
                        yii::$app->session['user_date']=$user;
                        return ['code'=>'20000','message'=> '登录成功'];
                    }
                }
            }else{
                return ['code'=>'50000','message'=> '该手机号码不合法'];
            }
        }

        $mobile = $request->get('mobile');
        $xing = substr($mobile,3,4);  //获取手机号中间四位
        $mobile_old = str_replace($xing,'****',$mobile);  //用****进行替换

        return $this->render('code',['mobile'=>$mobile,'mobile_old'=>$mobile_old]);
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

    /**
     * 验证验证码
     * @param $mobile
     * @param $code
     * @return array|bool
     */
    public static function Verification($mobile,$code){
        Yii::$app->response->format=Response::FORMAT_JSON;
        try{
            if(!preg_match('/^\d*$/',$mobile)){
                return '该手机号码不合法';
            }
            $code_info=SxUserCode::find()->where(['phone'=>$mobile])->orderBy('add_time desc')->asArray()->one();
            if(!$code_info){
                return '验证码错误';
            }else{
                //var_dump($code,$code_info);die;
                if($code==$code_info['code']){
                    if((time()-$code_info['add_time']) >10*60){
                        return '验证码已过期';
                    }else{
                        return 1;
                    }
                }else{
                    return  '验证码错误';
                }
            }
        }catch(Exception $error) {
            return '验证失败';
            //throw new Exception('数据表或字段不存在!');
        }
    }
}