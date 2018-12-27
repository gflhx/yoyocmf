<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\searchs\Menu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="yoyo-box menu-search clearfix">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php
            Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]);
            ?>

            <?= $form->field($model, 'name')->label("菜单名称") ?>
            <?= $form->field($model, 'route')->label("路由地址") ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', \yii\helpers\Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::a('+ 新增菜单', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
