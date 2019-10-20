<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/16 0016
 * Time: 22:32
 */

namespace frontend\controllers;

use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Goods;
use yii\web\Controller;
use Yii;
use frontend\models\EcsCart;
use frontend\models\EcsCollectGoods;
use yii\web\Response;
class CartController extends Controller
{
    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    /**
     * 购物车信息
     * @return string
     */
    public function actionIndex(){
        $request = Yii::$app->request;
        if($request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $ids = $request->post('id');
            $ids = explode(',',$ids);
            $ids= array_filter($ids);
            $bool = EcsCart::del($ids);
            if($bool){
                return ['code'=>'20000','message'=>'删除成功！'];
            }else{
                return ['code'=>'50000','message'=>'删除失败！'];
            }
        }
        //获取当前登录者的信息
        $user_name = Yii::$app->session['user_name'];
        //根据用户id查询购物车表
        $user_id = $user_name['id'];
        $cart_date = EcsCart::cartdate($user_id);

        return $this->render('index',['cart_date'=>$cart_date]);
    }


}