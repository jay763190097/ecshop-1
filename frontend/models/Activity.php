<?php


namespace frontend\models;

use frontend\method\Method;
use yii\db\ActiveRecord;

/**
 * Class Activity
 * @package frontend\models
 * 优惠活动
 */
class Activity extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%favourable_activity}}";
    }


    public static function getActivity()
    {

        $info = self::find()
            ->where(['act_range' => 3])
            ->select(['gift', 'act_range_ext','start_time', 'end_time'])
            ->asArray()
            ->one();

        if (!empty($info)) {

            $shop_ids = explode(',', $info['act_range_ext']);

            $list = Goods::getShopByType(0, 1, 3,['in','goods_id',$shop_ids]);

            $used_time = Method::timediff(time(),(int)$info['end_time']);

            $info['list'] = $list;
            $info['used_time'] = $used_time;

            return $info;

        }

        return 0;


    }

}