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
    public static function getShopByType($type, $page, $limit,$andWher=[])
    {

        $where = ['is_delete' => 0, 'is_alone_sale' => 1, 'is_on_sale' => 1];

        if (!empty($type)) {
            $where['suppliers_id'] = $type;
        }

        $select = ['goods_name', 'virtual_sales', 'goods_thumb','shop_price','suppliers_id'];

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

}