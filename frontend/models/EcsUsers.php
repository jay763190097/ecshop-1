<?php



namespace frontend\models;



use Yii;

use yii\web\IdentityInterface;

/**

 * This is the model class for table "{{%ecs_users}}".

 *

 * @property string $user_id

 * @property string $email 会员Email

 * @property string $user_name 用户名

 * @property string $password

 * @property string $question 密码提问

 * @property string $answer 密码回答

 * @property int $sex 性别 ;  0保密;  1男; 2女

 * @property string $birthday 出生日期

 * @property string $user_money 用户现有资金

 * @property string $frozen_money 用户冻结资金

 * @property string $pay_points 消费积分

 * @property string $rank_points 会员等级积分

 * @property string $address_id 收货信息id,表值表user_address

 * @property string $reg_time 注册时间 

 * @property string $last_login 最后一次登录时间

 * @property string $last_time 应该是最后一次修改信息时间，该表信息从其他表同步过来考虑

 * @property string $last_ip 最后一次登录IP

 * @property int $visit_count 员登记id，取值user_rank

 * @property int $user_rank 会员登记id，取值user_rank

 * @property int $is_special 是否特殊

 * @property string $ec_salt

 * @property string $salt

 * @property int $parent_id 推荐人会员id

 * @property int $flag 标识

 * @property string $alias 昵称

 * @property string $msn msn账号

 * @property string $qq Qq账号

 * @property string $office_phone 办公电话

 * @property string $home_phone 家用电话

 * @property string $mobile_phone 移动电话

 * @property int $is_validated 是否生效

 * @property string $credit_line 最大消费

 * @property string $passwd_question

 * @property string $passwd_answer

 */

class EcsUsers extends \yii\db\ActiveRecord

{

    /**

     * {@inheritdoc}

     */

    public static function tableName()

    {

        return '{{%users}}';

    }



    /**

     * {@inheritdoc}

     */

    public function rules()

    {

        return [

            [['sex', 'pay_points', 'rank_points', 'address_id', 'reg_time', 'last_login', 'visit_count', 'user_rank', 'is_special', 'parent_id', 'flag', 'is_validated'], 'integer'],

            [['birthday', 'last_time'], 'safe'],

            [['user_money', 'frozen_money', 'credit_line'], 'number'],

            [['alias', 'msn', 'qq', 'office_phone', 'home_phone', 'mobile_phone', 'credit_line'], 'required'],

            [['email', 'user_name', 'alias', 'msn'], 'string', 'max' => 60],

            [['password'], 'string', 'max' => 32],

            [['question', 'answer', 'passwd_answer'], 'string', 'max' => 255],

            [['last_ip'], 'string', 'max' => 15],

            [['ec_salt', 'salt'], 'string', 'max' => 10],

            [['qq', 'office_phone', 'home_phone', 'mobile_phone'], 'string', 'max' => 20],

            [['passwd_question'], 'string', 'max' => 50],

            [['user_name'], 'unique'],

        ];

    }



    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'user_id' => 'User ID',

            'email' => 'Email',

            'user_name' => 'User Name',

            'password' => 'Password',

            'question' => 'Question',

            'answer' => 'Answer',

            'sex' => 'Sex',

            'birthday' => 'Birthday',

            'user_money' => 'User Money',

            'frozen_money' => 'Frozen Money',

            'pay_points' => 'Pay Points',

            'rank_points' => 'Rank Points',

            'address_id' => 'Address ID',

            'reg_time' => 'Reg Time',

            'last_login' => 'Last Login',

            'last_time' => 'Last Time',

            'last_ip' => 'Last Ip',

            'visit_count' => 'Visit Count',

            'user_rank' => 'User Rank',

            'is_special' => 'Is Special',

            'ec_salt' => 'Ec Salt',

            'salt' => 'Salt',

            'parent_id' => 'Parent ID',

            'flag' => 'Flag',

            'alias' => 'Alias',

            'msn' => 'Msn',

            'qq' => 'Qq',

            'office_phone' => 'Office Phone',

            'home_phone' => 'Home Phone',

            'mobile_phone' => 'Mobile Phone',

            'is_validated' => 'Is Validated',

            'credit_line' => 'Credit Line',

            'passwd_question' => 'Passwd Question',

            'passwd_answer' => 'Passwd Answer',

        ];

    }



    public static function edit($data,$id){
        $data['update_time'] = time();
        $res = Yii::$app->db->createCommand()->update('ecs_users', $data, ['user_id'=>$id])->execute();
        return $res;

    }

}

