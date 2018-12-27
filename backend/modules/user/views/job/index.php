<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\searchs\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 job-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'job_name',
            'myorder',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
