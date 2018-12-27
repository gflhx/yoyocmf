<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\SystemLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yoyo-box system-log-search clearfix">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]); ?>


            <?= $form->field($model, 'level') ?>

            <?= $form->field($model, 'category') ?>

            <?php // echo $form->field($model, 'message') ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default'])
                ?>
                <?= Html::a('批量删除', "javascript:void(0);", ['class' => 'btn btn-danger gridview']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::a('+ 新增 System Log', ['create'], ['class' => 'btn btn-success']) ?>

        </div>

    </div>
</div>

<?php $this->beginBlock('js') ?>
    <script>
        $(".gridview").on("click", function () {
            var keys = $("#grid").yiiGridView("getSelectedRows");
            if(!keys.length){
                layer.msg("请先勾选要删除的信息");
                return false;
            }

        });
    </script>
<?php $this->endBlock() ?>