<?php


namespace frontend\controllers;


use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Goods;
use yii\web\Controller;

class IndexController extends Controller
{

    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    public function actionIndex()
    {

        //首页banner
        $banner = Method::getList()['banners'];


        //境外海淘
        $haitao = Goods::getShopByType(2,1,3);


        //自营

        $self = Goods::getShopByType(1,1,3);

        //限时优惠
        $info = Activity::getActivity();

        var_export($info);exit();

        return $this->render('index', [
            'banner' => $banner,
            'haitao'=>$haitao,
            'self'=>$self
        ]);

    }



}