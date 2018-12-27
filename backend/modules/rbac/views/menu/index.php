<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = "菜单";
$this->params['breadcrumbs'][] = $this->title;
//p($dataProvider->models);
?>

<?= $this->render('_search', ['model' => $searchModel]); ?>

<div class="yoyo-box menu-index mt20">

    <?php
    if ($searchModel->name || $searchModel->route) {
        // 如果是搜索名称或者路由地址
        ?>

        <?php
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'name',
                [
                    'attribute' => 'menuParent.name',
                    'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                        'class' => 'form-control', 'id' => null
                    ]),
                    'label' => '父级菜单',
                ],
                'route',
                'order',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        Pjax::end();
        ?>

        <?php
    } else {
        // 菜单列表
        ?>

        <?php
        ?>
        <?= \backend\widgets\grid\TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'id',
            'parentColumnName' => 'parent',
            'parentRootValue' => null, //first parentId value
            'pluginOptions' => [
                'initialState' => 'expanded',// expanded默认展开,collapse收起，只显示一级栏目
            ],
            'columns' => [
                'name',
                'route',
                [
                    'attribute' => 'icon',
                    'label' => '图标',
                    'value' => function ($model) {
                        return "<i class='" . $model->icon . "'></i>";
                    },
                    'format' => 'raw'
                ],
                'order',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{create} {view} {update} {delete}',
                    'buttons' => [
                        'create' => function ($url, $model) {
                            return Html::a("<i class='fa fa-plus'></i>", ['create', 'id' => $model->id], ['class' => 'btn btn-default btn-xs']);
                        }
                    ]
                ],
            ],
        ]);
        ?>
        <?
    }
    ?>

</div>
