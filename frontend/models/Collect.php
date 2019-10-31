<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 收藏

 */

class Collect extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%collect_goods}}";

    }





    /**

     * @param $goods_id

     * @return int|string

     * 判断当前用户是否收藏了商品

     */

    public static function getUserCollectById($goods_id)

    {



        if (\Yii::$app->session->has('user_date')) {



            $user_id = \Yii::$app->session->get('user_date');



            $info = self::find()

                ->where(['user_id' => $user_id, 'goods_id' => $goods_id])

                ->count();

        } else {

            $info = 0;

        }



        return $info;



    }



    /**

     * @param $user_id

     * @param $goods_id

     * 取消收藏

     */

    public static function cancelCollect($user_id, $goods_id)

    {



        $flag = \Yii::$app->db->createCommand()->delete(self::tableName(), ['user_id' => $user_id, 'goods_id' => $goods_id])->execute();



        return $flag;



    }



    /**

     * @param $user_id

     * @param $goods_id

     * @return int

     * @throws \yii\db\Exception

     * 添加收藏

     */

    public static function addCollect($user_id, $goods_id)

    {



        $flag = \Yii::$app->db->createCommand()->insert(self::tableName(), ['user_id' => $user_id, 'goods_id' => $goods_id, 'add_time' => time()])->execute();



        return $flag;



    }



}