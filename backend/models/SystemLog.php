<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%system_log}}".
 *
 * @property int $id
 * @property int $level 级别
 * @property string $category 分类
 * @property double $log_time 日志时间
 * @property string $prefix 错误路由
 * @property string $message 错误内容
 */
class SystemLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%system_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => '级别',
            'category' => '分类',
            'log_time' => '日志时间',
            'prefix' => '错误路由',
            'message' => '错误内容',
        ];
    }
}
