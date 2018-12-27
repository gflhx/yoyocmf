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
            ,before: function(obj){
                layer.load(1);
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭加载层
            
                //如果上传失败
                if(res.errcode != 0){
                    return layer.msg('上传失败');
                }
                //上传成功
                layer.msg('上传成功');
                var files = [res.data];
                var options = {$clientOptions["divId"]}_options;
                options.files = files;
                
                console.log(options);
                $("#{$clientOptions["divId"]} .upload-kit-item ul").html("");
                AttachmentUploadItems(options);
            }
            ,error: function(){
                layer.closeAll('loading'); //关闭loading
            
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    {$clientOptions["divId"]}_uploadInst.upload();
                });
            }
        });

        
        
        <!--//多图片上传-->
        <!--upload.render({-->
            <!--elem: '#test2'-->
            <!--,url: '/upload/'-->
            <!--,multiple: true-->
            <!--,before: function(obj){-->
                <!--//预读本地文件示例，不支持ie8-->
                <!--obj.preview(function(index, file, result){-->
                    <!--$('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')-->
                <!--});-->
            <!--}-->
            <!--,done: function(res){-->
                <!--//上传完毕-->
            <!--}-->
        <!--});-->


    });

           
EOF;
$this->registerJs($js, \yii\web\View::POS_END);