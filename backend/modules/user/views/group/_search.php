<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\searchs\GroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box group-search clearfix">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]); ?>

            <?= $form->field($model, 'group_name') ?>

            <?php // echo $form->field($model, 'day_down') ?>

            <?php // echo $form->field($model, 'msg_len') ?>

            <?php // echo $form->field($model, 'msg_num') ?>

            <?php // echo $form->field($model, 'can_reg') ?>

            <?php // echo $form->field($model, 'reg_checked') ?>

            <?php // echo $form->field($model, 'space_style_id') ?>

            <?php // echo $form->field($model, 'day_add_info') ?>

            <?php // echo $form->field($model, 'info_checked') ?>

            <?php // echo $form->field($model, 'pl_checked') ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default'])
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::a('+ 新增会员组', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    </div>
</div>