<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Department */

$this->title = '新增部门';
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
