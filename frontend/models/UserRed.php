<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 我的红包

 */

class UserRed extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%user_bonus}}";

    }





    /**

     * @param $user_id

     * 我的红包列表

     */

    public static function getDataByUserId($user_id)

    {



        $select = [

            'bonus_type_id'

        ];



        $list = self::find()

            ->where(['user_id' => $user_id])

            ->select($select)

            ->asArray()

            ->all();



        $list = array_column($list,'bonus_type_id');



        return $list;



    }



}