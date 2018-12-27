<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%enewsclass}}".
 *
 * @property int $classid 栏目ID
 * @property int $bclassid 父栏目ID
 * @property string $classname 栏目名称
 * @property string $sonclass 终极栏目ID集合(父栏目下所有终极栏目ID集合，多个栏目ID用“|”隔开，例如：|1|5|8|)
 * @property int $is_zt 预定义字段，暂时用不到，默认值0
 * @property int $lencord 每页显示信息数
 * @property int $link_num 相关链接数
 * @property int $onclick 点击数
 * @property string $featherclass 父栏目ID集合(所有上级父栏目ID集合，按层次存放，多个栏目ID用“|”隔开，例如：|1|2|3|)
 * @property int $islast 是否终极栏目(1为终极栏目，0为非终极栏目)
 * @property int $openpl 是否开启评论(0为开启，1为关闭)
 * @property int $openadd 是否开放投稿(0为开启，1为关闭)
 * @property int $newline 最新信息JS显示数
 * @property int $hotline 热门信息JS显示数
 * @property int $goodline 推荐信息JS显示数
 * @property int $hotplline 热门评论信息JS显示数
 * @property int $firstline 头条信息JS显示数
 * @property string $classurl 栏目绑定域名
 * @property int $groupid 默认内容页查看权限
 * @property int $myorder 排序
 * @property int $checkpl 评论是否需要审核(1为要审核，0为直接通过)
 * @property int $checked 信息默认是否审核(1为直接审核，0为未审核)
 * @property int $checkqadd 前台投稿是否要审核(0为要审核，1为直接通过)
 * @property string $tbname 数据表名
 * @property string $listorder 管理信息排序方式(默认：id DESC)
 * @property string $reorder 列表式页面排序方式(默认：newstime DESC)
 * @property string $bname 栏目别名
 * @property string $intro 栏目简介
 * @property string $classpagekey 栏目关键字
 * @property string $classimg 栏目缩略图
 * @property int $addinfofen 前台投稿加点数
 * @property int $showclass 是否显示到导航(0为显示，1为不显示)
 * @property string $qaddgroupid 投稿权限(多个会员组ID用“,”半角逗号隔开，例如：,1,2,3,)
 * @property int $qaddshowkey 投稿是否开启验证码(1为开启，0为关闭)
 * @property int $adminqinfo 管理投稿(0为不能管理信息，1为可管理未审核信息，2为只可编辑未审核信息，3为只可删除未审核信息，4为可管理所有信息，5为只可编辑所有信息，6为只可删除所有信息)
 * @property int $nrejs 是否生成JS调用(0为生成，1为不生成)
 * @property int $sametitle 是否检测标题重复(0为不检测，1为检测)
 * @property string $wburl 外部栏目链接地址
 * @property int $qeditchecked 修改投稿是否需要审核(1为需要重新审核，0为不需要)
 * @property string $cgroupid 栏目页访问权限(多个会员组ID用“,”半角逗号隔开，例如：,1,2,3,)
 * @property int $cgtoinfo 栏目访问权限应用于信息(1为是，0为否)
 * @property string $bdinfoid 栏目绑定信息ID(格式：栏目ID,信息ID)
 * @property int $allinfos 栏目信息总数
 * @property int $infos 审核通过的信息总数
 * @property int $created_at
 * @property int $updated_at
 */
class Enewsclass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%enewsclass}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bclassid', 'is_zt', 'lencord', 'link_num', 'onclick', 'islast', 'openpl', 'openadd', 'newline', 'hotline', 'goodline', 'hotplline', 'firstline', 'groupid', 'myorder', 'checkpl', 'checked', 'checkqadd', 'addinfofen', 'showclass', 'qaddshowkey', 'adminqinfo', 'nrejs', 'sametitle', 'qeditchecked', 'cgtoinfo', 'allinfos', 'infos', 'created_at', 'updated_at'], 'integer'],
//            [['sonclass', 'featherclass', 'intro', 'qaddgroupid', 'cgroupid', 'updated_at'], 'required'],
            [['classname'], 'required'],
            [['sonclass', 'featherclass', 'intro', 'qaddgroupid', 'cgroupid'], 'string'],
            [['classname', 'listorder', 'reorder', 'bname'], 'string', 'max' => 50],
            [['classurl'], 'string', 'max' => 200],
            [['tbname'], 'string', 'max' => 60],
            [['classpagekey', 'classimg', 'wburl'], 'string', 'max' => 255],
            [['bdinfoid'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'classid' => '栏目ID',
            'bclassid' => '父栏目ID',
            'classname' => '栏目名称',
            'sonclass' => '终极栏目ID集合(父栏目下所有终极栏目ID集合，多个栏目ID用“|”隔开，例如：|1|5|8|)',
            'is_zt' => '预定义字段，暂时用不到，默认值0',
            'lencord' => '每页显示信息数',
            'link_num' => '相关链接数',
            'onclick' => '点击数',
            'featherclass' => '父栏目ID集合(所有上级父栏目ID集合，按层次存放，多个栏目ID用“|”隔开，例如：|1|2|3|)',
            'islast' => '是否终极栏目',
            'openpl' => '是否开启评论',
            'openadd' => '是否开放投稿',
            'newline' => '最新信息JS显示数',
            'hotline' => '热门信息JS显示数',
            'goodline' => '推荐信息JS显示数',
            'hotplline' => '热门评论信息JS显示数',
            'firstline' => '头条信息JS显示数',
            'classurl' => '栏目绑定路由',
            'groupid' => '默认内容页查看权限',
            'myorder' => '排序',
            'checkpl' => '评论是否需要审核',
            'checked' => '信息默认是否审核',
            'checkqadd' => '前台投稿是否需要审核',
            'tbname' => '数据表名',
            'listorder' => '后台信息排序方式',
            'reorder' => '前台页面排序方式',
            'bname' => '栏目别名',
            'intro' => '栏目简介',
            'classpagekey' => '栏目关键字',
            'classimg' => '栏目缩略图',
            'addinfofen' => '前台投稿加点数',
            'showclass' => '是否显示到导航',
            'qaddgroupid' => '投稿权限(多个会员组ID用“,”半角逗号隔开，例如：,1,2,3,)',
            'qaddshowkey' => '投稿是否开启验证码',
            'adminqinfo' => '管理投稿(0为不能管理信息，1为可管理未审核信息，2为只可编辑未审核信息，3为只可删除未审核信息，4为可管理所有信息，5为只可编辑所有信息，6为只可删除所有信息)',
            'nrejs' => '是否生成JS调用',
            'sametitle' => '是否检测标题重复',
            'wburl' => '外部栏目链接地址',
            'qeditchecked' => '修改投稿是否需要审核',
            'cgroupid' => '栏目页访问权限(多个会员组ID用“,”半角逗号隔开，例如：,1,2,3,)',
            'cgtoinfo' => '栏目访问权限应用于信息(1为是，0为否)',
            'bdinfoid' => '栏目绑定信息ID',
            'allinfos' => '栏目信息总数',
            'infos' => '审核通过的信息总数',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * 是否终极栏目(1为终极栏目，0为非终极栏目)
     * @param null $val
     * @return array|mixed
     */
    public static function getIslast($val = null){
        $array = [
            0 => "非终极栏目",
            1 => "终极栏目",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 是否开启评论(0为开启，1为关闭)
     * @param null $val
     * @return array|mixed
     */
    public static function getOpenpl($val = null){
        $array = [
            0 => "开启",
            1 => "关闭",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 是否开放投稿(0为开启，1为关闭)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getOpenadd($val = null){
        $array = [
            0 => "开启",
            1 => "关闭",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 评论是否需要审核(1为要审核，0为直接通过)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getCheckpl($val = null){
        $array = [
            0 => "直接通过",
            1 => "需要审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 信息默认是否审核(1为直接审核，0为未审核)
     * @param null $val
     * @return array|mixed|string
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

    /**
     * 是否显示到导航(0为显示，1为不显示)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getShowclass($val = null){
        $array = [
            0 => "显示",
            1 => "不显示",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }


    /**
     * 前台投稿是否要审核(0为要审核，1为直接通过)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getCheckqadd($val = null){
        $array = [
            0 => "需要审核",
            1 => "直接通过",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 是否生成JS调用(0为生成，1为不生成)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getNrejs($val = null){
        $array = [
            0 => "生成",
            1 => "不生成",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 是否生成JS调用(0为生成，1为不生成)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getSametitle($val = null){
        $array = [
            0 => "不检测",
            1 => "检测",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 修改投稿是否需要审核(1为需要重新审核，0为不需要)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getQeditchecked($val = null){
        $array = [
            0 => "不需要",
            1 => "需要重新审核",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 投稿是否开启验证码(1为开启，0为关闭)
     * @param null $val
     * @return array|mixed|string
     */
    public static function getQaddshowkey($val = null){
        $array = [
            0 => "关闭",
            1 => "开启",
        ];
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 获取选择部门列表
     * @param array $tree
     * @param array $result
     * @param int $deep
     * @param string $separator
     * @return array
     */
    public static function getDropDownList($tree = [], &$result = [], $deep = 0, $separator = '&nbsp;&nbsp;&nbsp;&nbsp;')
    {
        $deep++;
        foreach($tree as $list) {
            $result[$list['classid']] = str_repeat($separator, $deep-1) . $list['classname'];
            if (isset($list['children'])) {
                self::getDropDownList($list['children'], $result, $deep);
            }
        }
        return $result;
    }
}
