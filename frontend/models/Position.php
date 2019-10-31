<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Position

 * @package frontend\models

 * 广告位

 */

class Position extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%ad_position}}";

    }



}