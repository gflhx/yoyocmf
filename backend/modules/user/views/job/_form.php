<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-xs-8 text-right">
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>

<div class="yoyo-box mt20 job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'myorder')->textInput() ?>

    <div class="form-group">
        <!--        -->
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
