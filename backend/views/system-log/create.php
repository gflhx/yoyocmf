<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemLog */

$this->title = 'Create System Log';
$this->params['breadcrumbs'][] = ['label' => 'System Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="system-log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
