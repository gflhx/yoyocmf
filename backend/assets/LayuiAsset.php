<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LayuiAsset extends AssetBundle
{
    public $sourcePath = '@backend/static';
    public $css = [
        'inc/layui/css/layui.css',
    ];
    public $js = [
        'inc/layui/layui.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
