<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Enewsclass */

$this->title = '新增栏目';
$this->params['breadcrumbs'][] = ['label' => 'Enewsclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enewsclass-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
