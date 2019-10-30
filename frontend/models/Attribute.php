<?php





namespace frontend\models;



use yii\db\ActiveRecord;



/**

 * Class Ad

 * @package frontend\models

 * 商品属性

 */

class Attribute extends ActiveRecord

{



    public static function tableName()

    {

        return "{{%attribute}}";

    }





    /**

     * @param $goods_id

     * @return array|ActiveRecord[]

     * 得到一个商品的所有属性

     */

    public static function getGoodsAttrName($goods_id)

    {



        $table_name = self::tableName();



        $goods_name = Goods::tableName();



        $attr_name_list = self::find()

            ->where([$goods_name . '.goods_id' => $goods_id])

            ->join('join', $goods_name, $goods_name . '.goods_type=' . $table_name . '.cat_id')

            ->select([$table_name . '.attr_name', $table_name . '.attr_id'])

            ->asArray()

            ->all();





        foreach ($attr_name_list as $k => $v) {



            $attr = GoodsAttr::getDataByGoodsId($goods_id, $v['attr_id']);



            if (empty($attr)) {

                unset($attr_name_list[$k]);

            } else {

                $attr_name_list[$k]['value'] = $attr;

            }

        }



        return $attr_name_list;





    }



}