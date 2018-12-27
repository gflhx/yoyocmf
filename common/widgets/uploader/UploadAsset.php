<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/16
 * Time: 2:18 PM
 */

namespace common\widgets\uploader;

use yii\web\AssetBundle;

class UploadAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/uploader/static';
    public $css = [
        'css/upload.css'
    ];
    public $js = [
        'js/upload.js',
    ];
    public $depends = [
        'backend\assets\LayuiAsset',
    ];
}