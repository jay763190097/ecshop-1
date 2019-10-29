<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/27 0027
 * Time: 17:02
 */

namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use frontend\models\EcsCart;
use frontend\models\EcsCollectGoods;
use frontend\models\EcsOrderInfo;
use frontend\models\EcsGoods;
use yii\web\Response;
use frontend\models\EcsUserBonus;
use frontend\models\EcsBonusType;
use frontend\models\EcsUserAddress;
class OrderController extends  Controller
{
    public $layout = 'layout1';

    public $url = 'http://47.111.117.79:88';

    public function actionPay(){
        $request = Yii::$app->request;
        $user_date = Yii::$app->session['user_date'];
        if($user_date){
            if($request->isGet){
                $date = $request->get();
                //购物车生成订单
                if($date['type'] == 2 ){
                    $good_date = json_decode($date['date'], true);
                    $order = [];
                    $sum = "0.00";
                    $freight = "10.00";
                    $good_sum = 0.00;
                    //购买商品信息
                    foreach ($good_date as $key =>$value){
                        $cartDate = EcsCart::good_date($value['cart_id']);
                        $cartDate['goods_num'] = $value['good_num'];
                        $order[] = $cartDate;
                        $sum = $sum+$cartDate['goods_num']*$cartDate['goods_price'];
                        $good_sum = $good_sum+$cartDate['goods_num']*$cartDate['goods_price'].".00";
                    }

                    //红包金额
                    $UserBonus = EcsUserBonus::userBonus($user_date['user_id'],$sum);
                    if($UserBonus){
                        $userBonus = $UserBonus;
                        $sum = $sum-$UserBonus;
                    }else{
                        $userBonus ="0.00";
                    }

                    //运费金额
                    if($sum > 200){
                        $freight = 0;
                    }else{
                        $sum = $sum+$freight;
                    }

                    //我的收获地址
                    $user_address = EcsUserAddress::find()->andWhere(['user_id'=>$user_date['user_id'],'is_del'=>1])->orderBy('is_default desc')->asArray()->one();
                    $sum = $sum.".00";
                    return $this->render('pay',['user_address'=>$user_address,'order'=>$order,'good_sum'=>$good_sum,'freight'=>$freight,'userBonus'=>$userBonus,'sum'=>$sum]);
                }

            }
        }else{
            return $this->redirect('/login/login');
        }

    }
}