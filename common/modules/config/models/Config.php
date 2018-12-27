<?php

namespace common\modules\config\models;

use Yii;
use common\behaviors\CacheInvalidateBehavior;
//use common\modules\attachment\models\Attachment;
use yii\behaviors\TimestampBehavior;
use common\behaviors\PositionBehavior;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property int $id
 * @property string $name 配置名
 * @property string $value 配置值
 * @property string $extra 配置项
 * @property string $description 配置描述
 * @property string $type 配置类型
 * @property int $created_at
 * @property int $updated_at
 * @property string $group 配置分组
 * @property int $sort 排序
 */
class Config extends \yii\db\ActiveRecord
{
    const TYPE_ARRAY = 'array';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'type'], 'required'],
            ['name', 'unique'],
            [['name', 'group'], 'string', 'max' => 50],
            ['type', 'in', 'range' => array_keys(self::getTypeList())],
            ['value', 'filter', 'filter' => function ($val) {
                if ($this->type == 'checkbox') {
                    return serialize($val);
                }
                return $val;
            }, 'skipOnEmpty' => true],
            [['value', 'description', 'extra'], 'string'],
            ['sort', 'safe'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '配置名',
            'value' => '配置值',
            'extra' => '配置项',
            'description' => '配置描述',
            'type' => '配置项类型',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'group' => '配置项分组',
            'sort' => '排序',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => CacheInvalidateBehavior::className(),
                'tags' => [
                    \Yii::$app->config->cacheTag
                ]
            ],
            [
                'class' => PositionBehavior::className(),
                'positionAttribute' => 'sort',
                'groupAttributes' => [
                    'group'
                ],
            ],
        ];
    }

    public static function getTypeList()
    {
        return \Yii::$app->config->get('config_type_list');
    }

    public static function getGroupList()
    {
        return \Yii::$app->config->get('config_group_list');
    }
}
