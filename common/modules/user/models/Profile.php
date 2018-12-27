<?php

namespace common\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $user_id
 * @property string $true_name 真实姓名
 * @property string $oicq QQ号码
 * @property string $my_call 联系电话
 * @property string $phone 手机号码
 * @property string $address 联系地址
 * @property string $zip 邮编号码
 * @property int $space_style_id 会员空间模板ID
 * @property string $homepage 个人主页
 * @property string $say_text 简介
 * @property string $company 公司名称
 * @property string $fax 传真号码
 * @property string $user_pic 会员头像
 * @property string $space_name 会员空间名称
 * @property string $space_gg 会员空间公告
 * @property int $view_stats 会员空间访问数量
 * @property string $reg_ip 注册IP
 * @property int $last_time 最后登录时间
 * @property string $last_ip 最后登录IP
 * @property int $login_num 登录次数
 * @property string $reg_ip_port 注册IP端口号
 * @property string $last_ip_port 最后一次登录IP端口号
 * @property int $department_id 部门ID
 * @property int $job_id 职位ID
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'space_style_id', 'view_stats', 'last_time', 'login_num','department_id', 'job_id'], 'integer'],
            [['say_text', 'space_gg'], 'string'],
            [['true_name', 'reg_ip', 'last_ip'], 'string', 'max' => 20],
            [['oicq'], 'string', 'max' => 25],
            [['my_call', 'phone', 'fax'], 'string', 'max' => 30],
            [['address', 'company', 'space_name'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 8],
            [['homepage', 'user_pic'], 'string', 'max' => 200],
            [['reg_ip_port', 'last_ip_port'], 'string', 'max' => 6],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'true_name' => '真实姓名',
            'oicq' => 'QQ号码',
            'my_call' => '联系电话',
            'phone' => '手机号码',
            'address' => '联系地址',
            'zip' => '邮编号码',
            'space_style_id' => '会员空间模板ID',
            'homepage' => '个人主页',
            'say_text' => '简介',
            'company' => '公司名称',
            'fax' => '传真号码',
            'user_pic' => '会员头像',
            'space_name' => '会员空间名称',
            'space_gg' => '会员空间公告',
            'view_stats' => '会员空间访问数量',
            'reg_ip' => '注册IP', //程序写入
            'last_time' => '最后登录时间',//程序写入
            'last_ip' => '最后登录IP',//程序写入
            'login_num' => '登录次数',//程序写入
            'reg_ip_port' => '注册IP端口号',//程序写入
            'last_ip_port' => '最后一次登录IP端口号',//程序写入
            'department_id' => '部门ID',
            'job_id' => '职位ID',
        ];
    }
}
