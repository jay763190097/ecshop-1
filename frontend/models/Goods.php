<?php


namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Goods
 * @package frontend\models
 * 商品
 */
class Goods extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%goods}}";
    }


    /**
     * @param $type 0：不限；1：自营；2：海淘
     * @param $page 页数
     * @param $limit 显示的个数
     * @return array|ActiveRecord[]
     * 得到商品列表
     */
    public static function getShopByType($type, $page, $limit, $andWher = [])
    {

        $where = ['is_delete' => 0, 'is_alone_sale' => 1, 'is_on_sale' => 1];

        if (!empty($type)) {
            $where['suppliers_id'] = $type;
        }

        $select = ['goods_id','goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

        $list = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->orderBy('click_count desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select($select)
            ->asArray()
            ->all();

        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return $list;

    }


    /**
     * @param $type 0：不限；1：自营；2：海淘
     * @param $page 页数
     * @param $limit 显示的个数
     * @return array|ActiveRecord[]
     * 得到商品列表
     */
    public static function getShopByTypePage($type, $page, $limit, $andWher = [])
    {

        $where = ['is_delete' => 0, 'is_alone_sale' => 1, 'is_on_sale' => 1];

        if (!empty($type)) {
            $where['suppliers_id'] = $type;
        }

        $select = ['goods_id','goods_name', 'virtual_sales', 'goods_thumb', 'shop_price', 'suppliers_id'];

        $list = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->orderBy('click_count desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select($select)
            ->asArray()
            ->all();

        $count = self::find()
            ->where($where)
            ->andWhere($andWher)
            ->count();

        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count];

    }


    public static function getTypeAll($page, $where, $andWhere, $order,$like)
    {

        $table_name = self::tableName();//商品表

        $goodsAttr_name = GoodsAttr::tableName();//商品属性表

        $select = [$table_name.'.goods_id',$table_name.'.goods_name', $table_name.'.virtual_sales', $table_name.'.goods_thumb', $table_name.'.shop_price', $table_name.'.suppliers_id'];


        $list = self::find()
            ->where([$table_name . '.is_on_sale' => 1,
                $table_name . '.is_alone_sale' => 1,
                $table_name . '.is_delete' => 0,
            ])
            ->andWhere($like)
            ->andWhere($where)
            ->andWhere($andWhere)
            ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
            ->limit(10)
            ->offset(($page - 1) * 10)
            ->orderBy($order)
            ->select($select)
            ->groupBy($table_name.'.goods_id')
            ->asArray()
            ->all();


//        var_dump(
//
//            self::find()
//                ->where([$table_name . '.is_on_sale' => 1,
//                    $table_name . '.is_alone_sale' => 1,
//                    $table_name . '.is_delete' => 0,
//                ])
//                ->andWhere($where)
//                ->andWhere($andWhere)
//                ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
//                ->limit(10)
//                ->offset(($page - 1) * 10)
//                ->orderBy($order)
//                ->select($select)
//                ->groupBy($table_name.'.goods_id')->createCommand()->getRawSql()
//
//        );exit();

        $count = self::find()
            ->where([$table_name . '.is_on_sale' => 1,
                $table_name . '.is_alone_sale' => 1,
                $table_name . '.is_delete' => 0,
            ])
            ->andWhere($where)
            ->andWhere($andWhere)
            ->join('join', $goodsAttr_name, $goodsAttr_name . '.goods_id=' . $table_name . '.goods_id')
            ->groupBy($table_name.'.goods_id')
            ->count();


        foreach ($list as $k => $v) {

            $list[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];

        }

        return ['list' => $list, 'count' => $count];

    }

    /**
     * @param $id
     * @return array|ActiveRecord[]
     * 得到某个商品的图片
     */
    public static function getGoodsImage($id){
        //商品图片
        $image_list = GoodsImage::find()->where(['goods_id'=>$id])->select(['img_url img'])->asArray()->all();

        foreach ($image_list as $k=>$v){

            $image_list[$k]['img'] = \Yii::$app->params['admin_url'] .'/'. $v['img'];

        }

        return $image_list;

    }


    public static function getGoodsInfoById($id){

        $table_name = self::tableName();

        $type_name = Category::tableName();

        $select = [
            $type_name.'.filter_attr',
            $table_name.'.goods_desc',
            $table_name.'.goods_number',
            $table_name.'.goods_id',
            $table_name.'.goods_name',
            $table_name.'.is_promote',
            $table_name.'.bonus_type_id',
            $table_name.'.promote_price',//促销价
            $table_name.'.shop_price',//实际售价
            $table_name.'.is_promote',//是否特价促销；0，否；1，是
            $table_name.'.goods_id'
        ];

        $info = self::find()
            ->where([$table_name.'.goods_id'=>$id,$type_name.'.is_show'=>1])
            ->join('join',$type_name,$type_name.'.cat_id='.$table_name.'.cat_id')
            ->select($select)
            ->asArray()
            ->one();


        $info['price'] = $info['shop_price'];

        if ($info['is_promote'] == 1){
            $info['price'] = $info['promote_price'];
        }

        return $info;

    }

}