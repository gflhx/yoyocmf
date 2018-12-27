<?php

namespace common\modules\attachment\models;

use Yii;

/**
 * This is the model class for table "{{%attachment_index}}".
 *
 * @property int $attachment_id 附件ID
 * @property string $entity 空间命名类
 * @property int $entity_id 信息ID
 * @property string $attribute 上传附件字段名
 */
class AttachmentIndex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attachment_index}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attachment_id', 'entity', 'entity_id', 'attribute'], 'required'],
            [['attachment_id', 'entity_id'], 'integer'],
            [['entity'], 'string', 'max' => 80],
            [['attribute'], 'string', 'max' => 128],
//            [['attachment_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attachment_id' => '附件ID',
            'entity' => '空间命名类',
            'entity_id' => '信息ID',
            'attribute' => '上传附件字段名',
        ];
    }
}
