<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_user_bonus}}".
 *
 * @property string $bonus_id 红包的流水号
 * @property int $bonus_type_id 红包发送类型.0,按用户如会员等级,会员名称发放;1,按商品类别发送;2,按订单金额所达到的额度发送;3,线下发送
 * @property string $bonus_sn 红包号,如果为0就是没有红包号.如果大于0,就需要输入该红包号才能使用红包
 * @property string $user_id 该红包属于某会员的id.如果为0,就是该红包不属于某会员
 * @property string $used_time 红包使用的时间
 * @property string $order_id 使用了该红包的交易号
 * @property int $emailed 否已经将红包发送到用户的邮箱；1，是；0，否
 */
class EcsUserBonus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_user_bonus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bonus_type_id', 'bonus_sn', 'user_id', 'used_time', 'order_id', 'emailed'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bonus_id' => 'Bonus ID',
            'bonus_type_id' => 'Bonus Type ID',
            'bonus_sn' => 'Bonus Sn',
            'user_id' => 'User ID',
            'used_time' => 'Used Time',
            'order_id' => 'Order ID',
            'emailed' => 'Emailed',
        ];
    }

    /**
     * 订单红包
     * @param $user_id
     * @param $sum
     * @return mixed
     */
    public static function userBonus($user_id,$sum){
        $new_time = time();
        $type_money = self::find()
            ->select('ecs_user_bonus.*,ecs_bonus_type.type_money')
            ->join('left join','ecs_bonus_type','ecs_bonus_type.type_id = ecs_user_bonus.bonus_type_id')
            ->andWhere(['ecs_user_bonus.user_id'=>$user_id])
            ->andWhere(['<=','ecs_bonus_type.use_start_date',$new_time])
            ->andWhere(['>=','ecs_bonus_type.use_end_date',$new_time])
            ->andWhere(['<=','min_amount',$sum])
            ->orderBy('type_money desc')
            ->asArray()
            ->one()['type_money'];

        return $type_money;

    }
}
