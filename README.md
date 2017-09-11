# 1 v1版本

## 1.1 介绍

## 1.2 安装

```php composer require brooksyang/entrance:"^v1.0" ```

## 1.3 使用

## 1.3.1 注册provider
 
在config/app.php中的providers数组中添加以下内容
```php
BrooksYang\Entrance\EntranceServiceProvider::class,
```

### 1.3.2 在User model中use EntranceUserTrait
```php
<?php
 
namespace App;
 
use BrooksYang\Entrance\Traits\EntranceUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class User extends Authenticatable
{
    // use EntranceUserTrait 即可
    use Notifiable, EntranceUserTrait;
}

```
###1.3.3 重写配置文件
该命令将生成config/entrance.php配置文件

```php
php artisan vendor:publish --tag=entrance

```
###1.3.4 开始使用

config/entrance.php中默认定义了一些配置项，如：无权限页面的跳转路径，model等，若想自定义model，修改配置文件之后，需要继承原model，如自定义Role.php文件，需要以下步骤：

```php
php artisan make:model Role
```
 
修改config/entrance.php配置文件
```php
'role' => 'BrooksYang\Entrance\Models\Role',
```

修改Role model
```php
<?php
 
namespace App;
 
class Role extends \BrooksYang\Entrance\Models\Role
{
    //
}
```

其它model的自定义同上

# v2版本

## 2.1 介绍

## 2.2 安装
```php
composer require brooksyang/entrance
```
## 2.3 使用

### 2.3.1 注册provider
在config/app.php中的providers数组中添加以下内容
```php
BrooksYang\Entrance\EntranceServiceProvider::class, // 权限相关内容
BrooksYang\Entrance\EntranceAdminServiceProvider::class, // 实现基本业务逻辑，并集成cannavaro后台基础框架
```

### 2.3.2 在User model中use EntranceUserTrait
```php
<?php
 
namespace App;
 
use BrooksYang\Entrance\Traits\EntranceUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class User extends Authenticatable
{
    // use EntranceUserTrait 即可
    use Notifiable, EntranceUserTrait;
}
```

### 2.3.3 重写配置文件和资源文件
该命令将生成config/entrance.php配置文件，和public/assets基础资源文件

```php
php artisan vendor:publish --tag=entrance
```
###### 注意：v2.0.0版本仅支持自定义数据表等配置，暂不支持自定义model等配置项，后续优化版本中会完善自定义功能


### 2.3.4 重写视图文件（可选，不执行该条命令，则使用默认视图）
```php
php artisan vendor:publish --tag=entrance.views
```
### 2.3.5 生成数据
```php
php artisan entrance:install
```
### 2.3.6 登录

配置好项目地址之后，访问demo即可，如：http://localhost/demo
```php
// 超管
用户名：admin@admin.com
密码：123123

 
// test 账号
用户名：test@test.com
密码：123123
```
