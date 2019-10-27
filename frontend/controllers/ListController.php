<?php


namespace frontend\controllers;


use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Attribute;
use frontend\models\Collect;
use frontend\models\Comment;
use frontend\models\Goods;
use frontend\models\GoodsAttr;
use frontend\models\RedType;
use frontend\models\TypeAttr;
use frontend\models\UserRed;
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

            $shop_ids = array_slice($shop_ids, ($page - 1) * 10, 10);

            $data = Goods::getShopByTypePage(0, 1, 10, ['in', Goods::tableName() . '.goods_id', $shop_ids]);

            return json_encode($data);

        }

        return $this->render('discount', ['info' => $info]);

    }


    /**
     * @return string
     * 商品详情
     */
    public function actionShop()
    {

        $id = \Yii::$app->request->get('id');

        $info = Goods::getGoodsInfoById($id);

        $image_list = Goods::getGoodsImage($id);

        $attr = Attribute::getGoodsAttrName($id);

        $attr_list = implode(',', array_column($attr, 'attr_name'));

        $is_collect = Collect::getUserCollectById($id);

        $comment = Comment::getDataList($id, 1, []);

        return $this->render('shop', [
            'image_list' => $image_list,
            'info' => $info,
            'attr_list' => $attr_list,
            'attr' => $attr,
            'is_collect' => $is_collect,
            'comment' => $comment,
            'image_url' => \Yii::$app->params['admin_url'],
        ]);

    }

    /**
     * @return false|string
     * @throws \yii\db\Exception
     * 收藏/取消收藏
     */
    public function actionCollect()
    {

//        if (\Yii::$app->session->has('user_date')) {
//            return json_encode(['code' => 0, 'msg' => '您还未登录']);
//        }
//
//        $user_id = \Yii::$app->session->get('user_date')['user_id'];

        $user_id = 3;

        $data = \Yii::$app->request->get();

        switch ($data['type']) {
            case 0:
                $flag = Collect::cancelCollect($user_id, $data['goods_id']);

                if ($flag) {
                    return json_encode(['code' => 1, 'msg' => '取消收藏成功']);
                } else {
                    return json_encode(['code' => 1, 'msg' => '取消收藏成功']);
                }

                break;
            case 1:
                $flag = Collect::addCollect($user_id, $data['goods_id']);

                if ($flag) {
                    return json_encode(['code' => 1, 'msg' => '取消收藏成功']);
                } else {
                    return json_encode(['code' => 1, 'msg' => '取消收藏成功']);
                }

                break;
        }

    }


    /**
     *  评论列表
     */
    public function actionEvaluateList()
    {

        $goods_id = \Yii::$app->request->get('goods_id');

        $page = \Yii::$app->request->get('page', 1);

        $type = \Yii::$app->request->get('type', 0);

        $andWhere = [];

        $table_name = Comment::tableName();

        switch ($type) {
            case 1:
                $andWhere = ['>', $table_name . '.comment_rank', 3];
                break;
            case 2:
                $andWhere = ['<', $table_name . '.comment_rank', 3];
                break;
            case 3:
                $andWhere = ['<>', $table_name . '.image', '0'];
                break;
        }

        $list = Comment::getDataList($goods_id, $page, $andWhere);

        return json_encode($list);
    }


    /**
     *  优惠券列表
     */
    public function actionRedList()
    {

        if (\Yii::$app->session->has('user_date')) {
            return json_encode(['code' => 0, 'msg' => '您还未登录']);
        }

        $goods_id = \Yii::$app->request->get('goods_id');

//        $user_id = \Yii::$app->session->get('user_date')['user_id'];
        $user_id = 1;

        //我的红包
        $user_list = UserRed::getDataByUserId($user_id);

        //商品红包
        $goods_red_info = Goods::getRedListByGoodsId($goods_id);

        //订单红包
        $red_list = RedType::getDataAll();

        array_push($red_list, $goods_red_info);

        foreach ($red_list as $k => $v) {

            $red_list[$k]['use_start_date'] = date('Y-m-d', $v['use_start_date']);
            $red_list[$k]['use_end_date'] = date('Y-m-d', $v['use_end_date']);

            if (in_array($v['type_id'], $user_list)) {
                $red_list[$k]['is_has'] = 1;
            } else {
                $red_list[$k]['is_has'] = 0;
            }

            switch ($v['send_type']) {
                case 1:
                    $red_list[$k]['min_amount'] = $v['min_goods_amount'];
                    break;
                case 2:
                    $red_list[$k]['min_amount'] = $v['min_amount'];
                    break;
            }

        }

        return json_encode(['code' => 1, 'data' => $red_list]);


    }


    /**
     *  领取优惠券
     */
    public function actionGetRed()
    {

        $type_id = \Yii::$app->request->get('type_id');

//        $user_id = \Yii::$app->session->get('user_date')['user_id'];
        $user_id = 1;

        $user_list = UserRed::getDataByUserId($user_id);

        if (in_array($type_id, $user_list)) {
            return json_encode(['code' => 0, 'msg' => '您已经领过该优惠券']);
        }

        $flag = \Yii::$app->db->createCommand()->insert(UserRed::tableName(),
            [
                'bonus_type_id' => $type_id,
                'user_id' => $user_id,
            ]
        )->execute();

        if ($flag) {
            return json_encode(['code' => 1, 'msg' => '领取成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '领取失败']);
        }

    }

    /**
     * @return false|string
     * 添加购物车
     */
    public function actionAddCar(){


        if (\Yii::$app->session->has('user_date')) {
            return json_encode(['code' => 0, 'msg' => '您还未登录']);
        }

        $data = \Yii::$app->request->get();

        if (empty($data['attr_id'])){

            return json_encode(['code'=>0,'msg'=>'请选择商品规格']);

        }

        $user_id = \Yii::$app->session->get('user_date')['user_id'];

        $date = [

            'user_id'=>$user_id,
            'goods_id'=>$data['goods_id'],
            'goods_attr_id'=>$data['attr_id'],

        ];

    }

}