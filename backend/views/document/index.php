<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 document-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            'id',
//            'smalltext',
            [
                'attribute' => 'titlepic',
                'value' => function ($model) {
                    if ($model->titlepic) {
                        return Html::img($model->titlepic,
                            ['class' => 'thumbnail',
                                'width' => 100]
                        );
                    } else {
                        return "";
                    }
                },
                'format' => 'raw'
            ],
//            'classid',
//            'ttid',
            'title',
            'ftitle',
            'onclick',
            //'plnum',
            //'totaldown',
            //'newspath',
            //'filename',
            //'user_id',
            //'username',
            //'firsttitle',
            //'isgood',
            //'ispic',
            //'istop',
            //'ismember',
            //'isurl',
            //'havehtml',
            //'groupid',
            //'userfen',
            //'titlefont',
            //'titleurl',
            //'created_at',
            //'updated_at',
            //'diggtop',
            //'stb',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
