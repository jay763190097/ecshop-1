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


}