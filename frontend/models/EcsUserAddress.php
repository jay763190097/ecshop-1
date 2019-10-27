<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_user_address}}".
 *
 * @property string $address_id 用户表中的流水号
 * @property string $address_name 收货人的名字
 * @property string $user_id
 * @property string $consignee
 * @property string $email 收货人的email
 * @property int $country 收货人的国家
 * @property int $province
 * @property int $city
 * @property int $district
 * @property string $address 收货人的详细地址
 * @property string $zipcode 收货人的邮编
 * @property string $tel 收货人的电话
 * @property string $mobile 收货人的手机号
 * @property string $sign_building 收货地址的标志性建筑名
 * @property string $best_time 收货人的最佳收货时间
 */
class EcsUserAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_user_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'country', 'province', 'city', 'district'], 'integer'],
            [['address_name'], 'string', 'max' => 50],
            [['consignee', 'email', 'zipcode', 'tel', 'mobile'], 'string', 'max' => 60],
            [['address', 'sign_building', 'best_time'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
            'address_name' => 'Address Name',
            'user_id' => 'User ID',
            'consignee' => 'Consignee',
            'email' => 'Email',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'district' => 'District',
            'address' => 'Address',
            'zipcode' => 'Zipcode',
            'tel' => 'Tel',
            'mobile' => 'Mobile',
            'sign_building' => 'Sign Building',
            'best_time' => 'Best Time',
        ];
    }

    /**
     * 获取收货地址
     * @param $user_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function address_date($user_id){
        $date = self::find()->andWhere(['is_del'=>1,'user_id'=>$user_id])->orderBy('is_default desc')->asArray()->all();
        return $date;
    }

    /**
     * 新增收货地址
     * @param $data
     * @return int
     * @throws \yii\db\Exception
     */
    public static function add($data){
        $data['create_time'] = time();
        if($data['is_default'] == 1){
            $old_address = self::find()->andWhere(['is_del'=>1,'user_id'=>$data['user_id'],'is_default'=>1])->asArray()->one();
            if($old_address){
                $res = Yii::$app->db->createCommand()->update('ecs_user_address', ['is_default'=>0], ['address_id'=>$old_address['address_id']])->execute();
            }
        }
        $bool = Yii::$app->db->createCommand()->insert('ecs_user_address',$data)->execute();
        return $bool;
    }

    /**
     * 删除收货地址
     * @param $data
     * @param $id
     * @return int
     * @throws \yii\db\Exception
     */
    public static function del($data,$id){

        $res = Yii::$app->db->createCommand()->update('ecs_user_address', $data, ['address_id'=>$id])->execute();

        return $res;
    }

    /**
     * 修改收货地址
     * @param $data
     * @param $id
     * @param $user_id
     * @return int
     * @throws \yii\db\Exception
     */
    public static function edit($data,$id,$user_id){
        if($data['is_default'] == 1){
            $old_address = self::find()->andWhere(['is_del'=>1,'user_id'=>$user_id,'is_default'=>1])->asArray()->one();
            if($old_address){
                $res = Yii::$app->db->createCommand()->update('ecs_user_address', ['is_default'=>0], ['address_id'=>$old_address['address_id']])->execute();
            }
        }
        $res = Yii::$app->db->createCommand()->update('ecs_user_address', $data, ['address_id'=>$id])->execute();
        return $res;
    }

    /**
     * 修改地址数据
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function onedate($id){
        $date = self::find()->andWhere(['is_del'=>1,'address_id'=>$id])->asArray()->one();
        return $date;
    }
}
