<?php
require __DIR__ . '/../vendor/autoload.php';


// 扩展composer require vlucas/phpdotenv使用env文件的全局变量
if (is_file(__DIR__ . '/../.env')) {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
}

defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../common/config/bootstrap.php';
require __DIR__ . '/../frontend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../common/config/main.php',
    require __DIR__ . '/../common/config/main-local.php',
    require __DIR__.'/../frontend/config/main.php',
    require __DIR__.'/../frontend/config/main-local.php'
);

(new yii\web\Application($config))->run();
