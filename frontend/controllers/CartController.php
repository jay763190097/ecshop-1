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
class CartController extends Controller
{
    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    /**
     * 购物车信息
     * @return string
     */
    public function actionIndex(){
        //获取当前登录者的信息
        $user_name = Yii::$app->session['user_name'];
        //根据用户id查询购物车表
        $id = $user_name['id'];
        $cart_date = EcsCart::cartdate($id);

        return $this->render('index',['cart_date'=>$cart_date]);
    }
}