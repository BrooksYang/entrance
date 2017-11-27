# v2 Demo
[点击访问demo](http://entrance.brooksyang.cn/)
```php
// 超管
用户名：admin@admin.com
密码：123123

 
// test 账号
用户名：test@test.com
密码：123123
```

##### 注意:
该项目采用了缓存机制，请确保您的缓存驱动可用，推荐使用redis驱动
```php
composer require predis/predis
```

配置env缓存驱动
```php
CACHE_DRIVER=redis
```

# v2 版本（admin分支）

安装
```php
composer require brooksyang/entrance
```

在config/app.php中的providers数组中添加以下内容
```php
BrooksYang\Entrance\EntranceServiceProvider::class, // 权限相关内容
BrooksYang\Entrance\EntranceAdminServiceProvider::class, // 实现基本业务逻辑，并集成cannavaro后台基础框架
```

在User model中use EntranceUserTrait(v2.1版本已内置用户系统，可跳过该步骤)
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

重写配置文件和资源文件
```php
php artisan vendor:publish --tag=entrance
```

重写视图文件（可选，不执行该条命令，则使用默认视图）
```php
php artisan vendor:publish --tag=entrance.views
```

生成数据
```php
php artisan entrance:install
```

配置好项目地址之后，访问demo即可，如：http://localhost/demo

### TODO LIST

- [ ] 模块排序
- [ ] 模块图标
- [ ] 操作日志
- [ ] 数据库备份
- [ ] 多语言支持
- [ ] 异常邮件通知(参考laravel5.5异常界面)
- [ ] 默认头像选择
- [ ] 路由文件不在vendor中写死，采用类似Auth::routes()的方式写入本地路由文件，定制化程度更高
- [ ] docker化
