<?php
/**
 * Created by PhpStorm.
 * Author: ljt
 * DateTime: 2016/11/4 14:15
 * Description:
 */

namespace backend\widgets\iconpicker;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

class IconPickerWidget extends InputWidget
{

    private $_id;
    private $_name;
    private $_default = '';
    private $_divId;    // div的id命名
    /**
     *
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'iconpicker_' . $this->getId();
        }
        // 赋值input框的ID
        $this->_id = $this->options['id'];
        $this->_name = Html::getInputName($this->model,$this->attribute);
        $this->_divId = $this->getId();

        // 赋值 默认值
        $this->_default = isset($this->options['value']) ? $this->options['value'] : Html::getAttributeValue($this->model, $this->attribute);

        $this->registerAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
//        $targetId = $this->_id;
        $iconPickerId = $this->_divId;
        IconPickerAsset::register($this->view);
//        $this->clientOptions = ArrayHelper::merge($this->clientOptions, [
//            'icon' => $this->_default,
//        ]);
//        $this->clientOptions = Json::encode($this->clientOptions);
        $js = <<<JS
           $('#{$iconPickerId}').iconpicker({
                // title: 'Dropdown with picker',
                //component:'.btn > i'
                templates: {
                    search: '<input type="search" class="form-control iconpicker-search" placeholder="搜索" />',
                }
           });
           $('#{$iconPickerId}').on('iconpickerSelected', function (e) {
                // $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
                //     e.iconpickerInstance.options.iconBaseClass + ' ' +
                //     e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
                $("#{$this->_id}").val(e.iconpickerValue);
            });

           
JS;
        $view->registerJs($js);
    }
    /**
     * @return string bootstrap-picker button with hiddenInput field where we put selected value
     */
    public function run()
    {
        return $this->render('icon-picker', [
            'divId' => $this->_divId,
            'inputId' => $this->_id,
            'inputName' => $this->_name,
            'defaultValue' => $this->_default,
        ]);
    }
}