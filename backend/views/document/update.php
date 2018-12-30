<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $module common\models\DocumentData */

$this->title = '更新文档: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="document-update">

    <?= $this->render('_form', [
        'model' => $model,
        'module' => $module
    ]) ?>

</div>
