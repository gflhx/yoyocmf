<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\uploader\UploadWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
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

    <div class="yoyo-box mt20 document-form">

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
                <li class="layui-this">基础信息</li>
                <li>其他信息</li>
                <!--                <li>职业信息</li>-->
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">
                    <?= $form->field($model, 'classid')->dropDownList(\common\models\Enewsclass::getDropDownList(\common\helpers\Tree::build(\common\models\Enewsclass::find()->asArray()->all(), 'classid', 'bclassid', 'children', null)), ['encode' => false, 'prompt' => '请选择'])->label("选择栏目") ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'titlefont')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'titlepic')->widget(UploadWidget::className(), [
                        'onlyUrl' => true, //字段保存图片url
                        'showTips' => false,
                        'options' => [
                            'img-width' => '200px', //预览图宽度，可选，默认不限
                        ],
                    ]) ?>
                    <?= $form->field($model, 'smalltext')->textarea(['rows' => 4]) ?>

                    <?= $form->field($model, 'firsttitle')->dropDownList($model->getNine()) ?>

                    <?= $form->field($model, 'isgood')->dropDownList($model->getNine()) ?>

                    <?= $form->field($model, 'istop')->dropDownList($model->getNine()) ?>



                </div>

                <div class="layui-tab-item">
                    <?= $form->field($model, 'isurl')->radioList(['0' => '否', '1' => '是'], [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            $c = $checked ? "checked" : "";
                            $template = '<input type="radio" ' . $label . ' name="' . $name . '" value="' . $value . '" title="' . $label . '" ' . $c . '>';
                            return $template;
                        }
                    ]) ?>

                    <?= $form->field($model, 'titleurl')->textInput()->label("外部链接") ?>

                    <?= $form->field($model, 'files',[
                        'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-12">{error}</div>',
                    ])->widget(UploadWidget::className(), [
                        'onlyImage' => false, // true允许上传图片类型,false允许上传所有类型,默认true
                        'multiple' => true,   // false为单图，true为多图，默认false
                        'maxNumberOfFiles' => 4,    // 允许上传的最大文件数
                    ]) ?>

                    <?= $form->field($model, 'morepic',[
                        'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-12">{error}</div>',
                    ])->widget(UploadWidget::className(), [
                        'onlyImage' => true,  // true允许上传图片类型,false允许上传所有类型,默认true
                        'multiple' => true,   // false为单图，true为多图，默认false
                        'maxNumberOfFiles' => 4,    // 允许上传的最大文件数
                    ]) ?>
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