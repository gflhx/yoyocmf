<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yoyo-box">
    <h3><?= Html::encode($this->title) ?></h3>
</div>

<div class="yoyo-box mt20 auth-item-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
