# MeMei API 开发实践


## 阿里云

参考 https://www.mtyun.com/library/19/how-to-install-lnmp-on-centos6/

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
