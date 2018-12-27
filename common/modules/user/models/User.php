<?php
namespace common\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property int $group_id 会员组ID
 * @property int $user_fen 点数
 * @property int $user_date 有效期
 * @property double $money 金额
 * @property int $z_group_id 到期后转向会员组ID
 * @property int $havemsg 是否有短信息,1为提示有短信息，0为不提示
 * @property int $checked 是否审核,1为已审核，0为未审核
 * @property int $department_id 部门ID
 * @property int $job_id    职位ID
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return array_merge($scenarios, [
            'backend-update' => ['username','password', 'email', 'password','group_id','user_fen','user_date','user_date','money','z_group_id','checked','department_id','job_id'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            ['username', 'string'],
//            ['username', 'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'common\modules\user\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

//    public function rules()
//    {
//        return [
//            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
//            [['status', 'created_at', 'updated_at', 'group_id', 'user_fen', 'user_date', 'z_group_id', 'havemsg', 'checked'], 'integer'],
//            [['money'], 'number'],
//            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32],
//            [['username'], 'unique'],
//            [['email'], 'unique'],
//            [['password_reset_token'], 'unique'],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => '联系邮箱',
            'status' => 'Status',
            'created_at' => '注册时间',
            'updated_at' => 'Updated At',
            'group_id' => '会员组ID',
            'user_fen' => '点数',
            'user_date' => '剩余天数',
            'money' => '金额',
            'z_group_id' => '到期后转向会员组ID',
            'havemsg' => '是否有短信息,1为提示有短信息，0为不提示',
            'checked' => '是否审核,1为已审核，0为未审核',
        ];
    }

    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterInsertInternal']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDeleteInternal']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * 获取副表的用户资料
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * 获取会员组信息
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['group_id' => 'group_id']);
    }

    /**
     * 到期后转向会员组
     * @return \yii\db\ActiveQuery
     */
    public function getZGroup()
    {
        return $this->hasOne(Group::className(), ['group_id' => 'z_group_id']);
    }


    /**
     * 在写入之前，如果有密码，生成hash
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->password) {
            $this->setPassword($this->password);
        }
        if(empty($this->auth_key)){
            $this->generateAuthKey();
        }
        return parent::beforeSave($insert);
    }

    /**
     * 添加主表成功后，添加副表
     * @param $event
     */
    public function afterInsertInternal($event)
    {
        $profile = new Profile();
        $profile->login_num = 1;
        $this->link('profile', $profile);
    }

    /**
     * 删除主表后,随即删除副表
     */
    public function afterDeleteInternal()
    {
        Profile::deleteAll(["user_id"=>$this->id]);
    }

    /**
     * 获取审核状态
     * @param null $val
     * @return array|mixed
     */
    public static function getChecked($val = null){
        $array = [
            0 => "未审核",
            1 => "已审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }
}
