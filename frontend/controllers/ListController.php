<?php


namespace frontend\controllers;


use frontend\method\Method;
use frontend\models\Activity;
use frontend\models\Attribute;
use frontend\models\Collect;
use frontend\models\Comment;
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
            'comment'=>$comment,
            'image_url'=>\Yii::$app->params['admin_url'],
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

}