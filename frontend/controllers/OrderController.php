<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/27 0027
 * Time: 17:02
 */

namespace frontend\controllers;

use frontend\models\Goods;
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

    /**
     * 确认订单
     * @return string|Response
     */
    public function actionPay(){
        $request = Yii::$app->request;
        $user_date = Yii::$app->session['user_date'];
        if($user_date){
            if($request->isGet){
                $date = $request->get();
                //购物车生成订单
                if($date['type'] == "cart" ){
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
                        $sum = $sum + $cartDate['goods_num']*$cartDate['goods_price'];
                        $good_sum = $good_sum+$cartDate['goods_num']*$cartDate['goods_price'].".00";
                    }

                }elseif($date['type'] == "good"){
                    $date['good_attr_id'] = trim($date['good_attr_id'], ',');
                    $order = [];
                    $order = Goods::goode_date($date['goods_id'],$date['good_attr_id'],$date['good_attr'],$date['good_num']);

                    empty($order)?[]:$order;

                    $sum = "0.00";
                    $freight = "10.00";
                    $good_sum = 0.00;

                    foreach ($order as $key=>$value){
                        $sum = $sum+$value['goods_num']*$value['goods_price'];
                        $good_sum = $good_sum+$value['goods_num']*$value['goods_price'].".00";
                    }
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
        }else{
            return $this->redirect('/login/login');
        }
    }

    /**
     * 结算订单
     */
    public function actionCreationOrder(){
        $request = Yii::$app->request;
        $user_date = Yii::$app->session['user_date'];
        if($request->isPost){
            $user_date = Yii::$app->session['user_date'];
            $date = $request->post();
            $goods_date = json_decode($date['date'], true);

            $goods_count = 0;
            foreach ($goods_date as $key=>$value){
                $goods_count = $goods_count+$value['goods_number'];
            }
            //生成唯一订单号
            @date_default_timezone_set("PRC");
            $order_date = date('Y-m-d');
            $order_id_main = date('YmdHis') . rand(10000000,99999999);
            $order_id_len = strlen($order_id_main);
            $order_id_sum = 0;
            for($i=0; $i<$order_id_len; $i++){
                $order_id_sum += (int)(substr($order_id_main,$i,1));
            }
            $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);

            $order_date = [
                'order_sn'=>$order_id,
                'user_id'=>$user_date['user_id'],
                'consignee'=>$date['address_name'],
                'order_status'=>1,
                'shipping_status'=>0,
                'pay_status'=>0,
                'district'=>$date['district'],
                'address'=>$date['address'],
                'mobile'=>$date['mobile'],
                'goods_amount'=>$date['sum'],
                'add_time'=>time(),
                'confirm_time'=>time(),
                'pay_note'=>$date['remarks'],
                'idcard'=>$date['id_card'],
                'goods_count'=>$goods_count,
                'update_time'=>time(),
            ];

            $bool = EcsOrderInfo::add($goods_date,$order_date);


        }
    }

    /**
     * 订单信息
     * @return string|Response
     */
    public function actionAllOrder(){
        $user_date = Yii::$app->session['user_date'];
        $request = Yii::$app->request;
        if($user_date){
            $type = $request->get('type');
            $order_date = EcsOrderInfo::order_date($user_date,$type);
            return $this->render('myorder',['date' =>$order_date,'type'=>$type]);
        }else{
            return $this->redirect('/login/login');
        }
    }
}