<?php



namespace frontend\models;



use Yii;



/**

 * This is the model class for table "{{%ecs_goods_attr}}".

 *

 * @property string $goods_attr_id 	自增ID号

 * @property string $goods_id 	该具体属性属于的商品，取值于goods的goods_id

 * @property int $attr_id 该具体属性属于的属性类型的id，取自attribute 的attr_id

 * @property string $attr_value 该具体属性的值

 * @property string $attr_price 	该属性对应在商品原价格上要加的价格

 */

class EcsGoodAttr extends \yii\db\ActiveRecord

{

    /**

     * {@inheritdoc}

     */

    public static function tableName()

    {

        return '{{%goods_attr}}';

    }



    /**

     * {@inheritdoc}

     */

    public function rules()

    {

        return [

            [['goods_id', 'attr_id'], 'integer'],

            [['attr_value'], 'required'],

            [['attr_value'], 'string'],

            [['attr_price'], 'string', 'max' => 255],

        ];

    }



    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'goods_attr_id' => 'Goods Attr ID',

            'goods_id' => 'Goods ID',

            'attr_id' => 'Attr ID',

            'attr_value' => 'Attr Value',

            'attr_price' => 'Attr Price',

        ];

    }

}

