# Quark CMS

鉴于市面上CMS都已陈旧的情况，作者用更先进的laravel和ant-design重新设计、架构新时代的CMS。开源不易，请尊重版权！ 

## 安装说明

首先需要将web环境的默认目录指向public目录

命令行安装系统

重命名.env.example 改为 .env 

编辑.env文件，配置数据库信息

运行 composer install 安装依赖库

命令行下安装

第一步：php artisan quark:install
注意: 您需要将php加入到环境变量，如果在执行迁移时发生「class not found」错误，试着先执行 composer dump-autoload 命令后再进行一次。

第二步：php -S 127.0.0.1:8080 -t ./public

第三步：http://127.0.0.1:8080/admin/index

默认用户名：administrator 密码：123456

## 官方支持

github地址:https://github.com/quarkcms/quark-cms
