<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'timezone' => 'PRC',
    'language' => 'zh-CN',  //设置语言包
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env("DB_DSN"),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'charset' => 'utf8',
            'tablePrefix' => env("DB_TABLE_PREFIX"),
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        // 全局配置format转换格式
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'timeFormat' => 'HH:mm',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
        // 全局自定义配置获取，存取
        'config' => [
            'class' => 'common\modules\config\components\Config'
        ],
        // 全局图片函数,缩略图，获取url
        'storage' => [
            'class' => 'common\modules\attachment\components\Storage'
        ],
        // 开启错误日志
        'log' => [
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['warning', 'error'],
                    'except'=>['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix'=>function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ],
            ]
        ],
    ],
    'controllerMap' =>[
        'upload' => [
            'class' => 'common\modules\attachment\actions\UploadController'
        ]
    ],
    'modules' => [
        'config' => [
            'class' => 'common\modules\config\Module',
        ],
        'attachment' => [
            'class' => 'common\modules\attachment\Module',
        ],
    ],
];
