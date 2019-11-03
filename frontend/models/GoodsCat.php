<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 商品分类

 */

class GoodsCat extends ActiveRecord

{



    public static function tableName()
    {

        return "{{%goods_cat}}";

    }



}