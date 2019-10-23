<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 商品类型
 */
class Category extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%category}}";
    }
}