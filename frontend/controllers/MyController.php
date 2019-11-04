<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/21 0021

 * Time: 0:20

 */



namespace frontend\controllers;



use frontend\method\Method;

use frontend\models\Activity;

use frontend\models\EcsUsers;

use frontend\models\Goods;

use yii\web\Controller;

use Yii;

use frontend\models\EcsCart;

use frontend\models\EcsCollectGoods;

use frontend\models\EcsFeedback;

use yii\web\Response;

use frontend\models\EcsOrderInfo;

use yii\web\UploadedFile;

use frontend\models\EcsUserAddress;

class MyController extends Controller

{

    public $layout = 'index';



    public $url = 'http://47.111.117.79:88';



    public $enableCsrfValidation = false;

    /**

     * 个人信息

     * @return string

     */

    public function actionIndex(){

        $user_date = Yii::$app->session['user_date'];

        $order = [];

        if($user_date){

            $order = EcsOrderInfo::order($user_date['user_id']);

        }

        return $this->render('index',['order'=>$order,'user_date'=>$user_date]);

    }



    /**

     * 我的收藏

     * @return string

     */

    public function actionCollection(){

        //获取当前登录者的信息

        $user_name = Yii::$app->session['user_date'];

        if($user_name){

            //根据用户id查询购物车表

            $user_id = $user_name['user_id'];

            $collection_date = EcsCollectGoods::collection($user_id);

            return $this->render('collection',['collection_date'=>$collection_date]);

        }else{

            return $this->redirect('/login/login');

        }

    }



    /**

     * 关于我们

     * @return string

     */

    public function actionAboutMy(){

        return $this->render('aboutmy');

    }



    /**

     * 问题反馈

     * @return array|string

     */

    public function actionFeedback(){

        $request = Yii::$app->request;

        $user_name = Yii::$app->session['user_date'];

        if($user_name){

            if($request->isPost){

                $date = $request->post();

                Yii::$app->response->format=Response::FORMAT_JSON;

                $res = [

                    'msg_time'=>time(),

                    'msg_content'=>$date['customerMessage'],

                    'user_id'=>$user_name['user_id'],

                    'user_name'=>$user_name['user_name'],

                ];

                $bool = EcsFeedback::add($res);

                if($bool){

                    return ['code'=>'20000','message'=>'提交成功！'];

                }else{

                    return ['code'=>'50000','message'=>'提交失败！'];

                }

            }

            return $this->render('feedback');

        }else{

            return $this->redirect('/login/login');

        }

    }



    /**

     * 个人信息

     * @return string|Response

     */

    public function actionInfo(){

        $user_date = Yii::$app->session['user_date'];
        $request = Yii::$app->request;
        if($request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $date = $request->post();
            switch ($date['sex']){
                case '保密':
                    $date['sex'] = 0;
                    break;
                case '男':
                    $date['sex'] = 1;
                    break;
                default:
                    $date['sex'] = 2;
            }
            $bool = EcsUsers::edit($date,$date['user_id']);
            if($bool){

                return ['code'=>'20000','message'=>'保存成功！'];

            }else{

                return ['code'=>'50000','message'=>'保存失败！'];

            }

        }
        if($user_date){

            $user = EcsUsers::find()->andWhere(['user_id'=>$user_date['user_id']])->asArray()->one();

            return $this->render('info',['user_date'=>$user]);

        }else{

            return $this->redirect('/login/login');

        }

    }


    /**
     * 更换手机号码
     * @return array|string|Response
     * @throws \yii\db\Exception
     */
    public function actionModifyPhone(){
        $user_date = Yii::$app->session['user_date'];
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            define('IN_ECS','aaa');
            include 'sms/cls_sms.php';
            $date = $request->post('mobile');
            //调用发送验证码
            $sms = new \sms();
            $code = rand ( 1000, 9999 );
            $logincode = $sms->send($date,$code);
            if($logincode){
                Yii::$app->db->createCommand()->insert('ecs_user_code',
                    [
                        'phone'     => $date,
                        'code'      => $code,
                        'res'      => 0,
                        'date'      => date('Y-m-d H:i:s',time()),
                        'add_time'  =>time()
                    ])->execute();
                return ['code'=>'20000','message'=>'发送成功！','mobile'=>$date];
            }else{
                return ['code'=>'50000','message'=>'发送失败！'];
            }
        }
        if($user_date){
            $mobile = $user_date['mobile_phone'];
            $xing = substr($mobile,3,4);  //获取手机号中间四位
            $mobile_old = str_replace($xing,'****',$mobile);  //用****进行替换
            return $this->render('modifyphone',['user_date'=>$user_date,'mobile'=>$mobile_old]);
        }else{
            return $this->redirect('/login/login');
        }
    }

    /**
     * 更换手机的验证码
     * @return string
     */
    public function actionModifyphonecode(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $date = $request->post();
            $rule = LoginController::Verification($date['mobile'],$date['code']);
            if($rule != 1){
                return ['code'=>'50000','message'=> $rule];
            }else{
                return ['code'=>'20000','message'=>'验证成功！'];
            }
        }
        $mobile = $request->get('mobile');
        $xing = substr($mobile,3,4);  //获取手机号中间四位
        $mobile_old = str_replace($xing,'****',$mobile);  //用****进行替换
        return $this->render('modifyphonecode',['mobile'=>$mobile,'mobile_old'=>$mobile_old]);
    }

    /**
     * 新手机号码
     * @return array|string
     * @throws \yii\db\Exception
     */
    public function actionNewphone(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            define('IN_ECS','aaa');
            include 'sms/cls_sms.php';
            $date = $request->post('mobile');
            if(LoginController::Is_mobile($date)){
                $rule = EcsUsers::find()->andWhere(['mobile_phone'=>$date])->asArray()->one();
                if($rule){
                    return ['code'=>'50000','message'=>'手机号码已经存在！'];
                }else{
                    //调用发送验证码
                    $sms = new \sms();
                    $code = rand ( 1000, 9999 );
                    $logincode = $sms->send($date,$code);
                    if($logincode){
                        Yii::$app->db->createCommand()->insert('ecs_user_code',
                            [
                                'phone'     => $date,
                                'code'      => $code,
                                'res'      => 0,
                                'date'      => date('Y-m-d H:i:s',time()),
                                'add_time'  =>time()
                            ])->execute();

                        return ['code'=>'20000','message'=>'发送成功！','mobile'=>$date];
                    }else{
                        return ['code'=>'50000','message'=>'发送失败！'];
                    }
                }
            }else{
                return ['code'=>'50000','message'=>'该手机号码不合法！'];
            }

        }
        return $this->render('newphone');
    }

    /**
     * 新手机验证码
     * @return array|string
     */
    public function actionNewcode(){
        $request = Yii::$app->request;
        if($request->isPost){
            $date = $request->post();
            Yii::$app->response->format=Response::FORMAT_JSON;
            $rule = LoginController::Verification($date['mobile_phone'],$date['code']);
            if($rule != 1){
                return ['code'=>'50000','message'=> $rule];
            }else{
                $user_date = Yii::$app->session['user_date'];
                $user_id = $user_date['user_id'];
                unset($date['code']);
                $bool = EcsUsers::edit($date,$user_id);
                if($bool){
                    $new_user = EcsUsers::find()->andWhere(['mobile_phone'=>$date['mobile_phone']])->asArray()->one();
                    yii::$app->session['user_date']=$new_user;
                    return ['code'=>'20000','message'=>'修改成功！'];
                }else{
                    return ['code'=>'50000','message'=>'修改失败！'];
                }
            }

        }
        $mobile = $request->get('mobile');
        $xing = substr($mobile,3,4);  //获取手机号中间四位
        $mobile_old = str_replace($xing,'****',$mobile);  //用****进行替换
        return $this->render('newcode',['mobile'=>$mobile,'mobile_old'=>$mobile_old]);
    }

    /**
     * 上传头像
     * @return false|string
     */
    public function actionUpload(){

        $request = Yii::$app->request;

        if (UploadedFile::getInstanceByName('file')) {

            $image = BaseController::Upimg('file');

            if($image['status'] == 2){

                return json_encode(['code'=>50001,'message'=>'上传图片格式不正确，请查看配置！']);

            }else if($image['status'] == 3){

                return json_encode(['code'=>50001,'message'=>'上传图片大小超出限制，请查看配置！']);

            }else{

                $data['img_url'] = $image['imgurl'];

            }



            $user_date = Yii::$app->session['user_date'];

            $bool = EcsUsers::edit($data,$user_date['user_id']);



            if($bool){

                return json_encode(['code'=>20000,'message'=>'上传成功！']);

            }else{

                return json_encode(['code'=>50001,'message'=>'上传失败！']);

            }

        }

    }



    /**

     * 我的收获地址

     * @return string|Response

     */

    public function actionManageAddress(){

        $user_date = Yii::$app->session['user_date'];

        if($user_date){



            $address_date = EcsUserAddress::address_date($user_date['user_id']);



            return $this->render('manageaddress',['address_date'=>$address_date]);

        }else{

            return $this->redirect('/login/login');

        }

    }



    /**

     * 修改默认地址

     * @return array

     */

    public function actionIsDefault(){

        $request = Yii::$app->request;

        if($request->isPost){

            $user_date = Yii::$app->session['user_date'];

            Yii::$app->response->format = Response::FORMAT_JSON;

            $data = $request->post();

            $res_date = [

                'is_default'=>1,

                'update_time'=>time()

            ];

            $bool = EcsUserAddress::edit($res_date,$data['address_id'],$user_date['user_id']);

            if($bool){

                return ['code'=>'20000','message'=>'修改成功！'];

            }else{

                return ['code'=>'50000','message'=>'修改失败！'];

            }

        }

    }



    /**

     * 删除收货地址

     * @return array

     */

    public function actionDelAddress(){

        $request = Yii::$app->request;

        if($request->isPost) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $data = $request->post();

            $res_date = [

                'is_del'=>0,

                'update_time'=>time()

            ];

            $bool = EcsUserAddress::del($res_date,$data['address_id']);

            if($bool){

                return ['code'=>'20000','message'=>'删除成功！'];

            }else{

                return ['code'=>'50000','message'=>'删除失败！'];

            }

        }

    }

    /**

     * 添加收货地址

     * @return array|string|Response

     */

    public function actionAddaddress(){

        $request = Yii::$app->request;

        $user_date = Yii::$app->session['user_date'];

        if($user_date){

            if($request->isPost){

                Yii::$app->response->format=Response::FORMAT_JSON;

                $data = $request->post();

                $bool=EcsUserAddress::add($data);

                if($bool){

                    return ['code'=>'20000','message'=>'保存成功！'];

                }else{

                    return ['code'=>'50000','message'=>'保存失败！'];

                }

            }

            return $this->render('addaddress',['user_id'=>$user_date['user_id']]);

        }else{

            return $this->redirect('/login/login');

        }

    }



    /**

     * 修改地址

     * @return array|string|Response

     * @throws \yii\db\Exception

     */

    public function actionEditAddress(){

        $request = Yii::$app->request;

        $id = $request->get('id');

        if($id){

            if($request->isPost){

                Yii::$app->response->format=Response::FORMAT_JSON;

                $user_date = Yii::$app->session['user_date'];

                $data = $request->post();

                $bool = EcsUserAddress::edit($data,$data['address_id'],$user_date['user_id']);

                if($bool){

                    return ['code'=>'20000','message'=>'保存成功！'];

                }else{

                    return ['code'=>'50000','message'=>'保存失败！'];

                }

            }

            $address_date = EcsUserAddress::onedate($id);

            return $this->render('editaddress',['address_date'=>$address_date]);

        }else{

            return $this->redirect('/my/manageaddress');

        }

    }

}