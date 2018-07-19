## 介绍
该项目基于laravel5，提供了一套基于角色的权限解决方案

## 项目依赖
|   依赖包    |    版本   |
|   :---     |  :----:  |
|    PHP     |  >=5.5.9 |
|   Laravel  |  >=5.3   |
|   predis   |  >=1.1   |

## 更新日志
```php
v1.1.0 内置管理员；模块之上添加板块的概念，方便模块分组
```

## 安装
```php
composer require brooksyang/entrance:"^v1.0"
```

## 配置:

重写配置文件，该命令将生成config/entrance.php配置文件
```php
php artisan vendor:publish --tag=entrance
```

修改 .env 文件，将缓存驱动设置为redis（推荐）
```php
CACHE_DRIVER=redis
```

生成相关表
```php
php artisan entrance:install
```
