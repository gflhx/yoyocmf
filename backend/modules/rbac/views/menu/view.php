<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title); ?></h3>
        </div>
        <div class="col-xs-8 text-right">

            <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('删除', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '是否确定删除?',
                    'method' => 'post',
                ],
            ])
            ?>
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>


<div class="yoyo-box mt20 menu-view">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'menuParent.name:text:Parent',
            [
                'attribute' => 'menuParent.name',
                'label' => '父级'
            ],
            'name',
            'route',
            'order',
        ],
    ])
    ?>

</div>
