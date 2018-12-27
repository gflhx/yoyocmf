<?php

namespace common\modules\user\models;

use common\modules\attachment\behaviors\UploadBehavior;
use Yii;
use common\behaviors\PositionBehavior;
use yii\behaviors\TimestampBehavior;
use common\traits\EntityTrait;
/**
 * This is the model class for table "{{%user_department}}".
 *
 * @property int $department_id
 * @property int $parent 父级
 * @property string $department_name 部门名称
 * @property int $myorder 排序
 * @property int $created_at
 * @property int $updated_at
 * @property int $level 部门级别
 */
class Department extends \yii\db\ActiveRecord
{
    use EntityTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_department}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_name'], 'required'],
            [['parent', 'myorder', 'created_at', 'updated_at', 'level'], 'integer'],
            [['department_name'], 'string', 'max' => 128],
            [['titlepic'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'parent' => '父级',
            'department_name' => '部门名称',
            'myorder' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'level' => '部门级别',
            'titlepic' => '标题图片'
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => PositionBehavior::className(),
                'positionAttribute' => 'myorder', //排序字段名
                'groupAttributes' => [
                    'parent' // 分组字段
                ],
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'titlepic',
                'entity' => __CLASS__
            ],
        ];
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
            $result[$list['department_id']] = str_repeat($separator, $deep-1) . $list['department_name'];
            if (isset($list['children'])) {
                self::getDropDownList($list['children'], $result, $deep);
            }
        }
        return $result;
    }

    public function getParentName()
    {
        return static::find()->select('department_name')->where(['department_id' => $this->parent])->scalar();
    }
}
