<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\modules\attachment\behaviors\UploadBehavior;
use common\traits\EntityTrait;
/**
 * This is the model class for table "{{%document}}".
 *
 * @property int $id
 * @property string $smalltext
 * @property int $classid 栏目ID
 * @property int $ttid 标题分类ID
 * @property int $onclick 点击数
 * @property int $plnum 评论数
 * @property int $totaldown 下载数
 * @property string $newspath 存放日期目录
 * @property string $filename 信息文件名(不含扩展名)
 * @property int $user_id 发布者用户ID
 * @property string $username 发布者用户名
 * @property int $firsttitle 是否头条(1为一级头条，0为普通信息)
 * @property int $isgood 是否推荐(1为一级推荐，0为不推荐)
 * @property int $ispic 是否标题图片(1为标题图片信息，0为普通信息)
 * @property int $istop 置顶级别
 * @property int $ismember 是否会员发布(1为前台会员发布，0为后台发布)
 * @property int $isurl 是否外部链接(1为外部链接，0为普通信息)
 * @property int $havehtml 是否生成过HTML标记(1为已生成，0为未生成)
 * @property int $groupid 允许查看的会员组ID
 * @property int $userfen 扣除点数
 * @property string $titlefont 标题加色、加粗(格式：“#ff0000,b|i|s|”)
 * @property string $titleurl 信息链接地址
 * @property int $created_at
 * @property int $updated_at
 * @property string $ftitle 副标题字段
 * @property int $diggtop DIGG字段
 * @property int $stb 存放副表名
 * @property string $title 标题字段
 * @property string $titlepic 标题图片字段
 */
class Document extends \yii\db\ActiveRecord
{
    use EntityTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['classid', 'ttid', 'onclick', 'plnum', 'totaldown', 'user_id', 'firsttitle', 'isgood', 'ispic', 'istop', 'ismember', 'isurl', 'havehtml', 'groupid', 'userfen', 'created_at', 'updated_at', 'diggtop', 'stb'], 'integer'],
            [['smalltext'], 'string', 'max' => 255],
            [['newspath', 'username'], 'string', 'max' => 20],
            [['filename'], 'string', 'max' => 36],
            [['titlefont'], 'string', 'max' => 14],
            [['titleurl'], 'string', 'max' => 200],
            [['ftitle', 'titlepic'], 'string', 'max' => 120],
            [['title'], 'string', 'max' => 100],
            [['files','morepic'],'safe'], //附件 + 多图图集
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'smalltext' => '简介',
            'classid' => '栏目ID',
            'ttid' => '标题分类ID',
            'onclick' => '点击数',
            'plnum' => '评论数',
            'totaldown' => '下载数',
            'newspath' => '存放日期目录',
            'filename' => '信息文件名(不含扩展名)',
            'user_id' => '发布者用户ID',
            'username' => '发布者用户名',
            'firsttitle' => '头条级别',//(1为一级头条，0为普通信息)
            'isgood' => '推荐级别',//(1为一级推荐，0为不推荐)
            'ispic' => '是否标题图片(1为标题图片信息，0为普通信息)',
            'istop' => '置顶级别',
            'ismember' => '是否会员发布(1为前台会员发布，0为后台发布)',
            'isurl' => '是否外部链接',//(1为外部链接，0为普通信息)
            'havehtml' => '是否生成过HTML标记(1为已生成，0为未生成)',
            'groupid' => '允许查看的会员组ID',
            'userfen' => '扣除点数',
            'titlefont' => '标题加色、加粗(格式：“#ff0000,b|i|s|”)',
            'titleurl' => '信息链接地址',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ftitle' => '副标题',
            'diggtop' => 'DIGG字段',
            'stb' => '存放副表名',
            'title' => '标题',
            'titlepic' => '标题图片',
            'files' => '附件',
            'morepic' => '多图图集',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'files',// 附件
                'multiple' => true, // 是否多图，true为是，去掉这条为false，默认为false，单图上传
                'entity' => __CLASS__
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'morepic',// 多图图集
                'multiple' => true, // 是否多图，true为是，去掉这条为false，默认为false，单图上传
                'entity' => __CLASS__
            ],
        ];
    }

    /**
     * 是否终极栏目(1为终极栏目，0为非终极栏目)
     * @param null $val
     * @return array|mixed
     */
    public static function getNine($val = null){
        $array = [];
        $array[] = "普通信息";
        for ($i=1;$i<=9;$i++){
            $array[$i] = $i."级";
        }
        if (isset($val)) {
            return isset($array[$val]) ? $array[$val] : "";
        } else {
            return $array;
        }
    }

    /**
     * 获取内容
     * @return \yii\db\ActiveQuery
     */
    public function getData(){
        return $this->hasOne(DocumentData::className(),["id"=>"id"]);
    }
}
