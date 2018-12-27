<?php
use yii\helpers\Html;
use dmstr\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this->title = "后台管理系统";
if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

//    if (class_exists('backend\assets\AppAsset')) {
//        backend\assets\AppAsset::register($this);
//    } else {
//        app\assets\AppAsset::register($this);
//    }
    backend\assets\AppAsset::register($this);

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            .layui-tab{
                margin:0;
                padding: 10px;
            }
            .layui-tab .layui-tab-title li{
                background:#dfe2e8;
                margin-right: 3px;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .layui-tab .layui-tab-title li:after{
                border-bottom-color: #ebf0f4;
            }
            .layui-tab .layui-tab-title li.layui-this{
                color: #5081b7;
                background: #ceddea;
            }
            .layui-tab .layui-tab-title li.layui-this i{
                color: #5081b7;
            }
            .layui-tab .layui-tab-content{
                padding: 0;
            }
            /*.layui-tab .layui-tab-title{*/
                /*background:#dfe2e8;*/
            /*}*/
            .rightmenu{
                background: #fff;
                padding: 10px;
                border-radius: 4px;
                -moz-box-shadow:0 1px 3px rgba(0, 0, 0, .2); -webkit-box-shadow:0 1px 3px rgba(0, 0, 0, .2); box-shadow:0 1px 3px rgba(0, 0, 0, .2)
            }
            .rightmenu li:hover{
                color: #088ec1;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            '../layouts/header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            '../layouts/left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <div class="content-wrapper">
            <div class="layui-tab" lay-filter="demo" lay-allowclose="true">
                <ul class="layui-tab-title">
                </ul>
                <ul class="rightmenu" style="display: none;position: absolute;">
<!--                    <li data-type="closethis">关闭当前</li>-->
                    <li data-type="closeother">关闭其他</li>
                    <li data-type="closeall">关闭所有</li>
                </ul>
                <div class="layui-tab-content">

                </div>
            </div>
        </div>

    </div>

    <?php $this->endBody() ?>

    <?php if (isset($this->blocks['js'])): ?>
        <?= $this->blocks['js'] ?>
    <?php endif; ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
