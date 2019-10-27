<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Ad
 * @package frontend\models
 * 红包类型
 */
class RedType extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%bonus_type}}";
    }


    /**
     * @return array|ActiveRecord[]
     * 得到订单红包
     */
    public static function getDataAll(){

        $select = [
            'type_id',
            'type_money',//红包金额
            'send_type',//红包类型
            'min_amount',//订单最小金额
            'use_start_date',//红包使用开始时间
            'use_end_date',//红包使用结束时间
            'min_goods_amount',//可以使用该红包的商品的最低价格,即只要达到该价格商品才可以使用红包
        ];


        $list = self::find()
            ->where(['>','send_start_date',time()])
            ->andWhere(['<','send_end_date',time()])
            ->andWhere(['send_type'=>2])
            ->select($select)
            ->asArray()
            ->all();

        return $list;



    }


}