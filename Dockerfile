FROM ccr.ccs.tencentyun.com/jormin/php-swoole:0.0.1

# 拷贝代码
COPY src /var/www/html/

# 安装composer扩展包并启动nginx
RUN cd /var/www/html && \
composer install --no-dev -vvv && \
chmod -R 777 storage