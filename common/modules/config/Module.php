<?php

namespace common\modules\config;

/**
 * config module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\config\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // $this->id 模块名称，如config
//        // custom initialization code goes here
    }
}
