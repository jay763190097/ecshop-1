<?php



namespace frontend\models;



use Yii;



/**

 * This is the model class for table "{{%ecs_order_info}}".

 *

 * @property string $order_id

 * @property string $order_sn  订单号,唯一

 * @property string $user_id 用户id,同users的user_id

 * @property int $order_status 订单的状态;0未确认,1确认,2已取消,3无效,4退货

 * @property int $shipping_status 商品配送情况;0未发货,1已发货,2已收货,4退货

 * @property int $pay_status 支付状态;0未付款;1付款中;2已付款

 * @property string $consignee 收货人的姓名,用户页面填写,默认取值表user_address

 * @property int $country 收货人的国家,用户页面填写,默认取值于表user_address,其id对应的值在region

 * @property int $province 收货人的省份,用户页面填写,默认取值于表user_address, 其id对应的值在region

 * @property int $city 收货人的城市,用户页面填写,默认取值于表user_address,其id对应的值在region

 * @property int $district 收货人的地区,用户页面填写,默认取值于表user_address,其id对应的值在region

 * @property string $address 收货人的详细地址,用户页面填写,默认取值于表user_address

 * @property string $zipcode 收货人的邮编,用户页面填写,默认取值于表user_address

 * @property string $tel 收货人的电话,用户页面填写,默认取值于表user_address

 * @property string $mobile 收货人的手机,用户页面填写,默认取值于表user_address

 * @property string $email 收货人的Email, 用户页面填写,默认取值于表user_address

 * @property string $best_time 收货人的最佳送货时间,用户页面填写,默认取值于表user_addr 

 * @property string $sign_building 送货人的地址的标志性建筑,用户页面填写,默认取值于表user_address

 * @property string $postscript 订单附言,由用户提交订单前填写

 * @property int $shipping_id 用户选择的配送方式id,取值表shipping

 * @property string $shipping_name 用户选择的配送方式的名称,取值表shipping

 * @property int $pay_id 用户选择的支付方式的id,取值表payment

 * @property string $pay_name 用户选择的支付方式名称,取值表payment

 * @property string $how_oos 缺货处理方式,等待所有商品备齐后再发,取消订单;与店主协商

 * @property string $how_surplus 根据字段猜测应该是余额处理方式,程序未作这部分实现

 * @property string $pack_name 包装名称,取值表pack

 * @property string $card_name 贺卡的名称,取值card

 * @property string $card_message 贺卡内容,由用户提交

 * @property string $inv_payee 发票抬头,用户页面填写

 * @property string $inv_content 发票内容,用户页面选择,取值shop_config的code字段的值 为invoice_content的value

 * @property string $goods_amount 商品的总金额

 * @property string $shipping_fee 配送费用

 * @property string $insure_fee 保价费用

 * @property string $pay_fee 支付费用,跟支付方式的配置相关,取值表payment

 * @property string $pack_fee 包装费用,取值表pack

 * @property string $card_fee 贺卡费用,取值card

 * @property string $goods_discount_fee 对接erp专用，商品优惠总金额

 * @property string $money_paid 已付款金额

 * @property string $surplus 该订单使用金额的数量,取用户设定余额,用户可用余额,订单金额中最小者

 * @property string $integral 使用的积分的数量,取用户使用积分,商品可用积分,用户拥有积分中最小者

 * @property string $integral_money 使用积分金额

 * @property string $bonus 使用红包金额

 * @property string $order_amount 应付款金额

 * @property int $from_ad 订单由某广告带来的广告id,应该取值于ad

 * @property string $referer 订单的来源页面

 * @property string $add_time 订单生成时间

 * @property string $confirm_time 订单确认时间

 * @property string $pay_time 订单支付时间

 * @property string $shipping_time 订单配送时间

 * @property int $pack_id 包装id,取值表pck

 * @property int $card_id 贺卡id,用户在页面选择,取值

 * @property string $bonus_id 红包id, user_bonus的bonus_id

 * @property string $invoice_no 发货时填写, 可在订单查询查看

 * @property string $extension_code 通过活动购买的商品的代号,group_buy是团购; auction是拍卖;snatch夺宝奇兵;正常普通产品该处理为空

 * @property string $extension_id 通过活动购买的物品id,取值ecs_good_activity;如果是正常普通商品,该处为0

 * @property string $to_buyer 商家给客户的留言,当该字段值时可以在订单查询看到

 * @property string $pay_note 付款备注, 在订单管理编辑修改

 * @property int $agency_id 该笔订单被指派给的办事处的id, 根据订单内容和办事处负责范围自动决定,也可以有管理员修改,取值于表agency

 * @property string $inv_type 发票类型,用户页面选择,取值shop_config的code字段的值invoice_type的value

 * @property string $tax 发票税额

 * @property int $is_separate 0未分成或等待分成;1已分成;2取消分成

 * @property string $parent_id 自增ID

 * @property string $discount  订单号,唯一

 * @property string $callback_status

 * @property string $lastmodify

 */

class EcsOrderInfo extends \yii\db\ActiveRecord

{

    /**

     * {@inheritdoc}

     */

    public static function tableName()

    {

        return '{{%order_info}}';

    }



    /**

     * {@inheritdoc}

     */

    public function rules()

    {

        return [

            [['user_id', 'order_status', 'shipping_status', 'pay_status', 'country', 'province', 'city', 'district', 'shipping_id', 'pay_id', 'integral', 'from_ad', 'add_time', 'confirm_time', 'pay_time', 'shipping_time', 'pack_id', 'card_id', 'bonus_id', 'extension_id', 'agency_id', 'is_separate', 'parent_id', 'lastmodify'], 'integer'],

            [['goods_amount', 'shipping_fee', 'insure_fee', 'pay_fee', 'pack_fee', 'card_fee', 'goods_discount_fee', 'money_paid', 'surplus', 'integral_money', 'bonus', 'order_amount', 'tax', 'discount'], 'number'],

            [['agency_id', 'inv_type', 'tax', 'discount'], 'required'],

            [['callback_status'], 'string'],

            [['order_sn'], 'string', 'max' => 20],

            [['consignee', 'zipcode', 'tel', 'mobile', 'email', 'inv_type'], 'string', 'max' => 60],

            [['address', 'postscript', 'card_message', 'referer', 'invoice_no', 'to_buyer', 'pay_note'], 'string', 'max' => 255],

            [['best_time', 'sign_building', 'shipping_name', 'pay_name', 'how_oos', 'how_surplus', 'pack_name', 'card_name', 'inv_payee', 'inv_content'], 'string', 'max' => 120],

            [['extension_code'], 'string', 'max' => 30],

            [['order_sn'], 'unique'],

        ];

    }



    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'order_id' => 'Order ID',

            'order_sn' => 'Order Sn',

            'user_id' => 'User ID',

            'order_status' => 'Order Status',

            'shipping_status' => 'Shipping Status',

            'pay_status' => 'Pay Status',

            'consignee' => 'Consignee',

            'country' => 'Country',

            'province' => 'Province',

            'city' => 'City',

            'district' => 'District',

            'address' => 'Address',

            'zipcode' => 'Zipcode',

            'tel' => 'Tel',

            'mobile' => 'Mobile',

            'email' => 'Email',

            'best_time' => 'Best Time',

            'sign_building' => 'Sign Building',

            'postscript' => 'Postscript',

            'shipping_id' => 'Shipping ID',

            'shipping_name' => 'Shipping Name',

            'pay_id' => 'Pay ID',

            'pay_name' => 'Pay Name',

            'how_oos' => 'How Oos',

            'how_surplus' => 'How Surplus',

            'pack_name' => 'Pack Name',

            'card_name' => 'Card Name',

            'card_message' => 'Card Message',

            'inv_payee' => 'Inv Payee',

            'inv_content' => 'Inv Content',

            'goods_amount' => 'Goods Amount',

            'shipping_fee' => 'Shipping Fee',

            'insure_fee' => 'Insure Fee',

            'pay_fee' => 'Pay Fee',

            'pack_fee' => 'Pack Fee',

            'card_fee' => 'Card Fee',

            'goods_discount_fee' => 'Goods Discount Fee',

            'money_paid' => 'Money Paid',

            'surplus' => 'Surplus',

            'integral' => 'Integral',

            'integral_money' => 'Integral Money',

            'bonus' => 'Bonus',

            'order_amount' => 'Order Amount',

            'from_ad' => 'From Ad',

            'referer' => 'Referer',

            'add_time' => 'Add Time',

            'confirm_time' => 'Confirm Time',

            'pay_time' => 'Pay Time',

            'shipping_time' => 'Shipping Time',

            'pack_id' => 'Pack ID',

            'card_id' => 'Card ID',

            'bonus_id' => 'Bonus ID',

            'invoice_no' => 'Invoice No',

            'extension_code' => 'Extension Code',

            'extension_id' => 'Extension ID',

            'to_buyer' => 'To Buyer',

            'pay_note' => 'Pay Note',

            'agency_id' => 'Agency ID',

            'inv_type' => 'Inv Type',

            'tax' => 'Tax',

            'is_separate' => 'Is Separate',

            'parent_id' => 'Parent ID',

            'discount' => 'Discount',

            'callback_status' => 'Callback Status',

            'lastmodify' => 'Lastmodify',

        ];

    }


    /**
     * 订单统计
     * @param $user_id
     * @return array
     */
    public static function order($user_id){

        //待付款

        $obligationcount = self::find()->andWhere(['user_id'=>$user_id,'pay_status'=>0,'order_status'=>1,'is_del'=>1])->count();

        //待收货

        $receivingcount = self::find()->andWhere(['user_id'=>$user_id,'shipping_status'=>1,'pay_status'=>2,'is_del'=>1])->count();

        //未评论

        $commentcount = self::find()->andWhere(['user_id'=>$user_id,'is_del'=>1,'shipping_status'=>2,'pay_status'=>2])->count();

        //退换货

        $replacementcount = self::find()->andWhere(['user_id'=>$user_id,'is_del'=>1,'shipping_status'=>4])->count();



        return ['obligationcount'=>$obligationcount,'receivingcount'=>$receivingcount,'commentcount'=>$commentcount,'replacementcount'=>$replacementcount];

    }

    /**
     * 确认订单
     * @param $goods_date
     * @param $order
     * @return bool
     */
    public static function add($goods_date,$order){

        $transaction = Yii::$app->db->beginTransaction();
        try{
            //修改sx_build_grade中的数据
            $res = Yii::$app->db->createCommand()->insert(self::tableName(), $order)->execute();
            if(!$res)
                throw new \Exception('操作失败！');

            //修改$model对应的$relation中的数据

            $last_id = Yii::$app->db->getLastInsertID();

            foreach ($goods_date as $key =>$value){
                $value['order_id'] = $last_id;
                $rt = Yii::$app->db->createCommand()->insert('ecs_order_goods', $value)->execute();
            }

            if(!$rt)
                throw new \Exception('操作失败！');

            //以上执行都成功，则对数据库进行实际执行
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            //如果抛出错误则进入catch，先callback，然后捕获错误，返回错误
            $transaction->rollBack();
            var_dump($e);
            return false;
        }
    }

    /**
     * 我的订单信息
     * @param $user_id
     * @param $type
     * @return array
     */
    public static function order_date($user_id,$type){
        $orderList = [];
        if($type == 5){
            $date = EcsOrderGoods::find()
                ->select('ecs_order_info.order_id,ecs_order_info.order_sn,ecs_order_info.order_status,ecs_order_info.shipping_status,ecs_order_info.pay_status,ecs_order_info.goods_amount,ecs_order_info.goods_count,
            ecs_order_goods.order_id as goodes_order_id,ecs_order_goods.goods_name,ecs_order_goods.goods_number,ecs_order_goods.market_price,ecs_order_goods.goods_price,ecs_order_goods.goods_attr,ecs_order_goods.goods_attr_id,ecs_order_goods.goods_id,
            ecs_goods.goods_thumb')
                ->join('left join','ecs_order_info','ecs_order_info.order_id = ecs_order_goods.order_id')
                ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_order_goods.goods_id')
                ->andWhere(['ecs_order_info.user_id'=>$user_id])
                ->orderBy('ecs_order_info.order_id desc')
                ->asArray()
                ->all();
        }elseif ($type == 1){
            $date = EcsOrderGoods::find()
                ->select('ecs_order_info.order_id,ecs_order_info.order_sn,ecs_order_info.order_status,ecs_order_info.shipping_status,ecs_order_info.pay_status,ecs_order_info.goods_amount,ecs_order_info.goods_count,
            ecs_order_goods.order_id as goodes_order_id,ecs_order_goods.goods_name,ecs_order_goods.goods_number,ecs_order_goods.market_price,ecs_order_goods.goods_price,ecs_order_goods.goods_attr,ecs_order_goods.goods_attr_id,ecs_order_goods.goods_id,
            ecs_goods.goods_thumb')
                ->join('left join','ecs_order_info','ecs_order_info.order_id = ecs_order_goods.order_id')
                ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_order_goods.goods_id')
                ->andWhere(['ecs_order_info.user_id'=>$user_id])
                ->andWhere(['ecs_order_info.pay_status'=>0])
                ->orderBy('ecs_order_info.order_id desc')
                ->asArray()
                ->all();
        }elseif ($type == 2){
            $date = EcsOrderGoods::find()
                ->select('ecs_order_info.order_id,ecs_order_info.order_sn,ecs_order_info.order_status,ecs_order_info.shipping_status,ecs_order_info.pay_status,ecs_order_info.goods_amount,ecs_order_info.goods_count,
            ecs_order_goods.order_id as goodes_order_id,ecs_order_goods.goods_name,ecs_order_goods.goods_number,ecs_order_goods.market_price,ecs_order_goods.goods_price,ecs_order_goods.goods_attr,ecs_order_goods.goods_attr_id,ecs_order_goods.goods_id,
            ecs_goods.goods_thumb')
                ->join('left join','ecs_order_info','ecs_order_info.order_id = ecs_order_goods.order_id')
                ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_order_goods.goods_id')
                ->andWhere(['ecs_order_info.user_id'=>$user_id])
                ->andWhere(['ecs_order_info.pay_status'=>2])
                ->andWhere(['ecs_order_info.shipping_status'=>1])
                ->andWhere(['ecs_order_info.order_status'=>1])
                ->orderBy('ecs_order_info.order_id desc')
                ->asArray()
                ->all();
        }elseif ($type == 3){
            $date = EcsOrderGoods::find()
                ->select('ecs_order_info.order_id,ecs_order_info.order_sn,ecs_order_info.order_status,ecs_order_info.shipping_status,ecs_order_info.pay_status,ecs_order_info.goods_amount,ecs_order_info.goods_count,
            ecs_order_goods.order_id as goodes_order_id,ecs_order_goods.goods_name,ecs_order_goods.goods_number,ecs_order_goods.market_price,ecs_order_goods.goods_price,ecs_order_goods.goods_attr,ecs_order_goods.goods_attr_id,ecs_order_goods.goods_id,
            ecs_goods.goods_thumb')
                ->join('left join','ecs_order_info','ecs_order_info.order_id = ecs_order_goods.order_id')
                ->join('left join','ecs_goods','ecs_goods.goods_id = ecs_order_goods.goods_id')
                ->andWhere(['ecs_order_info.user_id'=>$user_id])
                ->andWhere(['ecs_order_info.pay_status'=>2])
                ->andWhere(['ecs_order_info.shipping_status'=>2])
                ->andWhere(['ecs_order_info.order_status'=>1])
                ->orderBy('ecs_order_info.order_id desc')
                ->asArray()
                ->all();
        }

        if(!empty($date)){
            foreach ($date as $key=>$value){
                if(!isset($orderList[ $value['order_sn'] ])){
                    $orderList[ $value['order_sn'] ] = [
                        'order_id'=>$value['order_id'],
                        'orderSn' 	=> $value['order_sn'],
                        'goods_amount' => $value['goods_amount'],
                        'goods_count' => $value['goods_count'],
                        'order_status' => $value['order_status'],
                        'shipping_status'=>$value['shipping_status'],
                        'pay_status'=>$value['pay_status'],
                        'list'		=> [],
                    ];
                }

                $value['goods_attr_id'] =  EcsGoodAttr::find()->andWhere(['in','goods_attr_id',explode(',',$value['goods_attr_id'])])->asArray()->all();
                $attrdate = array_column($value['goods_attr_id'], 'attr_value');
                $orderList[ $value['order_sn'] ]['list'][] = [
                    'goodes_order_id'=>$value['goodes_order_id'],
                    'goods_id' => $value['goods_id'],
                    'goods_name' => $value['goods_name'],
                    'goods_number' => $value['goods_number'],
                    'market_price' => $value['market_price'],
                    'goods_price' => $value['goods_price'],
                    'goods_attr' => EcsAttribute::find()->andWhere(['attr_id'=>$value['goods_attr']])->asArray()->one()['attr_name'],
                    'goods_attr_id' => implode(',',$attrdate),
                    'goods_thumb' => $value['goods_thumb'],
                ];
            }
        }
            return $orderList;
        }
}

