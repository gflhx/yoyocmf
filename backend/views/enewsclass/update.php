<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Enewsclass */

$this->title = 'Update Enewsclass: ' . $model->classid;
$this->params['breadcrumbs'][] = ['label' => 'Enewsclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->classid, 'url' => ['view', 'id' => $model->classid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enewsclass-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
