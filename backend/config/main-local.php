<?php
$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '3kzPSIhG1Sx37sL8Jfck8c0sUCV62m1d',
        ],
    ],
];

if (env("YII_DEBUG")) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*','127.0.0.1', '::1']//*.*.*.*不限地址，docker里面不属于127.0.0.1
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*.*.*.*', '127.0.0.1', '::1'],//*.*.*.*不限地址，docker里面不属于127.0.0.1
        /*重新定义gii model & crud的生成模板*/
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    // 自己的模板名
                    'yoyocmf' => '@backend/modules/gii/generators/crud/default'
                ],
            ],
        ],
    ];
}

return $config;
