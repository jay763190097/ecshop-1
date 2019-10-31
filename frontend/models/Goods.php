<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Goods
 * @package frontend\models
 * 商品
 */
class Goods extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%goods}}";
    }


    /**
     * @param $type 0：不限；1：自营；2：海淘
     * @param $page 页数
     * @param $limit 显示的个数
     * @return array|ActiveRecord[]
     * 得到商品列表
     */
    public static function getShopByType($type, $page, $limit, $andWher = [])
    {

        $where = ['is_delete' => 0, 'is_alone_sale' => 1, 'is_on_sale' => 1];

        if (!empty($type)) {
            $where['suppliers_id'] = $type;
        }

        $select = ['goods_id', 'goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

        $list = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->orderBy('click_count desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select($select)
            ->asArray()
            ->all();

        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return $list;

    }


    /**
     * @param $type 0：不限；1：自营；2：海淘
     * @param $page 页数
     * @param $limit 显示的个数
     * @return array|ActiveRecord[]
     * 得到商品列表
     */
    public static function getShopByTypePage($type, $page, $limit, $andWher = [])
    {

        $where = ['is_delete' => 0, 'is_alone_sale' => 1, 'is_on_sale' => 1];

        if (!empty($type)) {
            $where['suppliers_id'] = $type;
        }

        $select = ['goods_id', 'goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

        $list = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->orderBy('click_count desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select($select)
            ->asArray()
            ->all();

        $count = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->count();

        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count];

    }


    /**
     * @param $type 0：不限；1：自营；2：海淘
     * @param $page 页数
     * @param $limit 显示的个数
     * @return array|ActiveRecord[]
     * 得到首页的商品列表
     */
    public static function getIndexShopList($type, $page, $limit, $andWher = [])
    {

        $goods_attr = GoodsAttr::tableName();

        $goods_name = self::tableName();

        $where = [$goods_name . '.is_delete' => 0, $goods_name . '.is_alone_sale' => 1, $goods_name . '.is_on_sale' => 1];

        if (!empty($type)) {
            $where[$goods_name . '.suppliers_id'] = $type;
        }

        $select = [$goods_name . '.goods_id', $goods_name . '.goods_name', $goods_name . '.virtual_sales', $goods_name . '.goods_thumb', $goods_name . '.shop_price', $goods_name . '.suppliers_id'];

        $list = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->join('join', $goods_attr, $goods_attr . '.goods_id=' . $goods_name . '.goods_id')
            ->orderBy($goods_name . '.click_count desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select($select)
            ->groupBy(self::tableName().'.goods_id')
            ->asArray()
            ->all();

        $count = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->join('join', $goods_attr, $goods_attr . '.goods_id=' . $goods_name . '.goods_id')
            ->groupBy(self::tableName().'.goods_id')
            ->count();


        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count,'count_page'=>ceil($count/$limit)];

    }


    public static function getTypeAll($page, $where, $andWhere, $order, $like)
    {

        $table_name = self::tableName();//商品表

        $goodsAttr_name = GoodsAttr::tableName();//商品属性表

        $select = [$table_name . '.goods_id', $table_name . '.goods_name', $table_name . '.virtual_sales', $table_name . '.goods_thumb', $table_name . '.shop_price', $table_name . '.suppliers_id'];


        $list = self::find()
            ->where([$table_name . '.is_on_sale' => 1,
                $table_name . '.is_alone_sale' => 1,
                $table_name . '.is_delete' => 0,
            ])
            ->andWhere($like)
            ->andWhere($where)
            ->andWhere($andWhere)
            ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
            ->limit(10)
            ->offset(($page - 1) * 10)
            ->orderBy($order)
            ->select($select)
            ->groupBy($table_name . '.goods_id')
            ->asArray()
            ->all();


//        var_dump(
//
//            self::find()
//                ->where([$table_name . '.is_on_sale' => 1,
//                    $table_name . '.is_alone_sale' => 1,
//                    $table_name . '.is_delete' => 0,
//                ])
//                ->andWhere($where)
//                ->andWhere($andWhere)
//                ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
//                ->limit(10)
//                ->offset(($page - 1) * 10)
//                ->orderBy($order)
//                ->select($select)
//                ->groupBy($table_name.'.goods_id')->createCommand()->getRawSql()
//
//        );exit();

        $count = self::find()
            ->where([$table_name . '.is_on_sale' => 1,
                $table_name . '.is_alone_sale' => 1,
                $table_name . '.is_delete' => 0,
            ])
            ->andWhere($where)
            ->andWhere($andWhere)
            ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
            ->groupBy($table_name . '.goods_id')
            ->count();


        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count,'count_page' =>ceil($count/10)];

    }

    /**
     * @param $id
     * @return array|ActiveRecord[]
     * 得到某个商品的图片
     */
    public static function getGoodsImage($id)
    {
        //商品图片
        $image_list = GoodsImage::find()->where(['goods_id' => $id])->select(['img_url img'])->asArray()->all();

        foreach ($image_list as $k => $v) {

            $image_list[$k]['img'] = \Yii::$app->params['admin_url'] . '/' . $v['img'];

        }

        return $image_list;

    }


    /**
     * @param $id
     * @return array|ActiveRecord|null
     * 商品下详情
     */
    public static function getGoodsInfoById($id)
    {

        $table_name = self::tableName();

        $type_name = Category::tableName();

        $select = [
            $type_name . '.filter_attr',
            $table_name . '.goods_desc',
            $table_name . '.goods_number',
            $table_name . '.goods_id',
            $table_name . '.goods_name',
            $table_name . '.is_promote',
            $table_name . '.bonus_type_id',
            $table_name . '.promote_price',//促销价
            $table_name . '.shop_price',//实际售价
            $table_name . '.is_promote',//是否特价促销；0，否；1，是
            $table_name . '.goods_id',
            $table_name.'.goods_img'
        ];

        $info = self::find()
            ->where([$table_name . '.goods_id' => $id, $type_name . '.is_show' => 1])
            ->join('join', $type_name, $type_name . '.cat_id=' . $table_name . '.cat_id')
            ->select($select)
            ->asArray()
            ->one();

        $url = \Yii::$app->params['admin_url'];
        $info['goods_desc'] = htmlspecialchars_decode($info['goods_desc']);

        $info['goods_img'] = $url .'/'.$info['goods_img'];

        preg_match_all('/<img src="(.*?)"/i', $info['goods_desc'], $match);

        if (!empty($match[1])) {
            foreach ($match[1] as $key => $val) {
                if (strpos($val, 'http') === false) {
                    $info = str_replace($val, $url . $val, $info);
                }
            }
        }

        $info['price'] = $info['shop_price'];

        if ($info['is_promote'] == 1) {
            $info['price'] = $info['promote_price'];
        }

        return $info;

    }


    /**
     * @param $goods_id
     * 得到一个商品的商品红包
     */
    public static function getRedListByGoodsId($goods_id)
    {

        $table_name = self::tableName();

        $red_name = RedType::tableName();

        $select = [

            $red_name . '.type_id',
            $red_name . '.type_money',//红包金额
            $red_name . '.send_type',//红包类型
            $red_name . '.min_amount',//订单最小金额
            $red_name . '.use_start_date',//红包使用开始时间
            $red_name . '.use_end_date',//红包使用结束时间
            $red_name . '.min_goods_amount',//可以使用该红包的商品的最低价格,即只要达到该价格商品才可以使用红包

        ];

        $info = self::find()
            ->where([$table_name . '.goods_id' => $goods_id])
            ->join('join', $red_name, $red_name . '.type_id=' . $table_name . '.bonus_type_id')
            ->select($select)
            ->asArray()
            ->one();

        return $info;


    }

}