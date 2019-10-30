<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 文章表

 */

class Article extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%article}}";

    }

    public static function getDataList(){

        $list = self::find()
            ->where(['is_open'=>1,'cat_id'=>13])
            ->select(['article_id id','title','content','add_time'])
            ->orderBy('add_time desc')
            ->asArray()
            ->all();

        foreach ($list as $k=>$v){

            $list[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);

            $list[$k]['content'] = strip_tags($v['content']);

        }

        return $list;

    }

}