<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/21
 * Time: 10:34 AM
 */

use yii\widgets\ActiveForm;

?>
    <style>
        .has-error .layui-form-mid.layui-word-aux {
            color: #a94442 !important;
        }

        .layui-form-label {
            width: 150px;
        }

        .layui-input-block {
            margin-left: 150px;
        }

    </style>
    <div class="yoyo-box">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>连接websocket服务器数据</legend>
        </fieldset>

        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'layui-form',
            ],
        ]); ?>
        <div class="layui-form-item">
            <label class="layui-form-label">IP地址</label>
            <div class="layui-input-block">
                <input type="text" name="IP" lay-verify="IP" lay-verify="required" autocomplete="off" value="0.0.0.0"
                       class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">端口号</label>
            <div class="layui-input-inline">
                <input type="text" name="port" autocomplete="off" value="9505" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">服务器指定的端口号</div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">发送内容<br>(字符串)</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

        <blockquote class="layui-elem-quote layui-text">

        </blockquote>
    </div>
<?php $this->beginBlock('js') ?>
    <script>
        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                + " " + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
            return currentdate;
        }

        layui.use(['form'], function () {
            var form = layui.form;
            var $tipsContainer = $("blockquote.layui-elem-quote");

            //监听提交
            form.on('submit(demo1)', function (data) {

                var field = data.field;
                var ws = new WebSocket('ws://' + field.IP + ':' + field.port);
                ws.onopen = function () {
                    $tipsContainer.prepend('<p class="text-success">' + getNowFormatDate() + ' - Connected to WebSocket server: ' + field.IP + ':' + field.port + '</p>');
                };

                ws.onclose = function (event) {
                    var code = event.code;
                    var reason = event.reason;
                    var wasClean = event.wasClean;
                    // handle close event
                    $tipsContainer.prepend('<p class="text-danger">' + getNowFormatDate() + ' - Disconnected: ' + field.IP + ':' + field.port + '</p>');
                };

                ws.onmessage = function (event) {
                    var data = event.data;
                    // 转为json对象：JSON.parse(data)
                    // 处理数据
                    $tipsContainer.prepend('<p class="text-success">' + getNowFormatDate() + ' - Retrieved data from server: ' + data + '</p>');
                };

                ws.onerror = function (evt, e) {
                    $tipsContainer.prepend('<p class="text-danger">' + getNowFormatDate() + ' - Error occured: ' + evt.data + '</p>');
                };

                if (field.content) {
                    $tipsContainer.prepend('<p>' + getNowFormatDate() + ' - Send Data To' + field.IP + ':' + field.port + ' => ' + field.content + '</p>');
                    ws.send(field.content);
                }
                console.log(JSON.stringify(data.field));
                return false;
            });

        });
    </script>
<?php $this->endBlock() ?>