<?php
// 给每个列表的 增 删 改 查 按钮加class
Yii::$container->set('yii\grid\ActionColumn', ['buttonOptions' => ['class' => 'btn btn-default btn-xs']]);

// 给每个树列表，添加hover
Yii::$container->set('backend\widgets\grid\TreeGrid', [
    'options' => ['class' => 'table table-bordered table-hover table-responsive'],
]);


Yii::$container->set('yii\data\Pagination', ['defaultPageSize' => 15]);

// 去掉每个列表上面的 Showing 1-1 of 1 item. 字样，并添加样式。及布局
Yii::$container->set('yii\grid\GridView', [
    'tableOptions' => ['class' => 'table table-bordered table-hover table-responsive'],
    'layout' => "{items}\n<div class='clearfix'><div class='pull-right'>{summary}\n{pager}</div></div>",
    'summaryOptions' => ['class' => 'pagination-summary'],
]);