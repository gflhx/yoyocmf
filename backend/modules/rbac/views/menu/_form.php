<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use mdm\admin\models\Menu;
use backend\modules\rbac\models\Menu;
use yii\helpers\Json;
use mdm\admin\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
    'menus' => Menu::getMenuSource(),
    'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
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

<div class="menu-form yoyo-box mt20">
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-5">{input}</div><div class="col-sm-4">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'icon')->widget(\backend\widgets\iconpicker\IconPickerWidget::className()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'parent')->dropDownList(\backend\modules\rbac\models\Menu::getDropDownList(\common\helpers\Tree::build($model::find()->asArray()->all(), 'id', 'parent', 'children', null)), ['encode' => false, 'prompt' => '请选择'])->label("父菜单") ?>

    <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
    <?= $form->field($model, 'order')->input('number') ?>

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-3">
            <?=
            Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord
                ? 'btn btn-success' : 'btn btn-primary'])
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--<style>-->
<!--    .ui-autocomplete{-->
<!--        top: 350px;-->
<!--    }-->
<!--</style>-->