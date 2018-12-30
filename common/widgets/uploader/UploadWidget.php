<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/16
 * Time: 2:03 PM
 */

namespace common\widgets\uploader;

use yii\base\Arrayable;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

class UploadWidget extends InputWidget
{
    // 默认，可以传参：
    // field 字段名
    // model 模型
    // attribute 模型字段名
    // name  input的name命名
    // value input的默认值
    // options   选项;
    //           id => input的id命名 ,
    //           type => 类型，上传样式类型，1单图上传，2多图上传，3拖拽上传
    //           extension => 可以接受上传的类型

    /**
     *  这里为了配合后台方便处理所有都是设为false,文件上传数目请控制好 $maxNumberOfFiles
     * @var bool
     */
    public $multiple = false;       // 是否多图上传，false为单图，true为多图

    public $maxNumberOfFiles = 1;   // 允许上传的最大文件数目，默认为1，单图

    public $maxFileSize = 0;        // 允许上传文件最大限制，0为不限

    public $onlyImage = true;       // 是否只能上传图片

    /**
     *
     * @var array 上传url地址
     */
    public $url = [];   //fileparam
    /**
     *
     * @var string 允许上传的附件类型，images（图片）file（所有文件）video（视频）audio（音频）
     */
    public $acceptFileTypes;

    /**
     *
     * @var bool
     */
    public $sortable = false;   // 是否可以拖拽排序
    /*
     * ----------------------------------------------
     * 客户端选项,构成$clientOptions
     * ----------------------------------------------
     */
    public $clientOptions = [];

    public $deleteUrl = ["/upload/delete"];

    public $onlyUrl = false;    // 如果有实体字段名，这里传true，可以保存图片的url路径


    public $showTips = true;    // 是否显示提示文字，默认是


    public $fileInputName;
    private $_divId;            // div的id命名
    private $type = 1;          // 赋值上传类型,1单2多3拖拽,显示不同的布局文件

//    private $_id;               // input的id命名
//    private $_name;             // input的name命名
//    private $_default = '';     // 默认图片路径
//    private $_uploadUrl = '';   // 上传图片路由

    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = 'uploader_' . $this->getId();
        }

        //是否多图上传，false为单图，true为多图
        if($this->multiple){
            // 如果是多图
            if($this->onlyImage){
                // 如果仅图片
                $this->type = 2; //多图上传
            }else{
                $this->type = 3; //多文件上传
            }

        }else if(!$this->multiple){
            // 如果是单图
            $this->type = 1;
        }


        // 如果【没有传上传地址】，根据onlyImage是否只上传图片的参数判断
        // -- 如果onlyImage为false => 不需要固定只上传图片
        // ---- multiple为true多图，则为/upload/files-upload
        // ---- multiple为false单图，则为/upload/file-upload

        // -- 如果onlyImage为true => 固定只上传图片
        // ---- multiple为true多图，则为/upload/images-upload
        // ---- multiple为false单图，则为/upload/image-upload
        if (empty($this->url)) {
            if ($this->onlyImage === false) {
                $this->url = $this->multiple ? ['/upload/files-upload'] : ['/upload/file-upload'];
            } else {
                $this->url = $this->multiple ? ['/upload/images-upload'] : ['/upload/image-upload'];
            }
        }

        if ($this->hasModel()) {
            $this->name = $this->name ?: Html::getInputName($this->model, $this->attribute);
            $this->attribute = Html::getAttributeName($this->attribute);
            $value = $this->model->{$this->attribute};
            $attachments = $this->multiple == true ? $value : [$value];
            $this->value = [];
            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $value = $this->formatAttachment($attachment);
                    if ($value) {
                        $this->value[] = $value;
                    }
                }

            }
        }
//        $this->fileInputName = md5($this->name);
//        if (!array_key_exists('fileparam', $this->url)) {
//            $this->url['fileparam'] = $this->fileInputName;//服务器需要通过这个判断是哪一个input name上传的
//        }

        $this->_divId = $this->getId();

        $imgWidth = 0;
        $imgHight = 0;
        if (isset($this->options['img-width'])) {
            $imgWidth = $this->options['img-width'];    // 预览图的宽度
        }
        if (isset($this->options['img-height'])) {
            $imgHight = $this->options['img-height'];    // 预览图的高度
        }

        $ifWater = \Yii::$app->config->get("ifwater"); //是否需要水印
        $this->clientOptions = ArrayHelper::merge($this->clientOptions, [
            'divId' => $this->_divId,
            'id' => $this->options['id'],
            'name' => $this->name,           // 主要用于上传后返回的项目name
            'url' => Url::to($this->url),    // 上传链接，默认file-url，单图上传
            'onlyUrl' => $this->onlyUrl,     // 是否有实体字段，回调只保存表单为url
            'onlyImage' => $this->onlyImage, // 是否只允许上传图片
            'multiple' => $this->multiple,
            'sortable' => $this->sortable,
            'maxNumberOfFiles' => $this->maxNumberOfFiles,
            'maxFileSize' => $this->maxFileSize,
            'acceptFileTypes' => $this->acceptFileTypes,
            'files' => $this->value ?: [],   // 默认文件列表
            'type' => $this->type,           // 上传类型,1单2多3拖拽,显示不同的布局文件
            'showTips' => $this->showTips,   // 是否显示提示文字，默认true
            'imgWidth' => $imgWidth,         // 预览图的宽度
            'imgHight' => $imgHight,         // 预览图的高度
            'ifWater' => $ifWater
        ]);

        // 注册资源
        $this->registerAssets();
    }

    protected function formatAttachment($attachment)
    {
        if (!empty($attachment) && is_string($attachment)) {
            return [
                'url' => $attachment,
                'path' => $attachment,
            ];
        } else if (is_array($attachment)) {
            return $attachment;
        } else if ($attachment instanceof Arrayable)
            return $attachment->toArray();
        return [];
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->view;
        UploadAsset::register($view);
//        p($this->clientOptions);
        $options = json_encode($this->clientOptions);
//        p($options);
        $view->registerJs("AttachmentUploadItems({$options});");

        $cssString = "";
        if(isset($this->options['img-width'])){
            // 预览图的宽度
            $cssString .= "#".$this->_divId." .upload-kit-item img{ width:".$this->options['img-width']."}";
        }
        if(isset($this->options['img-height'])){
            // 预览图的高度
            $cssString .= "#".$this->_divId." .upload-kit-item img{ height:".$this->options['img-height']."}";
        }
        if($cssString){
            $view->registerCss($cssString);
        }
    }

    /**
     * @return string bootstrap-picker button with hiddenInput field where we put selected value
     */
    public function run()
    {
        return $this->render('upload_' . $this->type, [
            "clientOptions" => $this->clientOptions
        ]);
    }
}