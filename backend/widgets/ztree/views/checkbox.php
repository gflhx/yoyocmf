<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/5/1
 * Time: 上午1:10
 */

use yii\helpers\Html;

?>

<?php if ($selectAll): ?>

    <?= Html::button('全选', [
        'class' => 'btn btn-default btn-xs',
        'id' => $treeId . '-checkAllTrue'
    ]); ?>

    <?= Html::button('取消全选', [
        'class' => 'btn btn-default btn-xs',
        'id' => $treeId . '-checkAllFalse'
    ]); ?>

    <?= Html::button('-全部展开', [
        'class' => 'btn btn-default btn-xs',
        'id' => $treeId . '-expandAllBtn'
    ]); ?>
    <?= Html::button('+全部收起', [
        'class' => 'btn btn-default btn-xs',
        'id' => $treeId . '-collapseAllBtn'
    ]); ?>

<?php endif; ?>

<ul id="<?= $treeId ?>" class="ztree"></ul>
<input type="hidden" id="<?= $treeId ?>_check" name="<?= $formName ?>" value="<?= $defaultValue ?>">

<style type="text/css">
    .ztree * {
        font-family: inherit;
    }
</style>

<?php
$js = <<<EOF
(function($){

    var treeIdName = "{$treeId}";
    var zNodes = {$zNodes};
    {$setting}
    $(document).ready(function(){
        $.fn.zTree.init($("#"+treeIdName), setting, zNodes);
    
        $("#" + treeIdName + "-checkAllTrue").bind("click", {type:"checkAllTrue"}, checkNode); // 全选
        $("#" + treeIdName + "-checkAllFalse").bind("click", {type:"checkAllFalse"}, checkNode); // 取消全选
        $("#" + treeIdName + "-expandAllBtn").bind("click", {type:"expandAll"}, expandNode);// 全部展开
		$("#" + treeIdName + "-collapseAllBtn").bind("click", {type:"collapseAll"}, expandNode);// 全部收起
    });

    function expandNode(e) {
        var zTree = $.fn.zTree.getZTreeObj(treeIdName),
        type = e.data.type,
        nodes = zTree.getSelectedNodes();
        if (type.indexOf("All")<0 && nodes.length == 0) {
            alert("请先选择一个父节点");
        }

        if (type == "expandAll") {
            zTree.expandAll(true);
        } else if (type == "collapseAll") {
            zTree.expandAll(false);
        } else {
            var callbackFlag = $("#callbackTrigger").attr("checked");
            for (var i=0, l=nodes.length; i<l; i++) {
                zTree.setting.view.fontCss = {};
                if (type == "expand") {
                    zTree.expandNode(nodes[i], true, null, null, callbackFlag);
                } else if (type == "collapse") {
                    zTree.expandNode(nodes[i], false, null, null, callbackFlag);
                } else if (type == "toggle") {
                    zTree.expandNode(nodes[i], null, null, null, callbackFlag);
                } else if (type == "expandSon") {
                    zTree.expandNode(nodes[i], true, true, null, callbackFlag);
                } else if (type == "collapseSon") {
                    zTree.expandNode(nodes[i], false, true, null, callbackFlag);
                }
            }
        }
    }
		
    function checkNode(e) {
        var zTree = $.fn.zTree.getZTreeObj(treeIdName),
            type = e.data.type,
            nodes = zTree.getSelectedNodes();
        if (type.indexOf("All")<0 && nodes.length == 0) {
            alert("请先选择一个节点");
        }

        if (type == "checkAllTrue") {
            zTree.checkAllNodes(true);
        } else if (type == "checkAllFalse") {
            zTree.checkAllNodes(false);
        } else {
            var callbackFlag = $("#callbackTrigger").attr("checked");
            for (var i=0, l=nodes.length; i<l; i++) {
                if (type == "checkTrue") {
                    zTree.checkNode(nodes[i], true, false, callbackFlag);
                } else if (type == "checkFalse") {
                    zTree.checkNode(nodes[i], false, false, callbackFlag);
                } else if (type == "toggle") {
                    zTree.checkNode(nodes[i], null, false, callbackFlag);
                }else if (type == "checkTruePS") {
                    zTree.checkNode(nodes[i], true, true, callbackFlag);
                } else if (type == "checkFalsePS") {
                    zTree.checkNode(nodes[i], false, true, callbackFlag);
                } else if (type == "togglePS") {
                    zTree.checkNode(nodes[i], null, true, callbackFlag);
                }
            }
        }
        onCheck();
    }


    /**
     *
     * @param e
     * @param treeId
     * @param treeNode  当前树节点
     */
    function onCheck(e, treeId, treeNode) {

        var treeObj = $.fn.zTree.getZTreeObj(treeIdName);
        var nodes = treeObj.getCheckedNodes(true);

        var ids = [];
        for (var i=0; i<nodes.length; i++) {
            if(nodes[i].pId){
                ids.push(nodes[i].id);
//                console.log(nodes[i]);
            }
        }
        $("#" + treeIdName + "_check").val(ids);
    }
    
   
    function getTime() {
        var now= new Date(),
            h=now.getHours(),
            m=now.getMinutes(),
            s=now.getSeconds(),
            ms=now.getMilliseconds();
        return (h+":"+m+":"+s+ " " +ms);
    }

})(jQuery);


EOF;

$this->registerJs($js, \yii\web\View::POS_END);
?>
