/**
 * 将值传入options，渲染图片列表
 * @param options
 * @constructor
 */
function AttachmentUploadItems(options) {
    var options = $.extend({
        'divId': "",
        'id': "",            // input Id
        'url': "",           // 上传路径
        'sortable': false,
        'onlyImage': true,    // 只允许上传图片
        'onlyUrl': false,
        "multiple": false,
        "maxNumberOfFiles": 0,
        "maxFileSize": null, // 5 MB
        "acceptFileTypes": null,
        "files": [],
    }, options);

    var $container = $("#" + options.divId);
    var $input = $("#" + options.id);
    var $files = options.files;
    var $name = options.name;

    if (options.multiple == true) {
        // 如果是多选

        if (options.onlyImage) {
            // 多选情况下，只允许上传图片

            // console.log($files);
            $.each($files, function (i, elem) {

                var li = $(['<div id="upload-' + elem.id + '" class="col-md-3 col-xs-4 mb10 list-item">'
                    , "<div class='img-wrapper img-thumbnail'>"
                    , "<img src='" + elem.url + "' class='img-responsive center-block'>"
                    , "<p class='title'>" + elem.oname + "</p>"
                    , "<span class='glyphicon glyphicon-trash removeItem' aria-hidden='true'></span>"
                    , "<input name = '" + $name + "[" + elem.id + "][path]' value='" + elem.path + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][id]' value='" + elem.id + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][name]' value='" + elem.name + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][name]' value='" + elem.oname + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][hash]' value='" + elem.hash + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][type]' value='" + elem.type + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][size]' value='" + elem.size + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][extension]' value='" + elem.extension + "' type='hidden'>"
                    , "</div>"
                    , '</div>'].join(''));

                //删除
                li.find('.removeItem').on('click', function () {
                    li.remove();
                });
                $container.find(".layui-upload-list").append(li);
            });

        } else {

            // 多选情况下，不限文件
            $.each($files, function (i, elem) {

                var tr = $(['<tr id="upload-' + elem.id + '" class="list-item">'
                    , '<td><a href="' + elem.url + '" target="_blank">' + elem.oname + '</a>'
                    , "<input name = '" + $name + "[" + elem.id + "][path]' value='" + elem.path + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][id]' value='" + elem.id + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][name]' value='" + elem.name + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][name]' value='" + elem.oname + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][hash]' value='" + elem.hash + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][type]' value='" + elem.type + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][size]' value='" + elem.size + "' type='hidden'>"
                    , "<input name = '" + $name + "[" + elem.id + "][extension]' value='" + elem.extension + "' type='hidden'>"
                    , '</td>'
                    , '<td>' + (elem.size / 1014).toFixed(1) + 'kb</td>'
                    , '<td class="text-success">上传成功</td>'
                    , '<td>'
                    , '<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
                    , '<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
                    , '</td>'
                    , '</tr>'].join(''));

                //删除
                tr.find('.demo-delete').on('click', function () {
                    tr.remove();
                });
                $container.find(".demoList").append(tr);
            });

        }


    } else {
        // 如果是单选
        let file = $files[0];
        if (!file) {
            return false;
        }

        if (options.onlyUrl) {
            // 如果只要url
            // console.log(options.id);
            $("#" + options.id).val(file.url);
            var html = "<img src='" + file.url + "'>";//图片链接
            // console.log(onlyUrl);
            html += "<span class='glyphicon glyphicon-trash' aria-hidden='true' onclick='removeItemByOnlyUrl($(this))'></span>";
            $container.find(".upload-kit-item ul").append("<li>" + html + "</li>");

        } else {

            $container.find(".upload-kit-item ul").append("<li>" +
                "<img src='" + file.url + "'>" +
                "<span class='glyphicon glyphicon-trash' aria-hidden='true' onclick='removeItem($(this))'></span>" +
                "<input name = '" + $name + "[path]' value='" + file.path + "' type='hidden'>" +
                "<input name = '" + $name + "[id]' value='" + file.id + "' type='hidden'>" +
                "<input name = '" + $name + "[name]' value='" + file.name + "' type='hidden'>" +
                "<input name = '" + $name + "[oname]' value='" + file.oname + "' type='hidden'>" +
                "<input name = '" + $name + "[hash]' value='" + file.hash + "' type='hidden'>" +
                "<input name = '" + $name + "[type]' value='" + file.type + "' type='hidden'>" +
                "<input name = '" + $name + "[size]' value='" + file.size + "' type='hidden'>" +
                "<input name = '" + $name + "[extension]' value='" + file.extension + "' type='hidden'>" +
                "</li>");
        }
    }

}

function moreFilesInit(files) {
    //读取本地文件
    obj.preview(function (index, file, result) {
        var tr = $(['<tr id="upload-' + index + '">'
            , '<td>' + file.name + '</td>'
            , '<td>' + (file.size / 1014).toFixed(1) + 'kb</td>'
            , '<td>等待上传</td>'
            , '<td>'
            , '<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
            , '<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
            , '</td>'
            , '</tr>'].join(''));

        //单个重传
        tr.find('.demo-reload').on('click', function () {
            obj.upload(index, file);
        });

        //删除
        tr.find('.demo-delete').on('click', function () {
            delete files[index]; //删除对应的文件
            tr.remove();
            uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
        });

        demoListView.append(tr);

    });
}




//
// (function ($) {
//     jQuery.fn.attachmentUpload = function (options) {
//         var options = $.extend({
//             'divId': "",
//             'id': "",            // input Id
//             'url': "",           // 上传路径
//             'sortable': false,
//             'onlyUrl': false,
//             "multiple": false,
//             "maxNumberOfFiles": 0,
//             "maxFileSize": null, // 5 MB
//             "acceptFileTypes": null,
//             "files": [],
//             "imgWidth":"",
//             "imgHight":"",
//         }, options);
//
//         // console.log(options);
//         var $container = this;
//         var $input = $("#" + options.id);
//         // var $container = $input.parent('div');
//         var $files = options.files;
//
//
//         var methods = {
//             init: function () {
//                 // 初始化
//                 console.log($files);
//
//
//
//
//                 // if (options.sortable == true) {
//                 //     $files.sortable({
//                 //         placeholder: "upload-kit-item sortable-placeholder",
//                 //         tolerance: "pointer",
//                 //         forcePlaceholderSize: true,
//                 //         update: function () {
//                 //             methods.updateOrder()
//                 //         }
//                 //     })
//                 // }
//
//                 // $input.wrapAll($('<div class="upload-kit-input"></div>'))
//                 //     .after($('<span class="glyphicon glyphicon-plus-sign add"></span>'))
//                 //     .after($('<span class="glyphicon glyphicon-circle-arrow-down drag"></span>'))
//                 //     .after($('<span/>', {
//                 //         "data-toggle": "popover",
//                 //         "class": "glyphicon glyphicon-exclamation-sign error-popover"
//                 //     }))
//                 //     .after(
//                 //         '<div class="progress">' +
//                 //         '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>' +
//                 //         '</div>'
//                 //     );
//                 // $files.on('click', '.upload-kit-item .remove', methods.removeItem);
//                 // methods.checkInputVisibility();
//                 // methods.fileuploadInit();
//                 // methods.dragInit();
//
//             },
//             removeItem: function (e) { //删除图片项目
//                 var $this = $(this);
//                 var url = $this.data('url');
//                 // if (url) {
//                 //     $.ajax({
//                 //         url: url,
//                 //         type: 'DELETE'
//                 //     })
//                 // }
//                 // $this.parents('.upload-kit-item').remove();
//                 // methods.checkInputVisibility();
//             },
//             createItem: function (file) { //新建图片项目
//                 var name = options.name;
//                 var index = methods.getNumberOfFiles();
//                 if (options.multiple) {
//                     name += '[' + index + ']';
//                 }
//                 var item;
//                 if (options.onlyUrl) {
//                     item = $('<li>', {"class": "upload-kit-item done"})
//                         .append($('<input/>', {"name": name, "value": file.url, "type": "hidden"}))
//                         .append($('<span/>', {"class": "fa fa-trash remove", "data-url": file.deleteUrl}));
//                 } else {
//                     item = $('<li>', {"class": "upload-kit-item done"})
//                         .append($('<input/>', {"name": name + '[path]', "value": file.path, "type": "hidden"}))
//                         .append($('<input/>', {"name": name + '[id]', "value": file.id, "type": "hidden"}))
//                         .append($('<input/>', {"name": name + '[name]', "value": file.name, "type": "hidden"}))
//                         .append($('<input/>', {"name": name + '[hash]', "value": file.hash, "type": "hidden"}))
//                         .append($('<input/>', {"name": name + '[type]', "value": file.type, "type": "hidden"}))
//                         .append($('<input/>', {"name": name + '[size]', "value": file.size, "type": "hidden"}))
//                         .append($('<input/>', {
//                             "name": name + '[extension]',
//                             "value": file.extension,
//                             "type": "hidden"
//                         }))
//                         .append($('<input/>', {
//                             "name": name + '[order]',
//                             "data-role": "order",
//                             "value": file.order,
//                             "type": "hidden"
//                         }))
//                         .append($('<span/>', {"class": "fa fa-trash remove", "data-url": file.deleteUrl}));
//                 }
//                 if (!file.type || file.type.search(/image\/.*/g) !== -1) {
//                     item.removeClass('not-image').addClass('image');
//                     item.prepend($('<img/>', {src: file.url, width: 150, height: 150}));
//                     item.find('span.type').text('');
//                 } else {
//                     console.log(file);
//                     // item.removeClass('image').addClass('not-image');
//                     item.removeClass('image').addClass('not-image file-' + file.extension);
//                     item.css('backgroundImage', '');
//                     item.append($('<span/>', {"class": "name"}).text(file.filename));
//                 }
//                 return item;
//             },
//             checkInputVisibility: function () {
//                 var inputContainer = $container.find('.upload-kit-input');
//                 if (options.maxNumberOfFiles && (methods.getNumberOfFiles() >= options.maxNumberOfFiles)) {
//                     inputContainer.hide();
//                 } else {
//                     inputContainer.show();
//                 }
//             },
//             getNumberOfFiles: function () {
//                 return $container.find('.files .upload-kit-item').length;
//             },
//             updateOrder: function () {
//                 $files.find('.upload-kit-item').each(function (index, item) {
//                     $(item).find('input[data-role=order]').val(index);
//                 })
//             }
//         };
//
//         methods.init.apply(this);
//         return this;
//     };
//
// })(jQuery);

function createItem(inputId, inputName, files, onlyUrl) {

    // console.log(files);
    $('.' + inputId + '-upload-kit-item ul').html(""); // 清空上传信息

    if (onlyUrl) {

        // 如果只要url
        var file = files[0];
        var inputHtml = "<input type='hidden' name='" + inputName + "' id='" + inputId + "' value='" + file.url + "'>";
        var html = "<img src='" + file.url + "'>";//图片链接
        // console.log(onlyUrl);
        html += "<span class='glyphicon glyphicon-trash' aria-hidden='true' onclick='removeItemByOnlyUrl($(this))'></span>";

        $('.' + inputId + '-upload-kit-item')
            .append(inputHtml);
        $('.' + inputId + '-upload-kit-item ul')
            .append("<li>" + html + "</li>");

    } else {

        var name = inputName;
        $.each(files, function (i, elem) {
            $('.' + inputId + '-upload-kit-item ul').append("<li>" +
                "<img src='" + elem.url + "'>" +
                "<span class='glyphicon glyphicon-trash' aria-hidden='true' onclick='removeItem($(this))'></span>" +
                "<input name = '" + name + "[" + i + "][path]' value='" + elem.path + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][id]' value='" + elem.id + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][name]' value='" + elem.name + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][hash]' value='" + elem.hash + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][type]' value='" + elem.type + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][size]' value='" + elem.size + "' type='hidden'>" +
                "<input name = '" + name + "[" + i + "][extension]' value='" + elem.extension + "' type='hidden'>" +
                "</li>");
        });
    }
}


/**
 * 删除当前item
 * @param obj
 */
function removeItem(obj) {
    obj.parent().remove();
}

function removeItemByOnlyUrl(obj) {
    obj.parents(".upload-kit-item").siblings("input").val("");
    this.removeItem(obj);
}