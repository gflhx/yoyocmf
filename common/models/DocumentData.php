<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%document_data}}".
 *
 * @property int $id
 * @property int $classid 栏目ID
 * @property string $keyid 相关链接信息ID集合(多个信息ID用半角逗号“,”隔开)
 * @property int $closepl 是否关闭评论(1为关闭评论，0为不关闭评论)
 * @property string $infotags TAGS
 * @property string $writer 作者
 * @property string $befrom 信息来源信息
 * @property string $newstext 内容
 */
class DocumentData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document_data}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classid', 'closepl'], 'integer'],
            [['newstext'], 'string'],
            [['keyid'], 'string', 'max' => 255],
            [['infotags'], 'string', 'max' => 80],
            [['writer'], 'string', 'max' => 30],
            [['befrom'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classid' => '栏目ID',
            'keyid' => '相关链接信息ID集合(多个信息ID用半角逗号“,”隔开)',
            'closepl' => '是否关闭评论(1为关闭评论，0为不关闭评论)',
            'infotags' => 'TAGS',
            'writer' => '作者',
            'befrom' => '信息来源信息',
            'newstext' => '内容',
        ];
    }
}
