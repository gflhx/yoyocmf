<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\searchs\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 group-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            'group_id',
            'group_name',
            'level',
            'fava_num',
            'day_down',
            'msg_len',
            'msg_num',
            [
                'attribute' => 'can_reg',
                'label' => '前台可注册',
                'value' => function ($model) {
                    return $model->getCanReg($model->can_reg);
                },
            ],
            //'reg_checked',
            //'space_style_id',
            //'day_add_info',
            //'info_checked',
            //'pl_checked',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
