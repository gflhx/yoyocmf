<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Job */

$this->title = '编辑职位: ' . $model->job_name;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->job_id, 'url' => ['view', 'id' => $model->job_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
