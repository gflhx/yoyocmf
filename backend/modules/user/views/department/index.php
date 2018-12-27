<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\searchs\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box mt20 department-index">

    <div class="layui-elem-quote">
        <p>说明：主部门按部门级别排序，子部门按排序值，排序值默认不用填，自动递增</p>
    </div>

    <?php
    if ($searchModel->department_name) {
        // 如果是部门搜索名称
        ?>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'department_name',
                'level',
                'myorder',
                [
                    'attribute' => 'titlepic',
                    'label' => '部门图片',
                    'value' => function ($model) {
                        if($model->titlepic){
                            return Html::img($model->titlepic->url,
                                ['class' => 'thumbnail',
                                    'width' => 200]
                            );
                        }else{
                            return "";
                        }
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{create} {view} {update} {delete}',
                    'buttons' => [
                        'create' => function ($url, $model) {
                            return Html::a("<i class='fa fa-plus'></i>", ['create', 'id' => $model->department_id], ['class' => 'btn btn-default btn-xs']);
                        }
                    ]
                ],
            ],
        ]);

        ?>

        <?php
    } else {
        // 部门列表
        ?>

        <?= \backend\widgets\grid\TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'department_id',
            'parentColumnName' => 'parent',
            'parentRootValue' => null, //first parentId value
            'pluginOptions' => [
                'initialState' => 'collapse',// expanded默认展开,collapse收起，只显示一级栏目
            ],
            'columns' => [
                'department_name',
                'level',
                'myorder',
                [
                    'attribute' => 'titlepic',
                    'label' => '部门图片',
                    'value' => function ($model) {
                        if($model->titlepic){
                            return Html::img($model->titlepic->url,
                                ['class' => 'thumbnail',
                                    'width' => 150]
                            );
                        }else{
                            return "";
                        }
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{create} {view} {update} {delete}',
                    'buttons' => [
                        'create' => function ($url, $model) {
                            return Html::a("<i class='fa fa-plus'></i>", ['create', 'id' => $model->department_id], ['class' => 'btn btn-default btn-xs']);
                        }
                    ]
                ],
            ],
        ]); ?>

        <?
    }
    ?>


</div>
