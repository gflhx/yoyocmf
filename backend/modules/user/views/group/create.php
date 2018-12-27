<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Group */

$this->title = '新增会员组';
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
