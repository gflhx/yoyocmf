<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = "创建用户";
$this->params['breadcrumbs'][] = $this->title;
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

    <div class="yoyo-box mt20 site-signup">

        <?= Html::errorSummary($model) ?>

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
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'retypePassword')->passwordInput() ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'group_id')->dropDownList(\common\modules\user\models\Group::getGroupList()) ?>
        <?= $form->field($model, 'user_fen') ?>
        <?= $form->field($model, 'money') ?>
        <?= $form->field($model, 'user_date') ?>
        <?= $form->field($model, 'z_group_id')->dropDownList(\common\modules\user\models\Group::getGroupList(),['prompt'=>'不设置'])->label("到期后转向") ?>
        <?= $form->field($model, 'checked')->dropDownList(\common\modules\user\models\User::getChecked())->label("状态") ?>

        <div class="layui-form-item">
            <label class="layui-form-label control-label"></label>
            <div class="layui-input-inline">
                <?= Html::submitButton("新增", ['class' => 'layui-btn', 'name' => 'signup-button']) ?>
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