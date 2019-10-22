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
use frontend\models\Goods;
use yii\web\Controller;
use Yii;
use frontend\models\EcsCart;
use frontend\models\EcsCollectGoods;
use frontend\models\EcsFeedback;
use yii\web\Response;

class MyController extends Controller
{
    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    /**
     * 我的收藏
     * @return string
     */
    public function actionCollection(){
        //获取当前登录者的信息
        $user_name = Yii::$app->session['user_name'];
        //根据用户id查询购物车表
        $user_id = $user_name['id'];
        $user_id = 1;
        $collection_date = EcsCollectGoods::collection($user_id);

        return $this->render('collection',['collection_date'=>$collection_date]);
    }

    /**
     * 关于我们
     * @return string
     */
    public function actionAboutMy(){
        return $this->render('aboutmy');
    }

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
            $this->redirect('/login/login');
        }
    }
}