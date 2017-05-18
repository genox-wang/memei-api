# MeMei API 开发实践

## API实现

### 插件选择

1. 解决跨域：[laravel-cors](https://github.com/barryvdh/laravel-cors)
2. IDE帮助：[laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
3. API插件：[dingo](https://github.com/dingo/api)


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
- Nginx 1.13.0
- PHP 7.0.19
- Mysql 5.7.18

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

### 安装Nginx

#### 首先添加nginx_signing.key

```bash

wget http://nginx.org/keys/nginx_signing.key

sudo apt-key add nginx_signing.key

```

#### 添加Nginx官方提供的源

```bash
echo "deb http://nginx.org/packages/mainline/ubuntu/ trusty nginx">> /etc/apt/sources.list

echo "deb-src http://nginx.org/packages/mainline/ubuntu/ trusty nginx">> /etc/apt/sources.list
```

#### 更新源并安装Nginx

```bash
sudo apt update

sudo apt install nginx
```

#### Nginx配置

```bash

vim /etc/nginx/nginx.conf

//修改user
user www-data;


vim /etc/nginx/conf.d/default.conf

server {

    listen 80 default_server;

    listen [::]:80 default_server ipv6only=on;

    root /var/www/laravel/public;

    index index.php index.html index.htm;

    server_name server_domain_or_IP;

    location / {

        try_files $uri $uri/ /index.php?$query_string;

    }

    location ~ \.php$ {

        try_files $uri /index.php =404;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;

        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;

        fastcgi_index index.php;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

        include fastcgi_params;

    }

}

```

#### 重启Nginx

```bash
sudo service nginx restart
```

### 安装PHP7
#### 添加 PPA

```bash
sudo apt install python-software-properties software-properties-common

sudo add-apt-repository ppa:ondrej/php

sudo apt update
```

#### 安装PHP7以及所需的一些扩展

```bash
sudo apt install php7.0-fpm php7.0-mysql php7.0-common php7.0-curl php7.0-cli php7.0-mcrypt php7.0-mbstring php7.0-dom php7.0-gd
```

#### 配置PHP

```bash
sudo vim /etc/php/7.0/fpm/php.ini
```

找到cgi.fix_pathinfo选项，去掉注释;，然后将值设置为0 **（这个操作是为了避免PHP7的一个漏洞，PS：vim使用“/”进入查找模式）**

```bash
cgi.fix_pathinfo=0
```

#### 启用php7.0-mcrypt

```bash
sudo phpenmod mcrypt
```

#### 重启php7.0-fpm

```bash
sudo service php7.0-fpm restart
```

### 安装MySql

```bash
sudo apt install mysql-server-5.7 mysql-client-5.7
```

#### MySql 远程访问

开启 公网3306端口
```bash
vim /etc/mysql/mysql.conf.d/mysqld.cnf

# 将bind-address = 127.0.0.1注销​

```

授权用户

```
mysql -u root -p

// 输入密码

// 授权外网王文密码和权限
mysql> grant all privileges on *.* to 'root'@'%' identified by '密码';
mysql> flush privileges;
```


### Laravel相关

#### 安装Composer

```bash
sudo apt-get install curl

cd ~

wget -c https://getcomposer.org/composer.phar

chmod u+x composer.phar

sudo mv composer.phar /usr/local/bin/composer
```

#### 安装压缩，解压工具

```bash
sudo apt install zip unzip
```

#### 安装git

```bash
sudo apt install git
```

#### 使用git将代码clone到服务器上

```bash
cd /var

mkdir www

cd www

git clone your-project-git-link
```

#### 修改目录权限

```bash

sudo chown -R :www-data /var/www/laravel

sudo chmod -R 775 /var/www/laravel/storage

sudo chmod -R 775 /var/www/memei-api/bootstrap/cache

```

#### 安装依赖，拷贝修改配置

```
cd /var/www/laravel

composer install

cp .env.example .env
// 修改.env里的数据库相关配置

// 生成签名
php artisan key:generate

```

### 遇到的坑

#### 1. 80端口 3306端口外网无法访问

解决办法： 找到安全组 入方向允许  80 3306 TCP连接




Dingo version 路由
https://laravel-china.org/topics/1463/lumen-version-of-the-problem-using-dingo-api
