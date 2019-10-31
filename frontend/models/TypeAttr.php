<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 分类属性

 */

class TypeAttr extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%attribute}}";

    }





    /**

     * @param int $type_id

     * @return array|ActiveRecord[]

     *得到一个分类的属性

     */

    public static function getDataByTypeId($type_id = 10)

    {



        $list = self::find()

            ->where(['cat_id' => $type_id, 'attr_input_type' => 1])

            ->select(['attr_id', 'attr_name', 'attr_values'])

            ->orderBy('sort_order desc')

            ->asArray()

            ->all();



        foreach ($list as $k => $v) {



            $str = str_replace("\n", ", ", $v['attr_values']);



            $str = str_replace(PHP_EOL, '', $str);



            $attr_values = explode(",", $str);

            $list[$k]['attr_values'] = [];

            foreach ($attr_values as $key=>$value){

                $list[$k]['attr_values'][]= trim($value);

            }



        }



        return $list;

    }



}