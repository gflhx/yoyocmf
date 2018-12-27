<?php

namespace common\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_group}}".
 *
 * @property int $group_id
 * @property string $group_name 会员组名称
 * @property int $level 会员组级别值
 * @property int $checked 预定义字段，暂时用不到，默认值0
 * @property int $fava_num 最大收藏夹数
 * @property int $day_down 每天最大下载数
 * @property int $msg_len 短信息最大字数
 * @property int $msg_num 最大短信息数
 * @property int $can_reg 会员组前台可注册，1为可注册，0为不可注册
 * @property int $reg_checked 注册需要审核，1为需要审核，0为不需要审核
 * @property int $space_style_id 默认空间模板ID
 * @property int $day_add_info 每天最大投稿数
 * @property int $info_checked 投稿信息是否审核，1为不需要审核，0为需要审核
 * @property int $pl_checked 评论是否审核，1为不需要审核，0为需要审核
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_name'], 'required'],
            [['level', 'checked', 'fava_num', 'day_down', 'msg_len', 'msg_num', 'can_reg', 'reg_checked', 'space_style_id', 'day_add_info', 'info_checked', 'pl_checked'], 'integer'],
            [['group_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_name' => '会员组名称',
            'level' => '会员组级别值',
            'checked' => '预定义字段，暂时用不到，默认值0',
            'fava_num' => '最大收藏夹数',
            'day_down' => '每天最大下载数',
            'msg_len' => '短信息最大字数',
            'msg_num' => '最大短信息数',
            'can_reg' => '前台可注册',//会员组前台可注册，1为可注册，0为不可注册
            'reg_checked' => '注册是否需要审核',//注册需要审核，1为需要审核，0为不需要审核
            'space_style_id' => '默认空间模板ID',
            'day_add_info' => '每天最大投稿数',
            'info_checked' => '投稿信息是否审核',//投稿信息是否审核，1为不需要审核，0为需要审核
            'pl_checked' => '评论是否审核',//评论是否审核，1为不需要审核，0为需要审核
        ];
    }

    public static function getGroupList()
    {
        $group = self::find()->select("group_id,group_name")->all();
        return ArrayHelper::map($group, "group_id", "group_name");
    }

    /**
     * 获取前台是否可以注册选择项，如果传值，返回文字
     * @param null $val
     * @return array|mixed
     */
    public static function getCanReg($val = null)
    {
        $array = [
            0 => "不可注册",
            1 => "开放注册",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 获取前台注册是否需要审核，如果传值，返回文字
     * @param null $val
     * @return array|mixed
     */
    public static function getCanChecked($val = null)
    {
        $array = [
            0 => "无需审核",
            1 => "需要审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 获取前台投稿信息是否审核，如果传值，返回文字
     * @param null $val
     * @return array|mixed
     */
    public static function getInfoChecked($val = null)
    {
        $array = [
            0 => "需要审核",
            1 => "无需审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 获取该会员组的会员评论是否需要审核，如果传值，返回文字
     * @param null $val
     * @return array|mixed
     */
    public static function getPlChecked($val = null)
    {
        $array = [
            0 => "需要审核",
            1 => "无需审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

}
