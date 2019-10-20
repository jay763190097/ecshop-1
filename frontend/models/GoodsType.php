<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 商品类型
 */
class GoodsType extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%goods_type}}";
    }
}