<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\attachment\models\Attachment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-xs-8 text-right">
            <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('删除', ['delete', 'id' => $model->id], [
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

<div class="yoyo-box mt20 attachment-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => '文件',
                'value' => function ($model) {
                    if (in_array($model->extension, ["png", "jpg", "gif"])) {
                        return Html::a(Html::img($model->url, ['class' => 'thumbnail', 'width' => 100,'alt'=>$model->oname]),$model->url,['target'=>'_blank']);
                    } else {
                        return Html::a($model->oname,$model->url,['target'=>'_blank']);
                    }
                },
                'format' => 'raw',
            ],
            'user_id',
            'name',
            'oname',
            'title',
            'description',
            'path',
            'hash',
            'size',
            'type',
            'extension',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
