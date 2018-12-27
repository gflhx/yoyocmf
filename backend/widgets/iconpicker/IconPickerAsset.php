<?php
/**
 * Created by PhpStorm.
 * Author: ljt
 * DateTime: 2016/11/4 14:12
 * Description:
 */

namespace backend\widgets\iconpicker;


use yii\web\AssetBundle;

class IconPickerAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/iconpicker/static';
    public $css=[
        'css/fontawesome-iconpicker.min.css'
    ];
    public $js= [
        'js/fontawesome-iconpicker.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\FontAwesomeAsset',
    ];
}