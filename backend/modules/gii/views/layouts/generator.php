<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $activeGenerator \yii\gii\Generator */
/* @var $content string */

$generators = Yii::$app->controller->module->generators;
$activeGenerator = Yii::$app->controller->generator;
?>
<?php $this->beginContent('@yii/gii/views/layouts/main.php'); ?>
<style>
    .curd-title a {
        display: block;
        line-height: 3;
        background: #f9f9f9;
        border: 1px solid #fff;
    }

    .curd-title a.active {
        background: #088ec1;
        color: #fff;
    }
</style>
<div class="yoyo-box">

    <div class="row curd-title">
        <?php
        foreach ($generators as $id => $generator) {
            $label = Html::encode($generator->getName());
            echo Html::a($label, ['default/view', 'id' => $id], [
                'class' => $generator === $activeGenerator ? 'col-xs-4 active' : 'col-xs-4',
            ]);
        }
        ?>
    </div>
</div>


<?= $content ?>



<?php $this->endContent(); ?>
