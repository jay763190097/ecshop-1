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
    public $layout = 'layout';

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
        if($user_date){
            $user = EcsUsers::find()->andWhere(['user_id'=>$user_date['user_id']])->asArray()->one();
            return $this->render('info',['user_date'=>$user]);
        }else{
            return $this->redirect('/login/login');
        }
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