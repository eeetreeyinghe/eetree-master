<<<<<<< HEAD
# eetree-master
=======
#### 部署
* composer install --optimize-autoloader --no-dev
* php artisan key:generate
* php artisan jwt:secret
* php artisan config:cache
* php artisan route:cache
* php artisan horizon:install (supervisor)
* 自定义分页模板
  * php artisan vendor:publish --tag=laravel-pagination
```
[program:horizon]
process_name=%(program_name)s
command=php /home/forge/app.com/artisan horizon
autostart=true
autorestart=true
user=forge
redirect_stderr=true
stdout_logfile=/home/forge/app.com/horizon.log
```
* ~~php artisan vendor:publish~~

#### api文档
* php artisan apidoc:generate
* 访问url: 域名/docs

#### 构建
* 前端构建
    * npm run production
* 脑图编辑器构建
    * cd resources/vendor/kityminder-editor，运行 grunt build，完成后 dist 目录里就是可用运行的 kityminder-editor, 双击 index.html 即可打开运行示例

#### 自动识别词条部署
* 定时任务 wikikeys.sh
* 定时任务 schedule

#### 编辑器开发
* cd resources/vendor/kityminder-editor
* npm run init

#### TODO
* app/Http/Kernel.php VerifyCsrfToken


>>>>>>> c029e25 (first commit)
