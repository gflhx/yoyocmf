<?php

namespace common\modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\behaviors\PositionBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_job}}".
 *
 * @property int $job_id
 * @property string $job_name 职位名称
 * @property int $myorder 排序
 * @property int $created_at
 * @property int $updated_at
 * @property int $level 职位级别
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['myorder', 'created_at', 'updated_at', 'level'], 'integer'],
            [['job_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'job_id' => 'Job ID',
            'job_name' => '职位名称',
            'myorder' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'level' => '职位级别',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => PositionBehavior::className(),
                'positionAttribute' => 'myorder', //排序字段名
            ],
        ];
    }

    public static function getList(){
        $list = Job::find()->select("job_id,job_name")->all();
        return ArrayHelper::map($list,"job_id","job_name");
    }
}
