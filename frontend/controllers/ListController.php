<?php


namespace frontend\controllers;


use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Goods;
use frontend\models\GoodsAttr;
use frontend\models\TypeAttr;
use yii\web\Controller;

class ListController extends Controller
{

    public $layout = 'layout1';

    public $url = 'http://47.111.117.79:88';


    /**
     *  优惠列表
     */
    public function actionDiscount()
    {

        $request = \Yii::$app->request;

        $info = Activity::getDataInfo();

        if ($request->isAjax) {

            $shop_ids = explode(',', $info['act_range_ext']);

            $page = $request->get('page');

            $shop_ids = array_slice($shop_ids,($page-1) * 10,10)

            $data = Goods::getShopByTypePage(0,1,10,['in',Goods::tableName().'.goods_id',,$shop_ids]);

            return json_encode($data);

        }

        return $this->render('discount', ['info'=>$info]);

    }
}