<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_bonus_type}}".
 *
 * @property int $type_id 红包类型流水号
 * @property string $type_name 	红包名称
 * @property string $type_money 	红包所值的金额
 * @property int $send_type 	红包发送类型0按用户如会员等级,会员名称发放;1按商品类别发送;2按订单金额所达到的额度发送;3线下发送
 * @property string $min_amount 	如果按金额发送红包,该项是最小金额,即只要购买超过该金额的商品都可以领到红包 
 * @property string $max_amount
 * @property int $send_start_date 	红包发送的开始时间
 * @property int $send_end_date 红包发送的结束时间
 * @property int $use_start_date 	红包可以使用的开始时间
 * @property int $use_end_date 	红包可以使用的结束时间
 * @property string $min_goods_amount 	可以使用该红包的商品的最低价格,即只要达到该价格商品才可以使用红包
 */
class EcsBonusType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_bonus_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_money', 'min_amount', 'max_amount', 'min_goods_amount'], 'number'],
            [['send_type', 'send_start_date', 'send_end_date', 'use_start_date', 'use_end_date'], 'integer'],
            [['type_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
            'type_money' => 'Type Money',
            'send_type' => 'Send Type',
            'min_amount' => 'Min Amount',
            'max_amount' => 'Max Amount',
            'send_start_date' => 'Send Start Date',
            'send_end_date' => 'Send End Date',
            'use_start_date' => 'Use Start Date',
            'use_end_date' => 'Use End Date',
            'min_goods_amount' => 'Min Goods Amount',
        ];
    }
}
