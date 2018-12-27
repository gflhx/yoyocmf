<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/4/13
 * Time: 下午4:02
 */
use yii\helpers\Html;
?>

<?php if($addNodeUrl):?>
    <?=Html::button("新增",['class'=>'btn btn-default','id'=>'addParent'])?>
<?php endif;?>

<div class="zTreeDemoBackground left">
    <ul id="<?=$treeId?>" class="ztree"></ul>
</div>

<style type="text/css">
    .ztree *{
        font-family: inherit;
    }
    .layerWraper .layui-layer-content{
        padding: 20px;
    }
    .ztree li span.button.add {
        margin-left: 2px;
        margin-right: -1px;
        background-position: -144px 0;
        vertical-align: top;
        *vertical-align: middle
    }
</style>

<?php
$js = <<<EOF
    $zNodes;
    $setting;
		
		var log, className = "dark";
		function beforeDrag(treeId, treeNodes, targetNode, moveType) {
			return false;
		}
		function beforeEditName(treeId, treeNode) {
			className = (className === "dark" ? "":"dark");
			showLog("[ "+getTime()+" beforeEditName ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
			var zTree = $.fn.zTree.getZTreeObj("$treeId");
			zTree.selectNode(treeNode);
			setTimeout(function() {
				if (confirm("进入节点 -- " + treeNode.name + " 的编辑状态吗？")) {
					setTimeout(function() {
						zTree.editName(treeNode);
					}, 0);
				}
			}, 0);
			return false;
		}
		function beforeRemove(treeId, treeNode) {
			className = (className === "dark" ? "":"dark");
			showLog("[ "+getTime()+" beforeRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
			var zTree = $.fn.zTree.getZTreeObj("$treeId");
			zTree.selectNode(treeNode);
			
			// return $.modal.confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
			return confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
		}
		function onRemove(e, treeId, treeNode) {
		    $.post("$removeNodeUrl", { "id": treeNode.id },  
            function(data){  
                if(data.code == 0){
                    return true;
                }else{
                    alert(data.msg);
                }
            }, "json");
			// showLog("[ "+getTime()+" onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
		}
		
		function onDrag(event, treeId, treeNodes, targetNode, moveType) {
		    console.log(treeNodes.length + "," + (targetNode ? (targetNode.tId + ", " + targetNode.name) : "isRoot" ));
			className = (className === "dark" ? "":"dark");
			showLog("[ "+getTime()+" onDrag ]&nbsp;&nbsp;&nbsp;&nbsp; drag: " + treeNodes.length + " nodes." );
		}
		
		function beforeRename(treeId, treeNode, newName, isCancel) {
			className = (className === "dark" ? "":"dark");
			showLog((isCancel ? "<span style='color:red'>":"") + "[ "+getTime()+" beforeRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>":""));
			if (newName.length == 0) {
				setTimeout(function() {
					var zTree = $.fn.zTree.getZTreeObj("$treeId");
					zTree.cancelEditName();
					alert("节点名称不能为空.");
				}, 0);
				return false;
			}
			return true;
		}
		function onRename(e, treeId, treeNode, isCancel) {
		    console.log(treeNode);
		    $.post("$renameUrl", { "id": treeNode.id,"name":treeNode.name },  
            function(data){  
                if(data.code == 0){
                    return true;
                }else{
                    alert(data.msg);
                }
            }, "json");
		}
		
		function showLog(str) {
			if (!log) log = $("#log");
			log.append("<li class='"+className+"'>"+str+"</li>");
			if(log.children("li").length > 8) {
				log.get(0).removeChild(log.children("li")[0]);
			}
		}
		function getTime() {
			var now= new Date(),
			h=now.getHours(),
			m=now.getMinutes(),
			s=now.getSeconds(),
			ms=now.getMilliseconds();
			return (h+":"+m+":"+s+ " " +ms);
		}

		var newCount = 1;
		
		function addHoverDom(treeId, treeNode) {
			var sObj = $("#" + treeNode.tId + "_span");
			if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
			var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
				+ "' title='新增' onfocus='this.blur();'></span>";
			sObj.after(addStr);
			var btn = $("#addBtn_"+treeNode.tId);
			if (btn) btn.bind("click", function(event){
			    event.stopPropagation(); //阻止事件冒泡
			    var zTree = $.fn.zTree.getZTreeObj("$treeId");
			    var name = "$newNodeDefautTxt";
			    
			    $.post("$addNodeUrl", { "pId": treeNode.id,"name":name},
                    function(data){
                        console.log(2);
                        if(data.code == 0){
                        
                            var newId = data.id;
                            // 增加节点
                            zTree.addNodes(treeNode, {id:newId, pId:treeNode.id, name:name});
                            // 根据新增加的节点id找到新添加的节点 
                            var node = zTree.getNodeByParam("id", newId, null);
                            // 让新增加的节点处于选中状态
                            zTree.selectNode(node);
                            // 编辑新节点，重命名
                            zTree.editName(node);
                    
                        }else{
                            alert(data.msg);
                        }
                    }, "json");
				
				return false;
			});
		};
		
		function add(e) {
			var zTree = $.fn.zTree.getZTreeObj("$treeId"),
			isParent = e.data.isParent,
			nodes = zTree.getSelectedNodes(),
			treeNode = nodes[0];
			var newNodeName = "$newNodeDefautTxt";
			if (treeNode) {
			
			    $.post("$addNodeUrl", { "pId": treeNode.id,"name":newNodeName},
                    function(data){
                        if(data.code == 0){
                            var newId = data.id;
                            treeNode = zTree.addNodes(treeNode, {id:newId, pId:treeNode.id, isParent:isParent, name:newNodeName});
                            zTree.editName(treeNode[0]);
                    
                        }else{
                            alert(data.msg);
                        }
                    }, "json");
			    
			} else {
			
			       $.post("$addNodeUrl", { "pId": 0,"name":newNodeName},
                    function(data){
                        if(data.code == 0){
                            var newId = data.id;
                            treeNode = zTree.addNodes(null, {id:newId, pId:0, isParent:isParent, name:newNodeName});
                            zTree.editName(treeNode[0]);
                        }else{
                            alert(data.msg);
                        }
                    }, "json");
                    
			}
			<!--if (treeNode) {-->
				<!--zTree.editName(treeNode[0]);-->
			<!--} else {-->
				<!--alert("节点被锁定，无法增加子节点");-->
			<!--}-->
		};
		function removeHoverDom(treeId, treeNode) {
		    $("#addBtn_"+treeNode.tId).unbind().remove();
		};
		function selectAll() {
			var zTree = $.fn.zTree.getZTreeObj("$treeId");
			zTree.setting.edit.editNameSelectAll =  $("#selectAll").attr("checked");
		}
		
		function zTreeOnClick(event, treeId, treeNode,clickFlag){
			  layer.open({
              type: 1,
              skin: 'layerWraper',
              title:"修改",
              content: '<form>' +
'<input type="hidden" class="form-control node-id" value="' + treeNode.id + '">' +
'<div class="form-group">' +
'  <label>名称</label>' +
'  <input type="text" class="form-control node-name" placeholder="名称" value="' + treeNode.name + '">' +
'</div>' +
'<div class="form-group">' +
'  <label>排序</label>' +
'  <input type="text" class="form-control node-odr" placeholder="排序" value="'+ treeNode.$odr +'">' +
'</div>' +
  <!--'<div class="form-group">' +-->
  <!--'  <label for="exampleInputFile">File input</label>' +-->
  <!--'  <input type="file" id="exampleInputFile">' +-->
  <!--'  <p class="help-block">Example block-level help text here.</p>' +-->
  <!--'</div>' +-->
  '<button type="button" class="btn btn-default submitEdit">修改</button>' +
'</form>'
            });
		}
		
		$(document).ready(function(){
			$.fn.zTree.init($("#$treeId"), setting, $ztreeName);
			$("#selectAll").bind("click", selectAll);
			$("#addParent").bind("click", {isParent:true}, add);
		});
        $(document).on('click','.submitEdit',function(){
            var id = $(".layerWraper .node-id").val(),
            name = $(".layerWraper .node-name").val(),
            odr = $(".layerWraper .node-odr").val();
            $.post("$renameUrl", { "id": id,"name":name,"odr":odr },  
            function(data){  
                if(data.code == 0){
                    location.reload()
                }else{
                    alert(data.msg);
                }
            }, "json"); 
        });
EOF;

$this->registerJs($js, \yii\web\View::POS_END);
?>