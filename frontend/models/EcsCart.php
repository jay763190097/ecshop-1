<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_cart}}".
 *
 * @property string $rec_id 自增id号
 * @property string $user_id 用户登录ID;取自session
 * @property string $session_id 如果该用户退出,该Session_id对应的购物车中所有记录都将被删除
 * @property string $goods_id
 * @property string $goods_sn
 * @property string $product_id
 * @property string $goods_name 商品名称,取自表goods的goods_name
 * @property string $market_price 商品的本店价,取自表市场价
 * @property string $goods_price 商品的本店价,取自表goods的shop_price
 * @property int $goods_number 商品的购买数量,在购物车时,实际库存不减少
 * @property string $goods_attr 商品的扩展属性, 取自goods的extension_code
 * @property int $is_real 取自ecs_goods的is_real
 * @property string $extension_code 	商品的扩展属性,取自goods的extension_code
 * @property string $parent_id 该商品的父商品ID,没有该值为0,有的话那该商品就是该id的配件
 * @property int $rec_type 	购物车商品类型;0普通;1团够;2拍卖;3夺宝奇兵
 * @property int $is_gift 是否赠品,0否;其他, 是参加优惠活动的id,取值于favourable_activity的act_id
 * @property int $is_shipping
 * @property int $can_handsel 能否处理
 * @property string $goods_attr_id 该商品的属性的id,取自goods_attr的goods_attr_id,如果有多个,只记录了最后一个,可能是bug
 */
class EcsCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'product_id', 'goods_number', 'is_real', 'parent_id', 'rec_type', 'is_gift', 'is_shipping', 'can_handsel'], 'integer'],
            [['market_price', 'goods_price'], 'number'],
            [['goods_attr'], 'required'],
            [['goods_attr'], 'string'],
            [['session_id'], 'string', 'max' => 32],
            [['goods_sn'], 'string', 'max' => 60],
            [['goods_name'], 'string', 'max' => 120],
            [['extension_code'], 'string', 'max' => 30],
            [['goods_attr_id'], 'string', 'max' => 255],
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
            'session_id' => 'Session ID',
            'goods_id' => 'Goods ID',
            'goods_sn' => 'Goods Sn',
            'product_id' => 'Product ID',
            'goods_name' => 'Goods Name',
            'market_price' => 'Market Price',
            'goods_price' => 'Goods Price',
            'goods_number' => 'Goods Number',
            'goods_attr' => 'Goods Attr',
            'is_real' => 'Is Real',
            'extension_code' => 'Extension Code',
            'parent_id' => 'Parent ID',
            'rec_type' => 'Rec Type',
            'is_gift' => 'Is Gift',
            'is_shipping' => 'Is Shipping',
            'can_handsel' => 'Can Handsel',
            'goods_attr_id' => 'Goods Attr ID',
        ];
    }

    /**
     * 购物车信息
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function cartdate($id){
        $date = self::find()
                ->select('ecs_cart.*,ecs_goods.goods_thumb')
                ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_cart.goods_id')
                ->andWhere(['ecs_cart.user_id'=>$id,'ecs_cart.is_del'=>1])
                ->asArray()
                ->all();

        foreach ($date as $key=>$value){
            $date[$key]['goods_attr'] = EcsAttribute::find()->andWhere(['attr_id'=>$value['goods_attr']])->asArray()->one()['attr_name'];
            $attr_id = explode(",", $value['goods_attr_id']);
            $attrdate = EcsGoodAttr::find()->select('attr_value')->andWhere(['in','goods_attr_id',$attr_id])->asArray()->all();
            $attrdate = array_column($attrdate, 'attr_value');
            $date[$key]['goods_attr_id'] = implode(',',$attrdate);
        }
        return $date;
    }

    /**
     * 删除购物车信息
     * @param $ids
     * @return int
     * @throws \yii\db\Exception
     */
    public static function del($ids){
        $res = Yii::$app->db->createCommand()->update('ecs_cart', ['is_del'=>0,'update_time'=>time()], ['in','rec_id',$ids])->execute();
        return $res;
    }

    /**
     * 购物车生出订单信息
     * @param $cart_id
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function good_date($cart_id){
        $date = self::find()
            ->select('ecs_cart.*,ecs_goods.goods_thumb')
            ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_cart.goods_id')
            ->andWhere(['ecs_cart.rec_id'=>$cart_id,'ecs_cart.is_del'=>1])
            ->asArray()
            ->one();

        $date['goods_attr'] = EcsAttribute::find()->andWhere(['attr_id'=>$date['goods_attr']])->asArray()->one()['attr_name'];
        $attr_id = explode(",", $date['goods_attr_id']);
        $attrdate = EcsGoodAttr::find()->select('attr_value')->andWhere(['in','goods_attr_id',$attr_id])->asArray()->all();
        $attrdate = array_column($attrdate, 'attr_value');
        $date['goods_attr_id'] = implode(',',$attrdate);

        $res_date = [
            'goods_id'=>$date['goods_id'],
            'goods_name'=>$date['goods_name'],
            'goods_price'=>$date['goods_price'],
            'market_price'=>$date['market_price'],
            'goods_attr'=>$date['goods_attr'],
            'goods_attr_id'=>$date['goods_attr_id'],
            'goods_thumb'=>$date['goods_thumb']
        ];
        return $res_date;
    }
}
