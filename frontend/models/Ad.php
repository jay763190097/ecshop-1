<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 广告
 */
class Ad extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%ad}}";
    }

    public static function getDataByPostionId($position_id){

        $table_name = self::tableName();
        $postion_name = Position::tableName();

        self::find()
            ->where([])

    }

}