<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 图片相册
 */
class GoodsImage extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%goods_gallery}}";
    }
}