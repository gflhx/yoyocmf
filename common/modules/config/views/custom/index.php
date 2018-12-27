<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\config\models\searchs\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 config-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description',
//            'value:ntext',
//            'extra:ntext',
            'type',
            //'created_at',
            //'updated_at',
            'group',
            'sort',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
