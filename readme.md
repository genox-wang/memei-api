# MeMei API 开发实践
use App\Http\Controllers\QiniuController;


## 七牛对接

参考：[七牛：php-sdk](https://developer.qiniu.com/kodo/sdk/1241/php#6)

```bash
$ composer require qiniu/php-sdk
```

```
// routes\api.php

Route::get('/qiniu', 'QiniuController@index');

```

```bash
php artisan make:controller QiuniuController
```

```php
// QiniuController

use Qiniu\Auth;

class QiniuController extends Controller
{
    public function index() {
      // 用于签名的公钥和私钥
      $accessKey = 'Access_Key';
      $secretKey = 'Secret_Key';
      // 初始化签权对象
      $auth = new Auth($accessKey, $secretKey);
      $bucket = 'Bucket_Name';
      // 生成上传Token
      $token = $auth->uploadToken($bucket);
      return $token;
    }
}
```

### 图片命名算法

参考http://www.cnblogs.com/tambor/archive/2013/04/21/3034017.html

## 阿里云服务器部署

参考：[阿里云 ECS 部署：nginx+MySQL+Laravel+PHP7+Redis+Node.js](https://segmentfault.com/a/1190000009082326)

### 配置目标环境

- Ubuntu 16.04.2 LTS

### 安装 on-my-zsh (可选)
为了终端操作更顺畅，首先选择安装配置on-my-zsh

```bash

$ sudo apt install zsh

$ chsh -s $(which zsh)

$ sh -c"$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"

```

添加extract(x解压一切)和z(z到任何去过的目录)插件

```bash
$ vim ~/.zshrc

//.zshrc

plugins=(git extract z) //添加插件
```

### 终端免密码ssh（可选）

iterm2终端本身就是一个完美的ssh工具，原来一直使用[SSH Shell](https://itunes.apple.com/us/app/ssh-shell/id981765152?mt=12)，因为它可以记录自己服务器足迹，免密码登陆。
但它快捷键我很不喜欢，主题也不可以定制！那iterm2可不可以免密码ssh呢，当然是可以的（设置完前还是需要输入自己密码的），只要下面几步就可以了，是不是很轻松：

```bash
$ ssh-keygen -t rsa //本地生成私钥  公钥

$ scp ~/.ssh/id_rsa.pub root@服务器IP:~/.ssh/  //本地公钥拷贝的服务器端

> cd .ssh
> cat id_rsa.pub >> authorized_keys //公钥添加到服务器认证密钥文件
```

$ sudo yum install nginx


// 开机启动nginx
chkconfig nginx on

service nginx start

vim /etc/nginx/conf.d/default.conf

server {
    listen 80;
    server_name  your-domain;
    root         /var/www/html;

    access_log /var/log/nginx/your-domain_access.log;
    error_log /var/log/nginx/your-domain_error.log;

    index  index.php index.html index.htm;

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  /var/www/html$fastcgi_script_name;
        include        fastcgi_params;
    }

    location / {
        autoindex on;
    }

    error_page 404 /404.html;
        location = /40x.html {
    }

    error_page 500 502 503 504 /50x.html;
        location = /50x.html {
    }
}

service nginx reload

```


https://segmentfault.com/a/1190000009082326

cp .env.example .env

sudo chmod -R 775 /var/www/memei-api/bootstrap/cache

php artisan key:generate


Laravel 5.4: Specified key was too long error

https://laravel-news.com/laravel-5-4-key-too-long-error


mysql 外网访问

http://www.jianshu.com/p/050d24b2def0

### 遇到的坑

#### 1. nginx 安装完内网可以访问，外网不行

解决办法： 找到安全组 入方向允许 80 端口的 TCP请求


composer require --dev barryvdh/laravel-ide-helper

public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
    // ...
}

php artisan ide-helper:generate


Avoiding CSRF middleware on API POST routes
api.php
url 前缀加api

CORS Headers with Filters


安装https://github.com/barryvdh/laravel-cors 插件

Laravel 跨域插件
https://laravel-china.org/topics/3188/vuejs-2-laravel-53-cors-cross-domain-resource-sharing-1

axios  
https://github.com/mzabriskie/axios



    $ scp ~/.ssh/id_rsa.pub root@106.14.148.86:~/.ssh/

    > cd .ssh
    > cat id_rsa.pub >> authorized_keys
