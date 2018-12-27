<?php
// 权限管理 / 角色管理 视图文件
use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\rbac\components\RouteRule;
use backend\modules\rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $labels['Item'] . '管理';
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>

<div class="yoyo-box clearfix">
    <div class="row">
        <div class="col-xs-4">
            <h3><?= $this->title ?></h3>
        </div>
        <div class="col-xs-8 text-right">
            <?= Html::a('+ 新增' . $labels['Item'], ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
<div class="yoyo-box role-index mt20">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => '名称',
            ],
            [
                'attribute' => 'ruleName',
                'label' => '规则名称',
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' => '描述',
            ],
            ['class' => 'yii\grid\ActionColumn',],
        ],
    ])
    ?>

</div>
