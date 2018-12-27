<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Job */

$this->title = '新增职位';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="job-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
