<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\attachment\models\Attachment */

$this->title = '更新附件: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attachment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
