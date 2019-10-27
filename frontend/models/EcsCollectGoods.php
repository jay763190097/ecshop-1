<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_collect_goods}}".
 *
 * @property string $rec_id 收藏记录的自增id
 * @property string $user_id 该条收藏记录的会员id，取值于users的user_id
 * @property string $goods_id 	收藏的商品id，取值于goods的goods_id
 * @property string $add_time 	收藏时间
 * @property int $is_attention 是否关注该收藏商品;1是;0否
 */
class EcsCollectGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_collect_goods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'add_time', 'is_attention'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rec_id' => 'Rec ID',
            'user_id' => 'User ID',
            'goods_id' => 'Goods ID',
            'add_time' => 'Add Time',
            'is_attention' => 'Is Attention',
        ];
    }

    public  static function collection($id){

        $date = self::find()
            ->select('ecs_collect_goods.*,ecs_goods.goods_thumb,ecs_goods.goods_name,ecs_goods.shop_price,ecs_goods.suppliers_id')
            ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_collect_goods.goods_id')
            ->andWhere(['ecs_collect_goods.user_id'=>$id])
            ->asArray()
            ->all();

        foreach ($date as $k => $v) {
            $date[$k]['goods_thumb'] = \Yii::$app->params['admin_url'] . '/' . $v['goods_thumb'];
        }
        return $date;
    }
}
