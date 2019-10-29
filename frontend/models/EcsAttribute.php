<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_attribute}}".
 *
 * @property int $attr_id 	自增 ID
 * @property int $cat_id 	商品类型 , 同goods_type的 cat_id
 * @property string $attr_name 	属性名称
 * @property int $attr_input_type 	当添加商品时,该属性的添加类别; 0为手功输入;1为选择输入;2为多行文本输入
 * @property int $attr_type 	属性是否多选; 0否; 1是 如果可以多选,则可以自定义属性,并且可以根据值的不同定不同的价
 * @property string $attr_values 即选择输入,则attr_name对应的值的取值就是该这字段值 
 * @property int $attr_index 属性是否可以检索;0不需要检索; 1关键字检索2范围检索,该属性应该是如果检索的话,可以通过该属性找到有该属性的商品
 * @property int $sort_order 属性显示的顺序,数字越大越靠前,如果数字一样则按id顺序
 * @property int $is_linked 	是否关联,0 不关联 1关联; 如果关联, 那么用户在购买该商品时,具有有该属性相同的商品将被推荐给用户
 * @property int $attr_group 	属性分组,相同的为一个属性组应该取自goods_type的attr_group的值的顺序.
 */
class EcsAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'attr_input_type', 'attr_type', 'attr_index', 'sort_order', 'is_linked', 'attr_group'], 'integer'],
            [['attr_values'], 'required'],
            [['attr_values'], 'string'],
            [['attr_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attr_id' => 'Attr ID',
            'cat_id' => 'Cat ID',
            'attr_name' => 'Attr Name',
            'attr_input_type' => 'Attr Input Type',
            'attr_type' => 'Attr Type',
            'attr_values' => 'Attr Values',
            'attr_index' => 'Attr Index',
            'sort_order' => 'Sort Order',
            'is_linked' => 'Is Linked',
            'attr_group' => 'Attr Group',
        ];
    }
}
