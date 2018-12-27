<?php
namespace backend\modules\rbac\models\form;

use backend\modules\rbac\components\UserStatus;
use common\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $retypePassword;
    public $group_id;
    public $user_fen;
    public $user_date;
    public $z_group_id;
    public $checked;
    public $money;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ? : 'common\modules\user\models\User';
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
//            ['email', 'required'],
//            ['email', 'unique', 'targetClass' => $class, 'message' => 'This email address has already been taken.'],

            [['money'], 'number'],
            [['group_id', 'user_fen', 'user_date', 'z_group_id', 'checked'], 'integer'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '登录用户名',
            'password' => '登录密码',
            'retypePassword' => '确认密码',
            'email' => '联系邮箱',
            'group_id' => '会员组',
            'user_fen' => '点数',
            'user_date' => '剩余天数',
            'money' => '金额',
            'z_group_id' => '到期后转向会员组ID',
            'checked' => '是否审核,1为已审核，0为未审核',
        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
//            $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = ArrayHelper::getValue(Yii::$app->params, 'user.defaultStatus', UserStatus::ACTIVE);
            $user->group_id = $this->group_id;
            $user->user_fen = $this->user_fen;
            $user->money = $this->money;
            $user->user_date = $this->user_date;
            $user->z_group_id = $this->z_group_id;
            $user->checked = $this->checked;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
