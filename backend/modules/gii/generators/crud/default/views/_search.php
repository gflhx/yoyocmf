<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search clearfix">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?= "<?php " ?>
            Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['class' => 'form-inline'],
            <?php if ($generator->enablePjax): ?>
                'options' => [
                'data-pjax' => 1
                ],
            <?php endif; ?>
            ]); ?>

            <?php
            $count = 0;
            foreach ($generator->getColumnNames() as $attribute) {
                if (++$count < 6) {
                    echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
                } else {
                    echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
                }
            }
            ?>
            <div class="form-group">
                <?= "<?= " ?>Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= "<?= " ?>Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default'])
                ?>
            </div>

            <?= "<?php " ?>ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= "<?= " ?>
            Html::a(<?= $generator->generateString('+ 新增 ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>
            , ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    </div>
</div>