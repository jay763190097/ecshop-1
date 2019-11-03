<?php


namespace frontend\models;


use frontend\method\Method;
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


    /**
     *  得到全部的商品类型
     */
    public static function getDataAll()
    {

        $list = self::find()
            ->select(['cat_id', 'parent_id', 'cat_name'])
            ->asArray()
            ->all();


        $list = Method::list_to_tree($list, 'cat_id', 'parent_id');

        foreach ($list as $k=>$v){
            if (empty($v['son_list'])){
                unset($list[$k]);
            }
        }

        return $list;
    }


}