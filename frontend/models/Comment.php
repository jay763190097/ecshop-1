<?php





namespace frontend\models;



use common\models\User;

use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 评论

 */

class Comment extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%comment}}";

    }



    public static function getDataList($goods_id, $page, $andWhere = [])

    {



        $user_name = User::tableName();



        $table_name = self::tableName();



        $select = [

            $table_name . '.user_name',

            $table_name . '.add_time',

            $table_name . '.image',

            $table_name . '.content',

            $table_name . '.comment_rank'

        ];



        $list = self::find()

            ->where([$table_name . '.id_value' => $goods_id, $table_name . '.status' => 1])

            ->andWhere($andWhere)

            ->limit(10)

            ->offset(($page - 1) * 10)

            ->orderBy($table_name . '.add_time desc')

            ->select($select)

            ->asArray()

            ->all();



        foreach ($list as $k => $v) {



            if (!empty($v['image'])) {

                $list[$k]['image'] = json_decode($v['image'], true);

            }



            $list[$k]['add_time'] = date('Y-m-d',$v['add_time']);

        }



        return $list;



    }



}