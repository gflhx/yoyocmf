<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Enewsclass */

$this->title = $model->classid;
$this->params['breadcrumbs'][] = ['label' => 'Enewsclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="col-xs-8 text-right">
            <?= Html::a('更新', ['update', 'id' => $model->classid], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('删除', ['delete', 'id' => $model->classid], [
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

<div class="yoyo-box mt20 enewsclass-view">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'classid',
            'bclassid',
            'classname',
            'sonclass:ntext',
            'is_zt',
            'lencord',
            'link_num',
            'onclick',
            'featherclass:ntext',
            'islast',
            'openpl',
            'openadd',
            'newline',
            'hotline',
            'goodline',
            'hotplline',
            'firstline',
            'classurl',
            'groupid',
            'myorder',
            'checkpl',
            'checked',
            'checkqadd',
            'tbname',
            'listorder',
            'reorder',
            'bname',
            'intro:ntext',
            'classpagekey',
            'classimg',
            'addinfofen',
            'showclass',
            'qaddgroupid:ntext',
            'qaddshowkey',
            'adminqinfo',
            'nrejs',
            'sametitle',
            'wburl',
            'qeditchecked',
            'cgroupid:ntext',
            'cgtoinfo',
            'bdinfoid',
            'allinfos',
            'infos',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>
