<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\rbac\components\Helper;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>

<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= Html::encode($this->title); ?></h3>
        </div>
        <div class="col-xs-8 text-right">
            <?php
            if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
                echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                        'method' => 'post',
                    ],
                ]);
            }
            ?>

            <?= Html::a('更新', ['/user/default/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            <?php
            if (Helper::checkRoute($controllerId . 'delete')) {
                echo Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }
            ?>
            <a class="btn btn-success" href="javascript:history.go(-1)" role="button">返回</a>
        </div>
    </div>
</div>


<div class="yoyo-box mt20 user-view">

    <?php
    $columns = [
        'username',
        [
            'attribute' => 'group_id',
            'label' => '会员组',
            'value' => function ($model) {
                return $model->group ? $model->group->group_name : "";
            },
        ],
        'email:email',
        'user_fen',
        'money',
        [
            'attribute' => 'user_date',
            'value' => function ($model) {
                return $model->user_date > 0 ? $model->user_date : "不限";
            },
        ],
        [
            'attribute' => 'z_group_id',
            'label' => '到期后转向',
            'value' => function ($model) {
                return $model->zGroup ? $model->zGroup->group_name : "不设置";
            },
        ],
        [
            'attribute' => 'checked',
            'label' => '帐号状态',
            'value' => function ($model) {
                return \common\modules\user\models\User::getChecked($model->checked);
            },
        ],
        'created_at:datetime'
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $columns
    ])
    ?>

</div>
