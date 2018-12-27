<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;

?>
    <aside class="main-sidebar">

        <section class="sidebar">

            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= Yii::$app->user->identity->profile->user_pic ?>" class="img-circle" alt="User Image"
                         width="25" height="25"/>
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->profile->true_name ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                </div>
            </div>

            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="搜索..."/>
                    <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->

            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="header"><span><span>功能菜单</span></span></li>
            </ul>
            <?php
            $callback = function ($menu) {
                $arr = [
                    'label' => $menu['name'],
                    'url' => [$menu['route']],
                    'icon' => $menu['icon'],
                    'items' => $menu['children'],
                ];
                if ($menu['route']) {
                    // 如果有路由
                    $arr["options"] = [
                        "class" => "site-active menu-id-" . $menu['id'],
                        "data-type" => "tabAdd",
                        "data-id" => $menu['id'],
                        "data-url" => Url::to([$menu['route']]),
                        "data-title" => $menu['name'],
                    ];
                }
                return $arr;
            };

            $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
            dmstr\widgets\Menu::$iconClassPrefix = "mr5 ";
            echo dmstr\widgets\Menu::widget([
                'options' => [
                    'class' => 'sidebar-menu tree', 'data-widget' => 'tree',
                ],
                'items' => $items,
                'linkTemplate' => '<a href="javascript:void(0);">{icon} {label}</a>',
            ]);
            ?>

        </section>

    </aside>


<?php $this->beginBlock('js') ?>
    <script>
        layui.use('element', function () {
            var element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块

            var deleteIndex;//全局变量

            // 切换时获取当前节点的id
            element.on('tab(demo)', function (data) {
                deleteIndex = $(this).attr("lay-id");
            });

            //触发事件
            var active = {
                //在这里给active绑定几项事件，后面可通过active调用这些事件
                tabAdd: function (url, id, name) {
                    //新增一个Tab项 传入三个参数，分别对应其标题，tab页面的地址，还有一个规定的id，是标签中data-id的属性值
                    //关于tabAdd的方法所传入的参数可看layui的开发文档中基础方法部分
                    element.tabAdd('demo', {
                        title: name,
                        content: '<iframe data-frameid="' + id + '" scrolling="auto" frameborder="0" src="' + url + '" style="width:100%;height:99%;"></iframe>',
                        id: id //规定好的id
                    });
                    CustomRightClick(id); //给tab绑定右击事件
                    FrameWH();  //计算ifram层的大小
                    $('.rightmenu').hide(); //隐藏右键菜单
                },
                tabChange: function (id) {
                    //切换到指定Tab项
                    element.tabChange('demo', id); //根据传入的id传入到指定的tab项
                    $('.rightmenu').hide(); //隐藏右键菜单

                    // 对切换的菜单高亮显示
                    $(".site-active").removeClass("active");
                    $(".menu-id-" + id).addClass("active");

                },
                tabDelete: function (id) {
                    element.tabDelete("demo", id);//删除
                }
                , tabDeleteAll: function (ids) {//删除所有
                    $.each(ids, function (i, item) {
                        element.tabDelete("demo", item); //ids是一个数组，里面存放了多个id，调用tabDelete方法分别删除
                    })
                }
            };

            var closeAll = function () {
                // 关闭全部标签
                var tabtitle = $(".layui-tab-title li");
                var ids = new Array();
                $.each(tabtitle, function (i) {
                    ids[i] = $(this).attr("lay-id");
                });
                //如果关闭所有 ，即将所有的lay-id放进数组，执行tabDeleteAll
                active.tabDeleteAll(ids);
            };

            // 关闭其他标签
            var closeOther = function (id) {
                var tabtitle = $(".layui-tab-title li");
                var ids = new Array();
                $.each(tabtitle, function (i) {
                    var layId = $(this).attr("lay-id");
                    if (layId != id) {
                        ids[i] = $(this).attr("lay-id");
                    }
                });
                //如果关闭所有 ，即将所有的lay-id放进数组，执行tabDeleteAll
                active.tabDeleteAll(ids);
            };

            //当点击有site-active属性的标签时，即左侧菜单栏中内容 ，触发点击事件
            $('.site-active').on('click', function () {

                var dataid = $(this);

                //这时会判断右侧.layui-tab-title属性下的有lay-id属性的li的数目，即已经打开的tab项数目
                if ($(".layui-tab-title li[lay-id]").length <= 0) {
                    //如果比零小，则直接打开新的tab项
                    active.tabAdd(dataid.attr("data-url"), dataid.attr("data-id"), dataid.attr("data-title"));
                } else {
                    //否则判断该tab项是否以及存在

                    var isData = false; //初始化一个标志，为false说明未打开该tab项 为true则说明已有
                    $.each($(".layui-tab-title li[lay-id]"), function () {
                        //如果点击左侧菜单栏所传入的id 在右侧tab项中的lay-id属性可以找到，则说明该tab项已经打开
                        if ($(this).attr("lay-id") == dataid.attr("data-id")) {
                            isData = true;
                        }
                    });
                    if (isData == false) {
                        //标志为false 新增一个tab项
                        active.tabAdd(dataid.attr("data-url"), dataid.attr("data-id"), dataid.attr("data-title"));
                    }
                }
                //最后不管是否新增tab，最后都转到要打开的选项页面上
                active.tabChange(dataid.attr("data-id"));
            });

            // 自定义右键点击菜单事件
            function CustomRightClick(id) {
                //取消右键  rightmenu属性开始是隐藏的 ，当右击的时候显示，左击的时候隐藏
                $('.layui-tab-title li').on('contextmenu', function () {
                    return false;
                });
                $('.layui-tab-title,.layui-tab-title li').click(function () {
                    $('.rightmenu').hide();
                });

                //桌面点击右击
                $('.layui-tab-title li').on('contextmenu', function (e) {
                    var popupmenu = $(".rightmenu");
                    popupmenu.find("li").attr("data-id", id); //在右键菜单中的标签绑定id属性

                    //判断右侧菜单的位置
                    l = ($(document).width() - e.clientX) < popupmenu.width() ? (e.clientX - popupmenu.width()) : e.clientX;
                    // t = ($(document).height() - e.clientY) < popupmenu.height() ? (e.clientY - popupmenu.height()) : e.clientY;
                    t = 'auto';
                    popupmenu.css({left: l, top: t}).show(); //进行绝对定位
                    //alert("右键菜单")
                    return false;
                });
            }

            $(".rightmenu li").click(function () {

                //右键菜单中的选项被点击之后，判断type的类型，决定关闭所有还是关闭当前。
                if ($(this).attr("data-type") == "closethis") {
                    //如果关闭当前，即根据显示右键菜单时所绑定的id，执行tabDelete
                    active.tabDelete($(this).attr("data-id"))
                } else if ($(this).attr("data-type") == "closeother") {

                    closeOther(deleteIndex);
                    // $.each($(".layui-tab-title li[lay-id]"), function () {
                    //     //如果点击左侧菜单栏所传入的id 在右侧tab项中的lay-id属性可以找到，则说明该tab项已经打开
                    //     if ($(this).attr("lay-id") != deleteIndex) {
                    //         console.log("即将删除lay-id" + $(this).attr("lay-id"));
                    //         // active.tabDelete($(this).attr("lay-id"));
                    //     }
                    // });

                } else if ($(this).attr("data-type") == "closeall") {
                    closeAll();
                }

                $('.rightmenu').hide(); //最后再隐藏右键菜单
            });

            function FrameWH() {
                var h = $(window).height() - 41 - 10 - 60;
                $("iframe").css("height", h + "px");
            }

            $(window).resize(function () {
                FrameWH();
            });

            $(function () {
                // 初始进入指定路由
                var defaultId = 8;
                active.tabAdd("<?=Url::to(['/site/dashboard'])?>", defaultId, "控制面板");
                active.tabChange(defaultId);
            })
        });

        $(document).on('click', '.layui-tab-title li', function () {
            // 点击选项卡
            var id = $(this).attr("lay-id");
            // 对切换的菜单高亮显示
            $(".site-active").removeClass("active");
            $(".menu-id-" + id).addClass("active");
            $(".menu-id-" + id).parents(".treeview").addClass("menu-open");
            $(".menu-id-" + id).parent().show();
        });

    </script>
<?php $this->endBlock() ?>