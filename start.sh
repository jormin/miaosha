#!/bin/bash

# 启动 php-fpm
service php-fpm start

# 启动 web
service nginx start

# 启动supervisor
supervisord -c /etc/supervisord.conf
supervisorctl start generate-order

# 休眠三秒，等所有服务都正常运行
sleep 15

# 模拟数据
cd /data/wwwroot/
php artisan mock

tail -f /dev/null