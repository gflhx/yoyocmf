<?php
/**
 * 单图上传
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/16
 * Time: 2:15 PM
 */
//"建议" . ($clientOptions["imgWidth"] ? ' 宽度：' . $clientOptions["imgWidth"] . '；' : ''. $clientOptions["imgHight"] ? ' 高度：' . $clientOptions["imgHight"] : '';
?>
    <div class="layui-upload" id="<?= $clientOptions["divId"] ?>">
        <button type="button" class="layui-btn" id="test1">上传图片</button>

        <input type="checkbox" name="water" id="water" title="水印" lay-skin="primary" <?=$clientOptions["ifWater"]?"checked":""?>>

        <input type="hidden" name="<?=$clientOptions["name"]?>" id="<?=$clientOptions["id"]?>">
        <!--预览-->
        <p id="demoText"></p>
        <!--存储上传信息-->
        <div class="upload-kit-item clearfix">
            <ul></ul>
        </div>
    </div>
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
    <div class="layui-elem-quote">
        <p>上传最大<?=$clientOptions["onlyImage"]?"图片":"文件"?>：<?= $uploadsize ?></p>
    </div>
    <?php
}
?>

<?php
$js = "var ".$clientOptions["divId"]."_options = " . json_encode($clientOptions).";\n";
$js .= "var accept = '".($clientOptions["onlyImage"]?'images':'file')."'; \n";
$js .= <<<EOF
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;

        //普通图片上传
        var {$clientOptions["divId"]}_uploadInst = upload.render({
            elem: '#{$clientOptions["divId"]} #test1'
            ,url: "{$clientOptions["url"]}"
            ,accept:accept
            ,data: {
              water: function(){
                return $("#{$clientOptions["divId"]} #water").is(':checked');
              }
            }
            ,before: function(obj){
                layer.msg('图片上传中...', {
                        icon: 16,
                        shade: 0.01,
                        time: 0
                    })
            }
            ,done: function(res){
                layer.close(layer.msg());//关闭上传提示窗口
            
                //如果上传失败
                if(res.errcode != 0){
                    return layer.msg(res.errmsg);
                }
                //上传成功
                layer.msg('上传成功');
                var files = [res.data];
                var options = {$clientOptions["divId"]}_options;
                options.files = files;
                
                $("#{$clientOptions["divId"]} .upload-kit-item ul").html("");
                AttachmentUploadItems(options);
            }
            ,error: function(){
                layer.close(layer.msg());//关闭上传提示窗口
            
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    {$clientOptions["divId"]}_uploadInst.upload();
                });
            }
        });

    });

           
EOF;
$this->registerJs($js, \yii\web\View::POS_END);