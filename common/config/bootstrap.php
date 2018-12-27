<?php
Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@web', dirname(dirname(__DIR__)).'/web');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

// 设置默认上传文件夹
//Yii::setAlias('storagePath', '@web/storage');

// 设置分页，显示首页，末页，最多显示5页按钮
Yii::$container->set('yii\widgets\LinkPager', ['maxButtonCount' => 5, 'firstPageLabel' => '首页', 'lastPageLabel' => '末页']);
// pjax设置超时时间不限
Yii::$container->set('yii\widgets\Pjax', ['timeout' => false]);
