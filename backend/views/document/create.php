<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Document */

$this->title = '新增文档';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="document-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
