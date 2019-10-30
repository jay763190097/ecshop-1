<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_shop_config}}".
 *
 * @property int $id
 * @property int $parent_id 父节点id，取值于该表id字段的值
 * @property string $code 跟变量名的作用差不多，其实就是语言包中的字符串索引，如$_LANG[''cfg_range''][''cart_confirm'']
 * @property string $type 该配置的类型，text，文本输入框
 * @property string $store_range 当语言包中的code字段对应的是一个数组时，那该处就是该数组的索引，如$_LANG[''cfg_range''][''cart_confirm''][1]；只有type字段为select,options时才有值'
 * @property string $store_dir 当type为file时才有值，文件上传后的保存目录
 * @property string $value 该项配置的值
 * @property int $sort_order 显示顺序，数字越大越靠后
 */
class EcsShopConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_shop_config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_order'], 'integer'],
            [['value'], 'required'],
            [['value'], 'string'],
            [['code'], 'string', 'max' => 30],
            [['type'], 'string', 'max' => 10],
            [['store_range', 'store_dir'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'code' => 'Code',
            'type' => 'Type',
            'store_range' => 'Store Range',
            'store_dir' => 'Store Dir',
            'value' => 'Value',
            'sort_order' => 'Sort Order',
        ];
    }
}
