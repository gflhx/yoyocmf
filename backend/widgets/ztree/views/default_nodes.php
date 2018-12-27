<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/5/1
 * Time: 上午1:10
 */
use yii\helpers\Html;

/** @var $SELF_KEY *自定义区分dom */
/** @var $treeId *树的id命名 */
/** @var $ifSearch *是否需要搜索 */

//p($pjKey);
$keyIdName = "key_" . $SELF_KEY;
?>

<?php if($ifSearch):?>
<?= Html::input('text', 'username', null, ['id' => $keyIdName,'class'=>'empty','placeholder'=>'输入关键字搜索']) ?>
<?php endif;?>

<?= Html::button('-全部展开', [
    'class' => 'btn btn-default btn-xs',
    'id' => $treeId . '-expandAllBtn'
]); ?>

<?= Html::button('+全部收起', [
    'class' => 'btn btn-default btn-xs',
    'id' => $treeId . '-collapseAllBtn'
]); ?>

<ul id="<?= $treeId ?>" class="ztree"></ul>



<style type="text/css">
    .ztree *{
        font-family: inherit;
    }
</style>


<?php
$js = <<<EOF

    function focusKey{$SELF_KEY}(e) {
			if (key_{$SELF_KEY}.hasClass("empty")) {
				key_{$SELF_KEY}.removeClass("empty");
			}
		}
		function blurKey{$SELF_KEY}(e) {
			if (key_{$SELF_KEY}.get(0).value === "") {
				key_{$SELF_KEY}.addClass("empty");
			}
		}
		var lastValue = "", nodeList = [], fontCss = {};
		function clickRadio(e) {
			lastValue = "";
			searchNode{$SELF_KEY}(e);
		}
		function searchNode{$SELF_KEY}(e) {
//		    console.log("{$SELF_KEY}");
			var zTree = $.fn.zTree.getZTreeObj("{$treeId}");
//			if (!$("#getNodesByFilter").attr("checked")) {
				var value = $.trim(key_{$SELF_KEY}.get(0).value);
				var keyType = "";
				keyType = "name"; // 可以是name / level / id
				if (key_{$SELF_KEY}.hasClass("empty")) {
					value = "";
				}
				
				if (lastValue === value) return;
				lastValue = value;
				if (value === "") return;
				updateNodes{$SELF_KEY}(false);

				nodeList = zTree.getNodesByParamFuzzy(keyType, value);
				
//				console.log(nodeList);
				
//			} else {
//				updateNodes{$SELF_KEY}(false);
//				nodeList = zTree.getNodesByFilter(filter);
//			}

			updateNodes{$SELF_KEY}(true);

		}
		function updateNodes{$SELF_KEY}(highlight) {
			var zTree = $.fn.zTree.getZTreeObj("{$treeId}");
			for( var i=0, l=nodeList.length; i<l; i++) {
				nodeList[i].highlight = highlight;
				zTree.updateNode(nodeList[i]);
			}
		}
		
		function filter(node) {
			return !node.isParent && node.isFirstNode;
		}

        function expandNode{$SELF_KEY}(e) {
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
    
		var key_{$SELF_KEY};
		var treeIdName = "{$treeId}";
		
		$(document).ready(function(){
		
			key_{$SELF_KEY} = $("#{$keyIdName}");
			key_{$SELF_KEY}.bind("focus", focusKey{$SELF_KEY})
			.bind("blur", blurKey{$SELF_KEY})
			.bind("propertychange", searchNode{$SELF_KEY})
			.bind("input", searchNode{$SELF_KEY});
			
			$("#{$treeId}-expandAllBtn").bind("click", {type:"expandAll"}, expandNode{$SELF_KEY});// 全部展开
		    $("#{$treeId}-collapseAllBtn").bind("click", {type:"collapseAll"}, expandNode{$SELF_KEY});// 全部收起
		
		});

EOF;

$this->registerJs($js, \yii\web\View::POS_END);
?>
