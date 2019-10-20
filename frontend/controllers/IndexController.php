<?php


namespace frontend\controllers;


use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Goods;
use frontend\models\GoodsAttr;
use frontend\models\TypeAttr;
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
        $haitao = Goods::getShopByType(2, 1, 3);


        //自营

        $self = Goods::getShopByType(1, 1, 3);

        //限时优惠
        $discount = Activity::getActivity();

        return $this->render('index', [
            'banner' => $banner,
            'haitao' => $haitao,
            'self' => $self,
            'discount' => $discount
        ]);

    }


    /**
     *  首页筛选
     */
    public function actionList()
    {

        $request = \Yii::$app->request;

        $type = $request->get('type', 0);
        $page = $request->get('page', 0);

        //type 0:精品；1：日抛；2：双周抛；3：月抛；4：透明片

        $andWhere = [];
        switch ($type) {
            case 0:
                $andWhere = ['is_best' => 1];
                break;
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
            default:

        }
        $info = Goods::getShopByTypePage(0, 0, 8, $andWhere);

        return json_encode($info);

    }


    public function actionType()
    {

        $type_list = TypeAttr::getDataByTypeId();

        $list = Goods::getShopByType(0, 0, 8);

        return $this->render('type', ['list' => $list, 'type_list' => $type_list]);

    }


    public function actionTypeList()
    {

        $request = \Yii::$app->request;

//        <!-- type:0:全部；1：自营；2：海淘 -->
        $type = $request->get('type', 0);

        $page = $request->get('page', 0);

//        <!-- check_type 0:综合；1：销量；2：新品；  -->
        $check_type = $request->get('check_type', 0);

//        <!-- 价格 desc:倒序；asc:正序；-->
        $price_order = $request->get('price_order');

//        typeAttr      筛选属性
        $typeAttr = $request->get('typeAttr');

        $goods_name_value = $request->get('goods_name');

        $goods_name = Goods::tableName();

        $where = [];

        $order = $goods_name.'.add_time desc';

        if (!empty($type)) {
            $where [$goods_name . '.suppliers_id'] = $type;
        }

        if (!empty($price_order)) {
            $order = $goods_name.'.shop_price '.$price_order;
        } else {

            switch ($check_type) {
                case 1:
                    //销量
                    $order = $goods_name.'.virtual_sales desc';
                    break;
                case 2:
//                新品
                    $where [$goods_name . '.is_new'] = 1;
                    break;
            }

        }

        $andWhere = [];
        if (!empty($typeAttr)) {

            $goodsAttr_name = GoodsAttr::tableName();


            $andWhere = ['or'];
            foreach ($typeAttr as $k => $v) {
                $type_where = [];
                $type_where = ['and'];
                $type_where[] =[$goodsAttr_name . '.attr_id' => $k];
                $type_where[] =[$goodsAttr_name . '.attr_value' => $v];

                $andWhere[] = $type_where;

            }


        }

        $like = [];
        if (!empty($goods_name_value)){
            $like = ['like',$goods_name.'.goods_name',$goods_name_value];
        }

        $info = Goods::getTypeAll($page, $where, $andWhere, $order,$like);

        return json_encode($info);

    }


}