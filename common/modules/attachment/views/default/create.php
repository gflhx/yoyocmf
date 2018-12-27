<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\attachment\models\Attachment */

$this->title = '上传附件';
$this->params['breadcrumbs'][] = ['label' => 'Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="attachment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
