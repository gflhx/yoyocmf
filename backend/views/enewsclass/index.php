<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\EnewsclassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enewsclasses';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 enewsclass-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            'classid',
//            'bclassid',
            'classname',
            'bname',
            'classimg',
//            'sonclass:ntext',
//            'is_zt',
            //'lencord',
            //'link_num',
//            'onclick',
            //'featherclass:ntext',
            //'islast',
            //'openpl',
            //'openadd',
            //'newline',
            //'hotline',
            //'goodline',
            //'hotplline',
            //'firstline',
            //'classurl',
            //'groupid',
            'myorder',
            //'checkpl',
            //'checked',
            //'checkqadd',
            //'tbname',
            //'listorder',
            //'reorder',
            //'intro:ntext',
            //'classpagekey',
            //'addinfofen',
            //'showclass',
            //'qaddgroupid:ntext',
            //'qaddshowkey',
            //'adminqinfo',
            //'nrejs',
            //'sametitle',
            //'wburl',
            //'qeditchecked',
            //'cgroupid:ntext',
            //'cgtoinfo',
            //'bdinfoid',
            //'allinfos',
            //'infos',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
