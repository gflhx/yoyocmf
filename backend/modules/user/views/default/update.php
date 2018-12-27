<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\uploader\UploadWidget;
use common\modules\user\models\Department;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = "编辑 " . $model->username . " 资料";
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .layui-tab-title li.layui-this {
        background: #fff;
    }
</style>
<div class="user-update">
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

    <div class="yoyo-box mt20 user-update">

        <?= Html::errorSummary($model) ?>

        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'layui-form form-horizontal',
            ],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-5">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
            ],
        ]); ?>

        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">基础资料</li>
                <li>补充资料</li>
                <li>空间资料</li>
<!--                <li>角色分配</li>-->
                <li>职业信息</li>
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">

                    <?= $form->field($moduleModel, 'user_pic')->widget(UploadWidget::className(), [
                        'onlyUrl' => true,// 有实体字段，只保存文件url
                        'options' => [
                            'img-width' => '200px', //预览图宽度
                        ],
                    ]) ?>

                    <?= $form->field($model, 'username',[
                        'inputOptions' => [
                            'class' => 'form-control',
                            'autocomplete' => 'off',    // 表单不自动填充
                        ]
                    ]) ?>

                    <?=
                    $form->field($model, 'password', [
                        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2 layui-form-mid layui-word-aux">如不想修改,请留空</div><div class="col-sm-3">{error}</div>',
                        'inputOptions' => [
                            'class' => 'form-control',
                            'autocomplete' => 'off',    // 表单不自动填充
                        ]
                    ])->passwordInput()->label("修改密码")
                    ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'group_id')->dropDownList(\common\modules\user\models\Group::getGroupList())->label("会员组") ?>
                    <?= $form->field($model, 'user_fen') ?>
                    <?= $form->field($model, 'money') ?>
                    <?= $form->field($model, 'user_date') ?>
                    <?= $form->field($model, 'z_group_id')->dropDownList(\common\modules\user\models\Group::getGroupList(), ['prompt' => '不设置'])->label("到期后转向") ?>
                    <?= $form->field($model, 'checked')->dropDownList(\common\modules\user\models\User::getChecked())->label("状态") ?>
                </div>
                <div class="layui-tab-item">

                    <?= $form->field($moduleModel, 'true_name') ?>
                    <?= $form->field($moduleModel, 'oicq') ?>
                    <?= $form->field($moduleModel, 'my_call') ?>
                    <?= $form->field($moduleModel, 'phone') ?>
                    <?= $form->field($moduleModel, 'address') ?>
                    <?= $form->field($moduleModel, 'zip') ?>
                </div>
                <div class="layui-tab-item">
                    <?= $form->field($moduleModel, 'space_style_id') ?>
                    <?= $form->field($moduleModel, 'homepage') ?>
                    <?= $form->field($moduleModel, 'say_text')->textarea() ?>
                    <?= $form->field($moduleModel, 'space_name') ?>
                    <?= $form->field($moduleModel, 'space_gg')->textarea() ?>
                    <?= $form->field($moduleModel, 'view_stats') ?>
                </div>
                <div class="layui-tab-item">
                    <?= $form->field($moduleModel, 'company') ?>
                    <?= $form->field($moduleModel, 'fax') ?>

                    <?= $form->field($moduleModel, 'department_id')->dropDownList(Department::getDropDownList(\common\helpers\Tree::build(Department::find()->asArray()->all(), 'department_id', 'parent', 'children', null)), ['encode' => false, 'prompt' => '请选择'])->label("部门名称") ?>
                    <?= $form->field($moduleModel, 'job_id')->dropDownList(\common\modules\user\models\Job::getList(), ['encode' => false, 'prompt' => '请选择'])->label("职位名称") ?>
                </div>

            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? "新增" : "更新", ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php $this->beginBlock('js') ?>
    <script>
        layui.use(['form', 'element'], function () {
            var form = layui.form
                , element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        });
    </script>
<?php $this->endBlock() ?>