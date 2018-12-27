<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\uploader\UploadWidget;
use common\models\Enewsclass;
use backend\modules\rbac\models\Menu;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
/* @var $this yii\web\View */
/* @var $model common\models\Enewsclass */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
    'menus' => Menu::getMenuSource(),
    'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>
    <style>
        .layui-tab-title li.layui-this {
            background: #fff;
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

    <div class="yoyo-box mt20 enewsclass-form">

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
                <li class="layui-this">栏目信息</li>
                <li>栏目设置</li>
                <li>投稿设置</li>
                <!--                <li>职业信息</li>-->
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">

                    <?= $form->field($model, 'classimg')->widget(UploadWidget::className(), [
                        'onlyUrl' => true, //字段保存图片url
                        'showTips' => false,
                        'options' => [
                            'img-width' => '150px', //预览图宽度，可选，默认不限
                        ],
                    ]) ?>

                    <?= $form->field($model, 'bclassid')->dropDownList(Enewsclass::getDropDownList(\common\helpers\Tree::build(Enewsclass::find()->asArray()->all(), 'classid', 'bclassid', 'children', null)), ['encode' => false, 'prompt' => '请选择'])->label("父栏目") ?>

                    <?= $form->field($model, 'classname')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'bname')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'classpagekey')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'showclass')->dropDownList($model->getShowclass()) ?>

                    <?= $form->field($model, 'classurl')->textInput(['id' => 'route']) ?>

                    <?php //echo $form->field($model, 'classurl')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'wburl')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'myorder')->textInput() ?>
                </div>
                <div class="layui-tab-item">
<!--                    --><?php //echo $form->field($model, 'tbname', [
//                        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2 layui-form-mid layui-word-aux">不带前缀</div><div class="col-sm-3">{error}</div>',
//                        'inputOptions' => [
//                            'class' => 'form-control',
//                            'autocomplete' => 'off',    // 表单不自动填充
//                        ]
//                    ])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'listorder', [
                        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2 layui-form-mid layui-word-aux">默认：id DESC</div><div class="col-sm-3">{error}</div>',
                        'inputOptions' => [
                            'class' => 'form-control',
                            'autocomplete' => 'off',    // 表单不自动填充
                        ]
                    ])->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'reorder', [
                        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2 layui-form-mid layui-word-aux">默认：created_at DESC</div><div class="col-sm-3">{error}</div>',
                        'inputOptions' => [
                            'class' => 'form-control',
                            'autocomplete' => 'off',    // 表单不自动填充
                        ]
                    ])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'sametitle')->dropDownList($model->getSametitle()) ?>

                    <?= $form->field($model, 'islast')->dropDownList($model->getIslast()) ?>
                    <?= $form->field($model, 'openpl')->dropDownList($model->getOpenpl()) ?>

                    <?= $form->field($model, 'checkpl')->dropDownList($model->getCheckpl()) ?>
                    <?= $form->field($model, 'checked')->dropDownList($model->getChecked()) ?>

                    <?= $form->field($model, 'nrejs')->dropDownList($model->getNrejs()) ?>

                    <?= $form->field($model, 'newline')->textInput() ?>
                    <?= $form->field($model, 'hotline')->textInput() ?>
                    <?= $form->field($model, 'goodline')->textInput() ?>
                    <?= $form->field($model, 'hotplline')->textInput() ?>
                    <?= $form->field($model, 'firstline')->textInput() ?>
                    <?= $form->field($model, 'bdinfoid', [
                        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2 layui-form-mid layui-word-aux">格式：栏目ID,信息ID</div><div class="col-sm-3">{error}</div>',
                        'inputOptions' => [
                            'class' => 'form-control',
                            'autocomplete' => 'off',    // 表单不自动填充
                        ]
                    ])->textInput(['maxlength' => true]) ?>
                    <?php //echo $form->field($model, 'groupid')->textInput() ?>
                    <?php //echo $form->field($model, 'cgroupid')->textarea(['rows' => 6]) ?>
                    <?php //echo $form->field($model, 'cgtoinfo')->textInput() ?>

                    <?= $form->field($model, 'lencord')->textInput() ?>
                    <?= $form->field($model, 'link_num')->textInput() ?>
                    <?= $form->field($model, 'onclick')->textInput() ?>
                    <?php //echo $form->field($model, 'allinfos')->textInput() ?>
                    <?php //echo $form->field($model, 'infos')->textInput() ?>
                </div>

                <div class="layui-tab-item">
                    <?= $form->field($model, 'openadd')->dropDownList($model->getOpenadd()) ?>
                    <?= $form->field($model, 'checkqadd')->dropDownList($model->getCheckqadd()) ?>
                    <?= $form->field($model, 'qeditchecked')->dropDownList($model->getQeditchecked()) ?>
                    <?= $form->field($model, 'addinfofen')->textInput() ?>
                    <?= $form->field($model, 'qaddshowkey')->dropDownList($model->getQaddshowkey()) ?>
                    <?php //echo $form->field($model, 'qaddgroupid')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php $this->beginBlock('js') ?>
    <script>
        layui.use(['form', 'element'], function () {
            var form = layui.form
                , element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        });
    </script>
<?php $this->endBlock() ?>