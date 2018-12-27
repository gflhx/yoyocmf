<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>
    <style>
        .has-error .layui-form-mid.layui-word-aux {
            color: #a94442 !important;
        }

        .layui-form-label.control-label {
            width: 200px;
        }
    </style>
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

    <div class="yoyo-box mt20 group-form">

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'options' => [
                'class' => 'layui-form',
            ],
            'fieldConfig' => [
                'options' => [
                    'class' => 'layui-form-item',
                ],
                'template' => '{label}<div class="layui-input-inline">{input}</div>{error}',
                'labelOptions' => ['class' => 'layui-form-label control-label'],
                'errorOptions' => [
                    'class' => 'layui-form-mid layui-word-aux', //替换掉错误提示的help-block
                ],
                'inputOptions' => [
                    'class' => 'layui-input',   //替换掉input表单的form-control
                ]
            ],
        ]); ?>

        <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'level')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'checked')->textInput() ?>

        <?= $form->field($model, 'fava_num')->textInput() ?>

        <?= $form->field($model, 'day_down')->textInput() ?>

        <?= $form->field($model, 'msg_len')->textInput() ?>

        <?= $form->field($model, 'msg_num')->textInput() ?>

        <?= $form->field($model, 'space_style_id')->textInput() ?>

        <?= $form->field($model, 'day_add_info')->textInput() ?>

        <?= $form->field($model, 'can_reg')->dropDownList($model->getCanReg()) ?>

        <?= $form->field($model, 'reg_checked')->dropDownList($model->getCanChecked()) ?>

        <?= $form->field($model, 'info_checked')->dropDownList($model->getInfoChecked()) ?>

        <?= $form->field($model, 'pl_checked')->dropDownList($model->getPlChecked()) ?>

        <div class="layui-form-item">
            <label class="layui-form-label control-label"></label>
            <div class="layui-input-inline">
                <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => 'layui-btn', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
<?php $this->beginBlock('js') ?>
    <script>
        layui.use(['form'], function () {
            var form = layui.form;
        });
    </script>
<?php $this->endBlock() ?>