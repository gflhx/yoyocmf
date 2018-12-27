<?php
/**
 * Created by PhpStorm. 高级 增 / 删 / 改 节点
 * User: yoyo
 * Date: 2018/4/13
 * Time: 下午3:37
 *
 * 参考网址：http://www.treejs.cn/v3/demo.php#_201
 */

namespace backend\widgets\ztree;

use backend\widgets\ztree\assets\ZtreeAssets;
use yii\base\Widget;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class CheckboxWidget extends Widget
{

    public $model; // 可选参数
    public $attribute; // 可选参数
    public $name; // 可选参数
    public $defaultValue; // 可选参数，默认显示参数
    public $selectAll = true; //全选与取消全选的按钮是否显示，默认为全部

    public $setting = [];// 如果不加公共方法， 不传参走不到setSetting那里
    private $_setting = '[]'; // 设置
    private $_nodes = '[]';
    private $id;

    /**
     * 初始化
     * @see \yii\base\Object::init()
     */
    public function init()
    {
        parent::init();

        if (is_null($this->id)) {
            $this->id = $this->getId(); // 获取页面中生成的下一个div的id命名
        }
        $this->setSetting();
    }

    public function run()
    {
        $this->registerAssets();    // 注册资源包
        return $this->renderZtree();
    }

    // 默认传参 setting 这里赋值给_setting
    public function setSetting()
    {
        $setting = [
            'check' => [
                'enable' => true
            ],
            'data' => [
                'simpleData' => [
                    'enable' => true
                ]
            ]
        ];

        $value = $this->setting;
        $setting = json_encode($setting, JSON_UNESCAPED_UNICODE);

        $js = "
                var setting = {$setting};
                setting.callback = {
                    onCheck : onCheck
                };
            ";

        if($value && is_array($value)){

            foreach ($value as $k => $v){
                $js .= "
                    setting.{$k} = {$v};
                ";
            }
        }

        $this->_setting = stripslashes($js);
    }

    // 默认传参 nodes 这里赋值给_nodes
    public function setNodes($value)
    {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        $this->_nodes = $value;
    }

    /**
     * 注册资源
     * @return bool
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        ZtreeAssets::register($view);

//        $js = $this->_setting;
//        $js .= 'var zNodes = ' . $this->_nodes . ';';
//        $js .= '$.fn.zTree.init($("#' . $this->id . '"), setting, zNodes);';
//        $view->registerJs($js);
    }

    public function renderZtree(){
        // 获取字段的属性名称
        if($this->attribute && $this->model){
            $attribute = Html::getAttributeName($this->attribute);
            $formName = Html::getInputName($this->model, $attribute);
        }else if($this->name){
            $formName = $this->name;
        }else{
            $formName = 'checkbox-widget-val';
        }
//        $attribute = Html::getAttributeName($this->attribute);
        // 根据模型 获取字段生成的name值用来填充表单

//        p($formName);
        $defaultValue = $this->defaultValue;
        return $this->render('checkbox', [
            'selectAll' => $this->selectAll,
            'setting' => $this->_setting,
            'zNodes' => $this->_nodes,
            'treeId' => $this->id,
            'formName' => $formName,
            'defaultValue' => $defaultValue,
        ]);
    }

}