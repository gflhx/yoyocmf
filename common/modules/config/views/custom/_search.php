<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modules\config\models\searchs\ConfigSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="yoyo-box config-search clearfix">

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'description') ?>
            <?= $form->field($model, 'type')->dropDownList($model->getTypeList(), ['prompt' => '不限']) ?>
            <?= $form->field($model, 'group')->dropDownList($model->getGroupList(), ['prompt' => '不限']) ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::a('+ 新增 Config', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    </div>
</div>
