<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%sx_user_code}}".
 *
 * @property string $id
 * @property string $phone 手机号码
 * @property string $code 验证码
 * @property int $res 是否发送成功 1-失败 0-成功
 * @property string $date 添加时间
 * @property int $add_time 添加时间
 */
class SxUserCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sx_user_code}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['res', 'add_time'], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['code'], 'string', 'max' => 8],
            [['date'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'code' => 'Code',
            'res' => 'Res',
            'date' => 'Date',
            'add_time' => 'Add Time',
        ];
    }

}
