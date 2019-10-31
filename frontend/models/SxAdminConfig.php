<?php



namespace frontend\models;



use Yii;



/**

 * This is the model class for table "{{%sx_admin_config}}".

 *

 * @property string $id

 * @property string $name 名称

 * @property string $title 标题

 * @property string $type 类型

 * @property string $group 分组：basic基本，system系统，upload上传

 * @property string $value 配置值

 * @property string $options 配置项

 * @property string $tips 配置说明

 * @property string $create_time 创建时间

 * @property string $update_time 更新时间

 * @property int $sort 排序

 * @property string $img_url 图片域名

 * @property int $status 状态：0禁用，1启用

 * @property int $is_del 删除标识：0删除，1不删除

 */

class SxAdminConfig extends \yii\db\ActiveRecord

{

    /**

     * {@inheritdoc}

     */

    public static function tableName()

    {

        return '{{%sx_admin_config}}';

    }



    /**

     * {@inheritdoc}

     */

    public function rules()

    {

        return [

            [['value', 'options'], 'required'],

            [['value', 'options'], 'string'],

            [['create_time', 'update_time', 'sort', 'status', 'is_del'], 'integer'],

            [['name'], 'string', 'max' => 64],

            [['title', 'type'], 'string', 'max' => 32],

            [['group'], 'string', 'max' => 60],

            [['tips', 'img_url'], 'string', 'max' => 255],

        ];

    }



    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'id' => 'ID',

            'name' => 'Name',

            'title' => 'Title',

            'type' => 'Type',

            'group' => 'Group',

            'value' => 'Value',

            'options' => 'Options',

            'tips' => 'Tips',

            'create_time' => 'Create Time',

            'update_time' => 'Update Time',

            'sort' => 'Sort',

            'img_url' => 'Img Url',

            'status' => 'Status',

            'is_del' => 'Is Del',

        ];

    }

}

