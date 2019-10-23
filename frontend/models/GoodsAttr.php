<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 商品属性
 */
class GoodsAttr extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%goods_attr}}";
    }


    public static function getDataByGoodsId($goods_id)
    {


        $table_name = self::tableName();

        $attrbute_name = Attribute::tableName();

        $select = [$table_name.'.goods_attr_id',$table_name.'.attr_value',$table_name.'.attr_id',$table_name.'.attr_price',$attrbute_name.'.attr_name'];

        $list = self::find()->where(['goods_id' => $goods_id])
            ->join('join', $attrbute_name, $table_name . '.attr_id=' . $attrbute_name . '.attr_id')
            ->select($select)
            ->asArray()
            ->all();

        return $list;


    }


}