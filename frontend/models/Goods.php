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

        $select = ['goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

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

        $select = ['goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

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


    public static function getTypeAll($page, $where, $andWhere, $order)
    {

        $table_name = self::tableName();//商品表

        $goodsAttr_name = GoodsAttr::tableName();//商品属性表

        $select = [$table_name.'.goods_name', $table_name.'.virtual_sales', $table_name.'.goods_thumb', $table_name.'.shop_price', $table_name.'.suppliers_id'];


        $list = self::find()
            ->where([$table_name . '.is_on_sale' => 1,
                $table_name . '.is_alone_sale' => 1,
                $table_name . '.is_delete' => 0,
            ])
            ->andWhere($where)
            ->andWhere($andWhere)
            ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
            ->limit(10)
            ->offset(($page - 1) * 10)
            ->orderBy($order)
            ->select($select)
            ->groupBy($table_name.'.goods_id')
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
            ->groupBy($table_name.'.goods_id')
            ->count();


        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count];

    }

}