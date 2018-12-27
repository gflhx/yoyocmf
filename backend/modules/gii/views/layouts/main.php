<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$asset = yii\gii\GiiAsset::register($this);

list(, $url) = \Yii::$app->assetManager->publish("@backend/static");
$this->registerCssFile($url . '/css/site.css', ['depends' => [yii\gii\GiiAsset::className()]]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            background: #ecf0f5
        }
    </style>
</head>
<body>
<div class="container-fluid page-container">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style="padding: 15px 0;">
                <?= $content ?>
            </section>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
