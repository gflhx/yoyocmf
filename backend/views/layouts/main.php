<?php

use yii\helpers\Html;
use dmstr\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

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
            .content-wrapper {
                margin-left: 0;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <div class="content-wrapper">

            <section class="content" style="padding: 15px 0;">

                <?= Alert::widget() ?>
                <?= $this->render(
                    'content.php',
                    ['content' => $content, 'directoryAsset' => $directoryAsset]
                ) ?>
            </section>

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
