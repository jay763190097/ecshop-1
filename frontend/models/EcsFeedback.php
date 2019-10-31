<?php



namespace frontend\models;



use Yii;



/**

 * This is the model class for table "{{%ecs_feedback}}".

 *

 * @property string $msg_id 	反馈信息自增id

 * @property string $parent_id 父节点，取自该表msg_id；反馈该值为0；回复反馈为节点id

 * @property string $user_id 用户ID

 * @property string $user_name 用户名

 * @property string $user_email Email

 * @property string $msg_title 标题

 * @property int $msg_type 类型

 * @property int $msg_status

 * @property string $msg_content 内容

 * @property string $msg_time 时间

 * @property string $message_img 图片

 * @property string $order_id 是否回复

 * @property int $msg_area

 */

class EcsFeedback extends \yii\db\ActiveRecord

{

    /**

     * {@inheritdoc}

     */

    public static function tableName()

    {

        return '{{%feedback}}';

    }



    /**

     * {@inheritdoc}

     */

    public function rules()

    {

        return [

            [['parent_id', 'user_id', 'msg_type', 'msg_status', 'msg_time', 'order_id', 'msg_area'], 'integer'],

            [['msg_content'], 'required'],

            [['msg_content'], 'string'],

            [['user_name', 'user_email'], 'string', 'max' => 60],

            [['msg_title'], 'string', 'max' => 200],

            [['message_img'], 'string', 'max' => 255],

        ];

    }



    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'msg_id' => 'Msg ID',

            'parent_id' => 'Parent ID',

            'user_id' => 'User ID',

            'user_name' => 'User Name',

            'user_email' => 'User Email',

            'msg_title' => 'Msg Title',

            'msg_type' => 'Msg Type',

            'msg_status' => 'Msg Status',

            'msg_content' => 'Msg Content',

            'msg_time' => 'Msg Time',

            'message_img' => 'Message Img',

            'order_id' => 'Order ID',

            'msg_area' => 'Msg Area',

        ];

    }



    public static function add($date){

        $bool = Yii::$app->db->createCommand()->insert('ecs_feedback',$date)->execute();



        return $bool;

    }

}

