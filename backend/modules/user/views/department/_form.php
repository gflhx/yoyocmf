<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\uploader\UploadWidget;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Department */
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

<div class="yoyo-box mt20 department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent')->dropDownList($model::getDropDownList(\common\helpers\Tree::build($model::find()->asArray()->all(), 'department_id', 'parent', 'children', null)), ['encode' => false, 'prompt' => '请选择']) ?>

    <?= $form->field($model, 'titlepic')->widget(UploadWidget::className(), [
        'options' => [
            'img-width' => '200px'
        ],
    ]) ?>

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'myorder')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <div class="form-group">
        <!--        -->
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
