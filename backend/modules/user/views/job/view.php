<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Job */

$this->title = $model->job_name;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-xs-8 text-right">
            <?= Html::a('更新', ['update', 'id' => $model->job_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('删除', ['delete', 'id' => $model->job_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '是否确定删除??',
                    'method' => 'post',
                ],
            ]) ?>
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>

<div class="yoyo-box mt20 job-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'job_name',
            'level',
            'myorder',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
