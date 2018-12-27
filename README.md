<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">yoyocmf</h1>
    <br>
</p>


1、根目录解析到web目录.

2、composer install安装
   也可以从云盘[下载vendor.vip](https://pan.baidu.com/s/18T8Y5auduqSyjm1-suRn9A) 密码：rq6l

3、修改根目录的.env mysql连接信息

4、根目录的yoyocmf.sql导入到mysql


前台：
http://localhost/

后台：
http://localhost/admin

默认用户名：
admin / admin123

开发过程中 [点击查看使用手册](http://www.yoyo88.cn/note/yoyocmf/) 相关组件有具体说明




DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
web
    admin/               后台入口
    assets/
    storage/
environments/            contains environment-based overrides
```
