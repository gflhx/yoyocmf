<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\Department */

$this->title = $model->department_name;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-xs-8 text-right">
            <?= Html::a('更新', ['update', 'id' => $model->department_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('删除', ['delete', 'id' => $model->department_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '是否确定删除??',
                    'method' => 'post',
                ],
            ]) ?>
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>

<div class="yoyo-box mt20 department-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'parent',
                'label' => '上级部门',
                'value' => function ($model) {
                    return $model->getParentName();
                },
            ],
            'department_name',
            [
                'attribute' => 'titlepic',
                'label' => '部门图片',
                'value' => function ($model) {
                    if ($model->titlepic) {
                        return Html::img($model->titlepic[0]->url,
                            [
                                    'class' => 'thumbnail',
                                'style' => 'max-width:300px'
                            ]
                        );
                    } else {
                        return "";
                    }
                },
                'format' => 'raw'
            ],
            'level',
            'myorder',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
