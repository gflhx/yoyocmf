<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\config\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>

<div class="yoyo-box mt20 config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList($model->getTypeList()) ?>
    <?= $form->field($model, 'group')->dropDownList($model->getGroupList()) ?>
    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'extra')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
