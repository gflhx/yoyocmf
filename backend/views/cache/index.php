<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
$this->title = "清除缓存";
?>
<div class="yoyo-box">

    <?= Html::a('<i class="glyphicon glyphicon-flash"></i> 清除全部缓存', ['/cache/flush-cache'], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>

</div>

<div class="yoyo-box mt20 clearfix">
    <h3>删除指定缓存</h3>

    <?php ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['flush-cache-key']),
        'method' => 'post',
        'layout' => 'inline',
        'options' => ['class' => 'form-inline mt20']
    ]) ?>
    <?= Html::input('string', 'key', null, ['class' => 'form-control', 'placeholder' => 'key']) ?>
    <?= Html::submitButton('删除', ['class' => 'btn btn-danger']) ?>
    <?php ActiveForm::end() ?>

</div>
