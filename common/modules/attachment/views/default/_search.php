<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model common\modules\attachment\models\searchs\AttachmentSearch */
/* @var $form yii\widgets\ActiveForm */
$inputId = "test-upload";
?>

<div class="yoyo-box attachment-search clearfix">

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?php Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
            ]); ?>

            <?php // echo $form->field($model, 'user_id') ?>
            <?= $form->field($model, 'oname') ?>
            <?= $form->field($model, 'title') ?>
            <?php // echo $form->field($model, 'description') ?>

            <?php // echo $form->field($model, 'path') ?>

            <?php // echo $form->field($model, 'hash') ?>

            <?php // echo $form->field($model, 'size') ?>

            <?php // echo $form->field($model, 'type') ?>

            <?php // echo $form->field($model, 'extension') ?>

            <?php // echo $form->field($model, 'created_at') ?>

            <?php // echo $form->field($model, 'updated_at') ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', Url::to([Yii::$app->controller->action->id]), ['class' => 'btn btn-default'])
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?= Html::button('+ 上传附件', ['class' => 'btn btn-success','id'=>'test1']) ?>
        </div>

    </div>
</div>

<?php $this->beginBlock('js') ?>
    <script>

        layui.use(['upload','layer'], function(){
            var $ = layui.jquery
                ,upload = layui.upload
                ,layer = layui.layer;

            //调用图片集
            layer.photos({
                photos: '#layer-photos-demo'
                ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
            });

            var uploadUrl= '<?=\yii\helpers\Url::to(["/upload/file-upload"])?>';
            var previewId = '<?=$inputId?>_img';

            //普通图片上传
            var uploadInst = upload.render({
                elem: '#test1'
                ,url: uploadUrl
                ,accept: 'file' //普通文件
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    // obj.preview(function(index, file, result){
                    //     $('#demo1').attr('src', result); //图片链接（base64）
                    // });
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
                    $.pjax.reload({container:"#attachment-list"});
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

        });
    </script>
<?php $this->endBlock() ?>