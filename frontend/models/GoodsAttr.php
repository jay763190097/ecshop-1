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


//    public static function getDataByGoodsId($goods_id)
//    {
//
//
//        $table_name = self::tableName();
//
//        $attrbute_name = Attribute::tableName();
//
//        $select = [$table_name.'.goods_attr_id',$table_name.'.attr_value',$table_name.'.attr_id',$table_name.'.attr_price',$attrbute_name.'.attr_name'];
//
//        $list = self::find()->where(['goods_id' => $goods_id])
//            ->join('join', $attrbute_name, $table_name . '.attr_id=' . $attrbute_name . '.attr_id')
//            ->select($select)
//            ->asArray()
//            ->all();
//
//        return $list;
//
//
//    }


    /**
     * @param $goods_id
     * @param $attr_id
     * 得到一个商品的某一个属性有那些值
     */
    public static function getDataByGoodsId($goods_id,$attr_id)
    {

        $list = self::find()
            ->where(['goods_id'=>$goods_id,'attr_id'=>$attr_id])
            ->select(['goods_attr_id','attr_value','attr_price'])
            ->asArray()
            ->all();

        return $list;

    }
}