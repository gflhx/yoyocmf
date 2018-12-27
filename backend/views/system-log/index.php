<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\SystemLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 system-log-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'table table-bordered table-hover table-responsive','id' => 'grid'],
        'columns' => [
//            'id',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            [
                'attribute' => 'level',
                'value' => function ($model) {
                    return \yii\log\Logger::getLevelName($model->level);
                },
                'filter' => [
                    \yii\log\Logger::LEVEL_ERROR => 'error',
                    \yii\log\Logger::LEVEL_WARNING => 'warning',
                    \yii\log\Logger::LEVEL_INFO => 'info',
                    \yii\log\Logger::LEVEL_TRACE => 'trace',
                    \yii\log\Logger::LEVEL_PROFILE_BEGIN => 'profile begin',
                    \yii\log\Logger::LEVEL_PROFILE_END => 'profile end'
                ]
            ],
            'category',
            [
                'attribute' => 'prefix',
                'value' => function ($model) {
                    return esub($model->prefix,50,'...');
                }
            ],
            [
                'attribute' => 'log_time',
                'format' => 'datetime',
                'value' => function ($model) {
                    return (int) $model->log_time;
                }
            ],
//            [
//                'attribute' => 'log_time',
//                'value' => function ($model) {
//                    $time = (int) $model->log_time;
//                    return date("Y-m-d H:i:s",$time);
//                }
//            ],
            //'message:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


