<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Document */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
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

<div class="yoyo-box mt20 document-view">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'smalltext',
            'classid',
            'ttid',
            'onclick',
            'plnum',
            'totaldown',
            'newspath',
            'filename',
            'user_id',
            'username',
            'firsttitle',
            'isgood',
            'ispic',
            'istop',
            'ismember',
            'isurl',
            'havehtml',
            'groupid',
            'userfen',
            'titlefont',
            'titleurl',
            'created_at',
            'updated_at',
            'ftitle',
            'diggtop',
            'stb',
            'title',
            'titlepic',
    ],
    ]) ?>

</div>
