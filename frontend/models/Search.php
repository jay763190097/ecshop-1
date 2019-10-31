<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 搜索

 */

class Search extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%search_history}}";

    }


    /**
     * @return array|Article[]|Comment[]|Search[]|UserRed[]|ActiveRecord[]
     * 热门搜索
     */
    public static function getHot(){

        $list = self::find()
            ->where(['is_del'=>1])
            ->groupBy('keyword')
            ->select(['count(keyword) num','keyword','id'])
            ->orderBy('num desc')
            ->limit(10)
            ->asArray()
            ->all();

        return $list;

    }


    /**
     * @param $user_id
     * 得到一个人的搜索记录
     */
    public static function getUserid($user_id){

        $list = self::find()
            ->where(['user_id'=>$user_id,'is_del'=>1])
            ->orderBy('create_time desc')
            ->limit(10)
            ->select(['keyword','id'])
            ->asArray()
            ->all();
        return $list;

    }

}