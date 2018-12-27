<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\EnewsclassSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box enewsclass-search clearfix">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]); ?>

            <?= $form->field($model, 'classname') ?>

            <?php // echo $form->field($model, 'lencord') ?>

            <?php // echo $form->field($model, 'link_num') ?>

            <?php // echo $form->field($model, 'onclick') ?>

            <?php // echo $form->field($model, 'featherclass') ?>

            <?php // echo $form->field($model, 'islast') ?>

            <?php // echo $form->field($model, 'openpl') ?>

            <?php // echo $form->field($model, 'openadd') ?>

            <?php // echo $form->field($model, 'newline') ?>

            <?php // echo $form->field($model, 'hotline') ?>

            <?php // echo $form->field($model, 'goodline') ?>

            <?php // echo $form->field($model, 'hotplline') ?>

            <?php // echo $form->field($model, 'firstline') ?>

            <?php // echo $form->field($model, 'classurl') ?>

            <?php // echo $form->field($model, 'groupid') ?>

            <?php // echo $form->field($model, 'myorder') ?>

            <?php // echo $form->field($model, 'checkpl') ?>

            <?php // echo $form->field($model, 'checked') ?>

            <?php // echo $form->field($model, 'checkqadd') ?>

            <?php // echo $form->field($model, 'tbname') ?>

            <?php // echo $form->field($model, 'listorder') ?>

            <?php // echo $form->field($model, 'reorder') ?>

            <?php // echo $form->field($model, 'bname') ?>

            <?php // echo $form->field($model, 'intro') ?>

            <?php // echo $form->field($model, 'classpagekey') ?>

            <?php // echo $form->field($model, 'classimg') ?>

            <?php // echo $form->field($model, 'addinfofen') ?>

            <?php // echo $form->field($model, 'showclass') ?>

            <?php // echo $form->field($model, 'qaddgroupid') ?>

            <?php // echo $form->field($model, 'qaddshowkey') ?>

            <?php // echo $form->field($model, 'adminqinfo') ?>

            <?php // echo $form->field($model, 'nrejs') ?>

            <?php // echo $form->field($model, 'sametitle') ?>

            <?php // echo $form->field($model, 'wburl') ?>

            <?php // echo $form->field($model, 'qeditchecked') ?>

            <?php // echo $form->field($model, 'cgroupid') ?>

            <?php // echo $form->field($model, 'cgtoinfo') ?>

            <?php // echo $form->field($model, 'bdinfoid') ?>

            <?php // echo $form->field($model, 'allinfos') ?>

            <?php // echo $form->field($model, 'infos') ?>

            <?php // echo $form->field($model, 'created_at') ?>

            <?php // echo $form->field($model, 'updated_at') ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default'])
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::a('+ 新增栏目', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    </div>
</div>