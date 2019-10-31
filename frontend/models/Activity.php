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





    /**

     * @return array|int|ActiveRecord|null

     * 获取首页显示的优惠信息

     */

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



    /**

     *  得到优惠活动的剩余时间

     */

    public static function getDataInfo(){



        $info = self::find()

            ->where(['act_range' => 3])

            ->select(['gift', 'act_range_ext','start_time', 'end_time'])

            ->asArray()

            ->one();



        $used_time = Method::timediff(time(),(int)$info['end_time']);



        $used_time['start_time'] = date('Y-m-d',$info['start_time']);

        $used_time['end_time'] = date('Y-m-d',$info['end_time']);



        $used_time['start_month'] = ((int)substr($used_time['start_time'],5,2));//取得月份

        $used_time['start_day']   = ((int)substr($used_time['start_time'],8,2));//取得几号



        $used_time['end_month'] = ((int)substr($used_time['end_time'],5,2));//取得月份

        $used_time['end_day']   = ((int)substr($used_time['end_time'],8,2));//取得几号





        return $used_time;



    }







}