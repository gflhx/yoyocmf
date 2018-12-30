<?php
/**
 * 多文件上传
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/16
 * Time: 2:15 PM
 */
?>
    <div class="layui-upload" id="<?= $clientOptions["divId"] ?>">
        <input type="hidden" name="<?= $clientOptions["name"] ?>[]">
        <button type="button" class="layui-btn layui-btn-normal testList">选择多文件</button>

        <?php
        if ($clientOptions["showTips"]) {

            if (function_exists('ini_get')) {
                $uploadsize = ini_get('upload_max_filesize');
            } else {
                $uploadsize = get_cfg_var('upload_max_filesize');
            }

            if (function_exists('ini_get')) {
                $uploadpostsize = ini_get('post_max_size');
            } else {
                $uploadpostsize = get_cfg_var('post_max_size');
            }
            ?>
            <span>
                上传最大文件：<?= $uploadsize ?>
                <?php
                if ($clientOptions["maxNumberOfFiles"]) {
                    // 如果有值
                    ?>
                    / 允许最多上传 <?= $clientOptions["maxNumberOfFiles"] ?> 个文件
                    <?php
                }
                ?>
            </span>
            <?php
        }
        ?>
        <div class="layui-upload-list">
            <table class="layui-table">
                <thead>
                <tr>
                    <th>文件名</th>
                    <th>大小</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody class="demoList"></tbody>
            </table>
        </div>
        <button type="button" class="layui-btn testListAction">开始上传</button>
    </div>


<?php
$js = "var " . $clientOptions["divId"] . "_options = " . json_encode($clientOptions) . ";\n";
$js .= "var accept = '" . ($clientOptions["acceptFileTypes"] ? $clientOptions["acceptFileTypes"] : 'file') . "'; \n";
$js .= <<<EOF

layui.use('upload', function(){

        var upload = layui.upload;

        //多文件列表示例
        var demoListView = $('#{$clientOptions["divId"]} .demoList')
            ,uploadListIns = upload.render({
            elem: '#{$clientOptions["divId"]} .testList'
            ,url: "{$clientOptions["url"]}"
            ,accept: 'file'
            ,multiple: true
            ,auto: false //自动上传,取消自动上传false
            ,number:"{$clientOptions["maxNumberOfFiles"]}"
            ,bindAction: '#{$clientOptions["divId"]} .testListAction'
            ,choose: function(obj){
                // 允许上传的张数
                let uploadNum  = this.number;
                
                if(uploadNum){
                    
                    var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
    
                    var n1 = demoListView.find("tr.list-item").length; // 已上传的文件长度
                    var n2 = Object.keys(files).length; // 已选择的文件数，未上传
                    
                    console.log("当前上传列表个数：" + (n1+n2));
                    if((n1+n2)>uploadNum){
                    
                        
                        
                        let n3 = uploadNum - n1;
                        
                        console.log("允许上传的个数：" + n3);
                        if(!demoListView.find("tr.list-no-item").length){
                            // 如果一个待上传列表都没有，清空全部的待上传列表，让用户重新选
                            $.each(files, function(i, elem) {
                                 delete files[i];
                            })
                            
                        }else{
                            var j = 0;
                            $.each(files, function(i, elem) {
                                if(j>=n3){
                                    delete files[i];
                                }
                                j++;
                            })
                        }
                        
                        layer.open({
                            title:'超出最大文件数',
                            content: '允许最多上传' + uploadNum + '个文件 , 已上传成功' + n1 + '个文件 ,仅允许选择' + n3 + '个文件</span>'
                        });
                        return false;
                    }
                }
                
                //读取本地文件
                obj.preview(function(index, file, result){
                    var tr = $(['<tr id="upload-'+ index +'" class="list-no-item">'
                        ,'<td>'+ file.name +'</td>'
                        ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
                        ,'<td>等待上传</td>'
                        ,'<td>'
                        ,'<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
                        ,'<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
                        ,'</td>'
                        ,'</tr>'].join(''));

                    //单个重传
                    tr.find('.demo-reload').on('click', function(){
                        obj.upload(index, file);
                    });

                    //删除
                    tr.find('.demo-delete').on('click', function(){
                        delete files[index]; //删除对应的文件
                        tr.remove();
                        uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
                    });

                    demoListView.append(tr);
                });
            }
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
            
                let n2 = Object.keys(this.files).length; //已选择的文件数，未上传
                if(n2){
                    <!--layer.msg('图片上传中...', {-->
                        <!--icon: 16,-->
                        <!--shade: 0.01,-->
                        <!--time: 0-->
                    <!--})-->
                }else{
                    layer.msg("请先选择图片");
                }
                
                
            }
            ,done: function(res, index, upload){
                //上传成功
                <!--layer.close(layer.msg());//关闭上传提示窗口-->
                
                var tr = demoListView.find('tr#upload-'+ index)
                        ,tds = tr.children();
                tr.remove();
                delete this.files[index]; //删除文件队列已经上传成功的文件
                
                var options = {$clientOptions["divId"]}_options;
                options.files = res.files;
                AttachmentUploadItems(options);
            }
            ,error: function(index, upload){
                layer.msg('上传错误！');
                var tr = demoListView.find('tr#upload-'+ index)
                    ,tds = tr.children();
                tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
                tds.eq(3).find('.demo-reload').removeClass('layui-hide'); //显示重传
            }
        });
});

EOF;
$this->registerJs($js, \yii\web\View::POS_END);
