<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\attachment\models\searchs\AttachmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attachments';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 attachment-index">

    <?php Pjax::begin(['id' => 'attachment-list']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-responsive',
            'id' => 'layer-photos-demo'
        ],
        'columns' => [
//            'id',
//            'user_id',
            [
                'label' => '附件',
                'value' => function ($model) {
                    if (in_array($model->extension, ["png", "jpg", "gif"])) {
                        return Html::img($model->url, ['class' => 'thumbnail', 'width' => 100, 'layer-src' => $model->url,'title'=>$model->oname,'alt'=>$model->oname]);
                    } else {
                        return Html::img(Yii::$app->config->get("newsurl")."storage/images/file.png", ['class' => 'thumbnail', 'width' => 80]);
                    }
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'label' => '上传人',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : "";
                },
                'format' => 'raw',
            ],
            'oname',
            'title',
            [
                'attribute' => 'size',
                'label' => '文件大小',
                'value' => function ($model) {
                    // 应该是除以1024，不过结果与硬盘中显示的要少，除以1000刚好一致，flag
                    return sprintf("%.2f", $model->size/1000)." KB";
                },
            ],
            [
                'attribute' => 'created_at',
                'label' => '上传人',
                'value' => function ($model) {
                    return date("Y-m-d H:i",$model->created_at);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
