<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\config\models\searchs\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .layui-tab-title li.layui-this{
        background: #fff;
    }
</style>
<div class="yoyo-box clearfix">
    <h3><?= Html::encode($this->title) ?></h3>
</div>

<div class="yoyo-box mt20 config-index">

    <div class="layui-tab">
        <ul class="layui-tab-title">
            <?php foreach($groups as $k => $g): ?>
                <li<?php if ($k == $group): ?> class="layui-this"<?php endif; ?>><?= Html::a($g, ['index', 'group' => $k]) ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="layui-tab-content">
            <?php
            $form = ActiveForm::begin(['action' => ['store', 'group' => $group]]);
            foreach ($configModels as $index => $configModel) {
                echo $form->field($configModel, "[$index]value")->label($configModel->description)->widget(\common\widgets\dynamicInput\DynamicInputWidget::className(),[
                    'data' => $configModel->extra,
                    'type' => $configModel->type
                ]);
            }
            echo Html::submitButton('提交', ['class' => 'btn btn-primary btn-flat btn-block']);
            ActiveForm::end();
            ?>
        </div>
    </div>

</div>

<?php $this->beginBlock('js') ?>
<script>
    layui.use('element', function(){
        var element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
    });
</script>
<?php $this->endBlock() ?>