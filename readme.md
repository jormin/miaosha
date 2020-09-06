## 概览

本项目是基于 lumen5.6 + swoole(4.5.3) + redis + mysql(5.7.13) 开发的秒杀系统，仅包含秒杀抢购接口和生成订单数据部分

- 架构图

    ![](https://blog.cdn.lerzen.com/AxfzAabR3Afa4w24s6dXjEKTxYO+NNziMSfwqDoUPFE=.jpg)

## 使用

1. 启动服务

    为了配合压测，配置中限定了 web 服务使用 4个物理核心 + 8G内存，所以启动的时候需要增加 **--compatibility** 选项

   ```
   Building web
   Step 1/3 : FROM ccr.ccs.tencentyun.com/jormin/php-swoole:0.0.1
    ---> 6c409524d0f8
   Step 2/3 : COPY src /var/www/html/
    ---> 707e77f3757a
   Step 3/3 : RUN cd /var/www/html && composer install && chmod -R 777 storage
    ---> Running in 24a7ffa9911b
   Loading composer repositories with package information
   Installing dependencies (including require-dev) from lock file
   Package operations: 104 installs, 0 updates, 0 removals
     - Installing kylekatarnls/update-helper (1.2.1): Downloading (100%)
     - Installing phpdocumentor/reflection-common (2.2.0): Downloading (100%)
     - Installing phpdocumentor/type-resolver (1.3.0): Downloading (100%)
     - Installing symfony/translation-contracts (v2.1.3): Downloading (100%)
     - Installing symfony/polyfill-mbstring (v1.18.1): Downloading (100%)
     - Installing symfony/translation (v4.4.12): Downloading (100%)
     - Installing nesbot/carbon (1.25.3): Downloading (100%)
     - Installing psr/simple-cache (1.0.1): Downloading (100%)
     - Installing psr/container (1.0.0): Downloading (100%)
     - Installing illuminate/contracts (v5.6.39): Downloading (100%)
     - Installing doctrine/inflector (1.4.3): Downloading (100%)
     - Installing illuminate/support (v5.6.39): Downloading (100%)
     - Installing symfony/finder (v4.4.12): Downloading (100%)
     - Installing illuminate/filesystem (v5.6.39): Downloading (100%)
     - Installing symfony/service-contracts (v2.1.3): Downloading (100%)
     - Installing symfony/polyfill-php80 (v1.18.1): Downloading (100%)
     - Installing symfony/polyfill-php73 (v1.18.1): Downloading (100%)
     - Installing symfony/console (v4.4.12): Downloading (100%)
     - Installing illuminate/console (v5.6.39): Downloading (100%)
     - Installing doctrine/event-manager (1.1.1): Downloading (100%)
     - Installing doctrine/cache (1.10.2): Downloading (100%)
     - Installing doctrine/dbal (2.10.2): Downloading (100%)
     - Installing symfony/process (v4.4.12): Downloading (100%)
     - Installing symfony/polyfill-ctype (v1.18.1): Downloading (100%)
     - Installing symfony/filesystem (v5.1.4): Downloading (100%)
     - Installing seld/phar-utils (1.1.1): Downloading (100%)
     - Installing seld/jsonlint (1.8.2): Downloading (100%)
     - Installing psr/log (1.1.3): Downloading (100%)
     - Installing justinrainbow/json-schema (5.2.10): Downloading (100%)
     - Installing composer/xdebug-handler (1.4.3): Downloading (100%)
     - Installing composer/spdx-licenses (1.5.4): Downloading (100%)
     - Installing composer/semver (1.5.1): Downloading (100%)
     - Installing composer/ca-bundle (1.2.8): Downloading (100%)
     - Installing composer/composer (1.10.10): Downloading (100%)
     - Installing barryvdh/reflection-docblock (v2.0.6): Downloading (100%)
     - Installing barryvdh/laravel-ide-helper (v2.8.0): Downloading (100%)
     - Installing predis/predis (v1.1.4): Downloading (100%)
     - Installing illuminate/redis (v5.6.0): Downloading (100%)
     - Installing symfony/polyfill-php72 (v1.18.1): Downloading (100%)
     - Installing paragonie/random_compat (v9.99.99): Downloading (100%)
     - Installing symfony/polyfill-php70 (v1.18.1): Downloading (100%)
     - Installing symfony/polyfill-intl-normalizer (v1.18.1): Downloading (100%)
     - Installing symfony/polyfill-intl-idn (v1.18.1): Downloading (100%)
     - Installing symfony/mime (v5.1.4): Downloading (100%)
     - Installing symfony/http-foundation (v4.4.12): Downloading (100%)
     - Installing illuminate/session (v5.6.39): Downloading (100%)
     - Installing symfony/event-dispatcher-contracts (v1.1.9): Downloading (100%)
     - Installing symfony/event-dispatcher (v4.4.12): Downloading (100%)
     - Installing symfony/var-dumper (v5.1.4): Downloading (100%)
     - Installing symfony/debug (v4.4.12): Downloading (100%)
     - Installing symfony/error-handler (v4.4.12): Downloading (100%)
     - Installing symfony/http-kernel (v4.4.12): Downloading (100%)
     - Installing nikic/fast-route (v1.3.0): Downloading (100%)
     - Installing illuminate/container (v5.6.39): Downloading (100%)
     - Installing illuminate/events (v5.6.39): Downloading (100%)
     - Installing illuminate/view (v5.6.39): Downloading (100%)
     - Installing illuminate/translation (v5.6.39): Downloading (100%)
     - Installing illuminate/validation (v5.6.39): Downloading (100%)
     - Installing illuminate/database (v5.6.39): Downloading (100%)
     - Installing illuminate/queue (v5.6.39): Downloading (100%)
     - Installing illuminate/pipeline (v5.6.39): Downloading (100%)
     - Installing illuminate/pagination (v5.6.39): Downloading (100%)
     - Installing monolog/monolog (1.25.5): Downloading (100%)
     - Installing illuminate/log (v5.6.39): Downloading (100%)
     - Installing illuminate/http (v5.6.39): Downloading (100%)
     - Installing illuminate/hashing (v5.6.39): Downloading (100%)
     - Installing illuminate/encryption (v5.6.39): Downloading (100%)
     - Installing illuminate/config (v5.6.39): Downloading (100%)
     - Installing illuminate/cache (v5.6.39): Downloading (100%)
     - Installing illuminate/bus (v5.6.39): Downloading (100%)
     - Installing illuminate/broadcasting (v5.6.39): Downloading (100%)
     - Installing illuminate/auth (v5.6.39): Downloading (100%)
     - Installing dragonmantank/cron-expression (v2.3.0): Downloading (100%)
     - Installing laravel/lumen-framework (v5.6.4): Downloading (100%)
     - Installing swooletw/laravel-swoole (v2.6.67): Downloading (100%)
     - Installing vlucas/phpdotenv (v2.6.6): Downloading (100%)
     - Installing fzaninotto/faker (v1.9.1): Downloading (100%)
     - Installing hamcrest/hamcrest-php (v2.0.1): Downloading (100%)
     - Installing mockery/mockery (1.3.3): Downloading (100%)
     - Installing webmozart/assert (1.9.1): Downloading (100%)
     - Installing phpdocumentor/reflection-docblock (5.2.1): Downloading (100%)
     - Installing phpunit/php-token-stream (3.1.1): Downloading (100%)
     - Installing sebastian/version (2.0.1): Downloading (100%)
     - Installing sebastian/resource-operations (2.0.1): Downloading (100%)
     - Installing sebastian/recursion-context (3.0.0): Downloading (100%)
     - Installing sebastian/object-reflector (1.1.1): Downloading (100%)
     - Installing sebastian/object-enumerator (3.0.3): Downloading (100%)
     - Installing sebastian/global-state (2.0.0): Downloading (100%)
     - Installing sebastian/exporter (3.1.2): Downloading (100%)
     - Installing sebastian/environment (4.2.3): Downloading (100%)
     - Installing sebastian/diff (3.0.2): Downloading (100%)
     - Installing sebastian/comparator (3.0.2): Downloading (100%)
     - Installing phpunit/php-timer (2.1.2): Downloading (100%)
     - Installing phpunit/php-text-template (1.2.1): Downloading (100%)
     - Installing phpunit/php-file-iterator (2.0.2): Downloading (100%)
     - Installing theseer/tokenizer (1.2.0): Downloading (100%)
     - Installing sebastian/code-unit-reverse-lookup (1.0.1): Downloading (100%)
     - Installing phpunit/php-code-coverage (6.1.4): Downloading (100%)
     - Installing doctrine/instantiator (1.3.1): Downloading (100%)
     - Installing phpspec/prophecy (1.11.1): Downloading (100%)
     - Installing phar-io/version (2.0.1): Downloading (100%)
     - Installing phar-io/manifest (1.0.3): Downloading (100%)
     - Installing myclabs/deep-copy (1.10.1): Downloading (100%)
     - Installing phpunit/phpunit (7.5.20): Downloading (100%)
   symfony/translation suggests installing symfony/config
   symfony/translation suggests installing symfony/yaml
   illuminate/support suggests installing ramsey/uuid (Required to use Str::uuid() (^3.7).)
   illuminate/filesystem suggests installing league/flysystem (Required to use the Flysystem local and FTP drivers (~1.0).)
   illuminate/filesystem suggests installing league/flysystem-aws-s3-v3 (Required to use the Flysystem S3 driver (~1.0).)
   illuminate/filesystem suggests installing league/flysystem-cached-adapter (Required to use the Flysystem cache (~1.0).)
   illuminate/filesystem suggests installing league/flysystem-rackspace (Required to use the Flysystem Rackspace driver (~1.0).)
   illuminate/filesystem suggests installing league/flysystem-sftp (Required to use the Flysystem SFTP driver (~1.0).)
   symfony/service-contracts suggests installing symfony/service-implementation
   symfony/console suggests installing symfony/lock
   illuminate/console suggests installing guzzlehttp/guzzle (Required to use the ping methods on schedules (~6.0).)
   doctrine/cache suggests installing alcaeus/mongo-php-adapter (Required to use legacy MongoDB driver)
   barryvdh/reflection-docblock suggests installing dflydev/markdown (~1.0)
   barryvdh/reflection-docblock suggests installing erusev/parsedown (~1.0)
   predis/predis suggests installing ext-phpiredis (Allows faster serialization and deserialization of the Redis protocol)
   paragonie/random_compat suggests installing ext-libsodium (Provides a modern crypto API that can be used to generate random bytes.)
   symfony/polyfill-intl-normalizer suggests installing ext-intl (For best performance)
   symfony/polyfill-intl-idn suggests installing ext-intl (For best performance)
   symfony/event-dispatcher-contracts suggests installing psr/event-dispatcher
   symfony/event-dispatcher suggests installing symfony/dependency-injection
   symfony/var-dumper suggests installing ext-intl (To show region name in time zone dump)
   symfony/http-kernel suggests installing symfony/browser-kit
   symfony/http-kernel suggests installing symfony/config
   symfony/http-kernel suggests installing symfony/dependency-injection
   illuminate/queue suggests installing aws/aws-sdk-php (Required to use the SQS queue driver (~3.0).)
   illuminate/queue suggests installing ext-pcntl (Required to use all features of the queue worker.)
   illuminate/queue suggests installing pda/pheanstalk (Required to use the Beanstalk queue driver (~3.0).)
   monolog/monolog suggests installing aws/aws-sdk-php (Allow sending log messages to AWS services like DynamoDB)
   monolog/monolog suggests installing doctrine/couchdb (Allow sending log messages to a CouchDB server)
   monolog/monolog suggests installing ext-amqp (Allow sending log messages to an AMQP server (1.0+ required))
   monolog/monolog suggests installing ext-mongo (Allow sending log messages to a MongoDB server)
   monolog/monolog suggests installing graylog2/gelf-php (Allow sending log messages to a GrayLog2 server)
   monolog/monolog suggests installing mongodb/mongodb (Allow sending log messages to a MongoDB server via PHP Driver)
   monolog/monolog suggests installing php-amqplib/php-amqplib (Allow sending log messages to an AMQP server using php-amqplib)
   monolog/monolog suggests installing php-console/php-console (Allow sending log messages to Google Chrome)
   monolog/monolog suggests installing rollbar/rollbar (Allow sending log messages to Rollbar)
   monolog/monolog suggests installing ruflin/elastica (Allow sending log messages to an Elastic Search server)
   monolog/monolog suggests installing sentry/sentry (Allow sending log messages to a Sentry server)
   illuminate/broadcasting suggests installing pusher/pusher-php-server (Required to use the Pusher broadcast driver (~3.0).)
   laravel/lumen-framework suggests installing laravel/tinker (Required to use the tinker console command (~1.0).)
   sebastian/global-state suggests installing ext-uopz (*)
   phpunit/php-code-coverage suggests installing ext-xdebug (^2.6.0)
   phpunit/phpunit suggests installing ext-soap (*)
   phpunit/phpunit suggests installing ext-xdebug (*)
   phpunit/phpunit suggests installing phpunit/php-invoker (^2.0)
   Package phpunit/php-token-stream is abandoned, you should avoid using it. No replacement was suggested.
   Generating optimized autoload files
   Deprecation Notice: Class SwooleTW\Http\Helpers\VarDumper located in ./vendor/swooletw/laravel-swoole/src/Helpers/Dumper.php does not comply with psr-4 autoloading standard. It will not autoload anymore in Composer v2.0. in phar:///usr/local/bin/composer/src/Composer/Autoload/ClassMapGenerator.php:201
   Carbon 1 is deprecated, see how to migrate to Carbon 2.
   https://carbon.nesbot.com/docs/#api-carbon-2
       You can run './vendor/bin/upgrade-carbon' to get help in updating carbon and other frameworks and libraries that depend on it.
   40 packages you are using are looking for funding.
   Use the `composer fund` command to find out more!
   Removing intermediate container 24a7ffa9911b
    ---> b29ad162632c
   
   Successfully built b29ad162632c
   Successfully tagged miaosha_web:latest
   WARNING: Image for service web was built because it did not already exist. To rebuild this image you must use `docker-compose build` or `docker-compose up --build`.
   Creating miaosha-mysql ... done
   Creating miaosha-web   ... done
   Creating miaosha-redis ... done
   ```
   
2. 监听 docker 容器状态

    可以看到 web 容器已经被限制使用 8G 内存，实际压测中，内存也并不是瓶颈，并且 cpu 也没有拉满，最多只达到了 500% 左右

   ```
   ➜  miaosha git:(master) ✗ docker stats
   CONTAINER ID        NAME                CPU %               MEM USAGE / LIMIT     MEM %               NET I/O             BLOCK I/O           PIDS
   abc73f28641a        miaosha-web         0.02%               6.84MiB / 8GiB        0.08%               1.07kB / 0B         0B / 0B             3
   9c55b523df8a        miaosha-mysql       0.22%               170MiB / 9.736GiB     1.70%               1.07kB / 0B         0B / 0B             27
   36f2eec86124        miaosha-redis       0.65%               2.852MiB / 9.736GiB   0.03%               1.07kB / 0B         0B / 0B             5
   ```

3. 开启一个新的窗口进入 web 容器进行数据初始化及开启生成订单队列

   ```
   ➜  ~ docker exec -it miaosha-web /bin/sh
   # 生成测试数据
   /var/www/html # php artisan mock
   清理旧数据
   生成数据表
   Migration table created successfully.
   Migrating: 2020_09_03_153808_create_table_activity
   Migrated:  2020_09_03_153808_create_table_activity
   Migrating: 2020_09_04_012939_create_table_order
   Migrated:  2020_09_04_012939_create_table_order
   Migrating: 2020_09_04_013641_create_table_product
   Migrated:  2020_09_04_013641_create_table_product
   Migrating: 2020_09_04_061404_create_jobs_table
   Migrated:  2020_09_04_061404_create_jobs_table
   Migrating: 2020_09_04_061831_create_failed_jobs_table
   Migrated:  2020_09_04_061831_create_failed_jobs_table
   添加模拟数据
   Seeding: SeederProduct
   Seeding: SeederActivity
   清理缓存数据
   写入秒杀活动缓存
   模拟测试准备完成
   
   # 开启生成订单队列
   /var/www/html # php artisan queue:work --queue=generate-order

   ```   

4. 开启一个新的窗口进入web容器进行开启服务

   ```
   ➜  ~ docker exec -it miaosha-web /bin/sh
   /var/www/html # php artisan swoole:http start
   Starting swoole http server...
   Swoole http server started: <http://0.0.0.0:8080>
   ```

5. 开启一个新的窗口进入web容器，查看当前活动数据

    压测前活动数据：缓存数据中活动总量为1000，库存为1000，总用户量和成功用户量都为0，数据库信息中商品销量为0，库存1000，活动总量和库存都为1000，订单总数为0，数据正常
    
   ```
   /var/www/html # php artisan activity-info 1
   ************************************* 缓存信息 *************************************
   秒杀活动缓存：
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   | created_at | start_time | product_id | amount | rate | end_time   | stock | deleted_at | id |
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   | 1599397545 | 1599397545 | 1          | 1000   | 10   | 1599483945 | 1000  | 0          | 1  |
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   总请求量：
   总用户量：0
   成功用户量：0
   
   ************************************* 数据库信息 *************************************
   商品信息：
   +----+-------+------+-------+------------+------------+------------+
   | id | price | sale | stock | created_at | updated_at | deleted_at |
   +----+-------+------+-------+------------+------------+------------+
   | 1  | 9900  | 0    | 1000  | 1599397545 | 1599397545 | 0          |
   +----+-------+------+-------+------------+------------+------------+
   活动信息：
   +----+------------+------------+------------+--------+-------+------+------------+
   | id | product_id | start_time | end_time   | amount | stock | rate | created_at |
   +----+------------+------------+------------+--------+-------+------+------------+
   | 1  | 1          | 1599397545 | 1599483945 | 1000   | 1000  | 10   | 1599397545 |
   +----+------------+------------+------------+--------+-------+------+------------+
   订单总数信息：0
   ```

   压测后活动数据：缓存数据中活动总量为1000，库存为0，总请求量为10000，成功用户量为1000，数据库信息中商品销量为1000，库存0，活动总量1000，库存为0，订单总数为1000，数据正常

   ```
   /var/www/html # php artisan activity-info 1
   ************************************* 缓存信息 *************************************
   秒杀活动缓存：
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   | created_at | start_time | product_id | amount | rate | end_time   | stock | deleted_at | id |
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   | 1599397545 | 1599397545 | 1          | 1000   | 10   | 1599483945 | 0     | 0          | 1  |
   +------------+------------+------------+--------+------+------------+-------+------------+----+
   总请求量：10000
   总用户量：9953
   成功用户量：1000
   
   ************************************* 数据库信息 *************************************
   商品信息：
   +----+-------+------+-------+------------+------------+------------+
   | id | price | sale | stock | created_at | updated_at | deleted_at |
   +----+-------+------+-------+------------+------------+------------+
   | 1  | 9900  | 1000 | 0     | 1599397545 | 1599397641 | 0          |
   +----+-------+------+-------+------------+------------+------------+
   活动信息：
   +----+------------+------------+------------+--------+-------+------+------------+
   | id | product_id | start_time | end_time   | amount | stock | rate | created_at |
   +----+------------+------------+------------+--------+-------+------+------------+
   | 1  | 1          | 1599397545 | 1599483945 | 1000   | 0     | 10   | 1599397545 |
   +----+------------+------------+------------+--------+-------+------+------------+
   订单总数信息：1000
   ```

6. 开启一个新的窗口进行压测，本次压测采用的是 ab，100个并发量完成 一万 个请求

   ```
   ➜  ~ ab -c100 -n10000 -k http://127.0.0.1:8080/api/buy\?activityId\=1
   This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
   Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
   Licensed to The Apache Software Foundation, http://www.apache.org/
   
   Benchmarking 127.0.0.1 (be patient)
   Completed 1000 requests
   Completed 2000 requests
   Completed 3000 requests
   Completed 4000 requests
   Completed 5000 requests
   Completed 6000 requests
   Completed 7000 requests
   Completed 8000 requests
   Completed 9000 requests
   Completed 10000 requests
   Finished 10000 requests
   
   
   Server Software:        swoole-http-server
   Server Hostname:        127.0.0.1
   Server Port:            8080
   
   Document Path:          /api/buy?activityId=1
   Document Length:        6 bytes
   
   Concurrency Level:      100
   Time taken for tests:   9.476 seconds
   Complete requests:      10000
   Failed requests:        0
   Keep-Alive requests:    10000
   Total transferred:      1920000 bytes
   HTML transferred:       60000 bytes
   Requests per second:    1055.34 [#/sec] (mean)
   Time per request:       94.756 [ms] (mean)
   Time per request:       0.948 [ms] (mean, across all concurrent requests)
   Transfer rate:          197.88 [Kbytes/sec] received
   
   Connection Times (ms)
                 min  mean[+/-sd] median   max
   Connect:        0    0   0.3      0       4
   Processing:    33   94  19.6     90     215
   Waiting:       29   94  19.6     90     215
   Total:         33   94  19.6     90     215
   
   Percentage of the requests served within a certain time (ms)
     50%     90
     66%     97
     75%    102
     80%    106
     90%    119
     95%    131
     98%    146
     99%    157
    100%    215 (longest request)
   ```
   
7. 测试完毕后销毁容器和构建的 web 镜像

   ```
   ➜  miaosha git:(master) ✗ bash destroy.sh
   miaosha-web
   miaosha-redis
   miaosha-mysql
   miaosha-web
   miaosha-redis
   miaosha-mysql
   Untagged: miaosha_web:latest
   Deleted: sha256:183e244e1bdbfdbedb2652974ccdd76584b00afc8bab8443d63223d1a0f7a0ee
   Deleted: sha256:550267bf5110d6497bb7bae49621c302401ec60c99ff9df6c0f8153e6bd0024c
   Deleted: sha256:3a432472aa72bcedd452d2583bdc28c61c7f15c480e2170e7e5ca8210a4cc85b
   Deleted: sha256:2e0647588817016817d5f31ab1e57c3388713095cf9c788808530256309ea79c
   ```   
   
**从压测结果看出，100个并发量，一万个请求，全部成功，QPS 达到了 1055，请求平均响应时间为 94.756 ms**

下图为压测过程中 http 服务的请求记录 及 生成订单队列 的截图：

![](https://blog.cdn.lerzen.com/2gb6FrKvtB6FKMTRlm6mzlpW+kT63wcFftmfpCLDYVc=.jpg)

## 说明

本项目使用 docker 来运行，主要包含三个服务：web、redis、mysql，compose 目录即为对应的数据及日志，src 目录为 web 部分源码，目录结构如下：

```
.
├── Dockerfile                                // 采用 swoole 的 web 服务
├── Dockerfile.bak                            // 采用 fpm 的 web 服务
├── compose                                   // docker compose 映射目录
│   ├── mysql                           // mysql 服务数据
│   ├── redis                           // redis 服务数据
│   └── web                             // web 服务日志
├── destroy.sh                                // 清理容器及 web 镜像脚本
├── docker-compose.yml                        // docker compose 脚本
├── miaosha.nginx.conf                        // fpm 版 nginx 配置文件
├── miaosha.supervisor.ini                    // 生成订单队列的 supervisor 配置文件
├── readme.md                                 // Readme
├── src                                       // web 源码
└── start.sh                                  // fpm 版 开始脚本
```

### web服务

web 服务采用 lumen5.6 + swoole(4.5.3) 开发，用 8080 端口对外提供服务

[点击查看DB结构](#mysql服务)

[点击查看Redis结构](#redis服务)

#### 1. 秒杀接口：/api/buy?activityId={活动ID}

秒杀接口是秒杀活动中的重中之重，一方面既要保证数据的完整性，不能超卖，也要保证接口的响应时间，本项目中依赖 redis 进行逻辑处理，仅处理生成订单前的部分逻辑，避免 mysql 成为项目的瓶颈.

在活动规则部分，各个秒杀活动都不一样，有先到先得类型，也有随缘类型，另外，针对每个用户也有单次或者多次的限制，本接口预留了随缘逻辑，默认每个用户只能调用一次，如果活动规则不一样，针对本接口进行调整即可。

秒杀接口为保证性能可以有很多中做法，如果预计参与人数与配置库存悬殊巨大的话，甚至可以在前端做随缘处理进行削峰，也可以针对IP、请求来源、单IP请求次数进行限制等，这个也涉及到了风险管控。

秒杀完整流程图如下：

![](https://blog.cdn.lerzen.com/6ZNahH+6LcgSWnfUUK7A+PDZl9Ykh4cmxvPHSL9QAfM=.jpg)

#### 2. 生成订单Job

秒杀接口处理的是生成订单前的部分逻辑，本 Job 处理的便是生成订单及之后的逻辑部分，并指定队列进行处理以及设定尝试次数，如果多次尝试依然失败，本 Job 会记录失败信息，并在最后一次失败时进行特殊处理，包括不限于记录日志、发送短信、发送语音电话、发送微信消息、发送IM报警等

#### 3. 核心命令

- 初始化数据：php artisan mock
- 启动服务：php artisan swoole:http start
- 启动队列，该部分也可以配合 supervisor 或者 swoole 进程使用：php artisan queue:work --queue=generate-order
- 查看活动信息：php artisan activity-info {活动ID，默认1}

生成订单队列Job流程图

![](https://blog.cdn.lerzen.com/tnakgI2i7YIZUu8fSHCqsGGrRUYV0wy8seGYdrLpCOY=.jpg)
    
### mysql服务

mysql 服务采用的版本为 5.7.13，本项目中，mysql重点用于生成订单 Job 环节

数据结构：

1. 商品表

```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| price      | int(10) unsigned | NO   |     | 0       |                |
| name       | varchar(255)     | NO   |     |         |                |
| cover      | varchar(255)     | NO   |     |         |                |
| pics       | varchar(1000)    | NO   |     |         |                |
| sale       | int(11)          | NO   |     | 0       |                |
| stock      | int(11)          | NO   |     | 0       |                |
| created_at | int(10) unsigned | NO   |     | 0       |                |
| updated_at | int(10) unsigned | NO   |     | 0       |                |
| deleted_at | int(10) unsigned | NO   |     | 0       |                |
+------------+------------------+------+-----+---------+----------------+
```

2. 活动表

模拟测试的时候，秒杀活动设置的成功比例为10%，库存为1000，即预测最小 10000 的不重复请求

```
+--------------+---------------------+------+-----+---------+----------------+
| Field        | Type                | Null | Key | Default | Extra          |
+--------------+---------------------+------+-----+---------+----------------+
| id           | int(10) unsigned    | NO   | PRI | NULL    | auto_increment |
| product_id   | int(10) unsigned    | NO   | MUL | 0       |                |
| name         | varchar(255)        | NO   |     |         |                |
| price        | int(10) unsigned    | NO   |     | 0       |                |
| origin_price | int(10) unsigned    | NO   |     | 0       |                |
| start_time   | int(10) unsigned    | NO   |     | 0       |                |
| end_time     | int(10) unsigned    | NO   |     | 0       |                |
| amount       | int(10) unsigned    | NO   |     | 0       |                |
| stock        | int(10) unsigned    | NO   |     | 0       |                |
| rate         | tinyint(3) unsigned | NO   |     | 0       |                |
| created_at   | int(10) unsigned    | NO   |     | 0       |                |
| updated_at   | int(10) unsigned    | NO   |     | 0       |                |
| deleted_at   | int(10) unsigned    | NO   |     | 0       |                |
+--------------+---------------------+------+-----+---------+----------------+
```

3. 订单表

```
+-------------+------------------+------+-----+---------+-------+
| Field       | Type             | Null | Key | Default | Extra |
+-------------+------------------+------+-----+---------+-------+
| id          | varchar(32)      | NO   | PRI | NULL    |       |
| activity_id | int(10) unsigned | NO   | MUL | 0       |       |
| user_id     | int(10) unsigned | NO   | MUL | 0       |       |
| product_id  | int(10) unsigned | NO   | MUL | 0       |       |
| amount      | int(10) unsigned | NO   |     | 0       |       |
| price       | int(10) unsigned | NO   |     | 0       |       |
| money       | int(10) unsigned | NO   |     | 0       |       |
| status      | tinyint(4)       | NO   |     | 0       |       |
| created_at  | int(10) unsigned | NO   |     | 0       |       |
| updated_at  | int(10) unsigned | NO   |     | 0       |       |
| deleted_at  | int(10) unsigned | NO   |     | 0       |       |
+-------------+------------------+------+-----+---------+-------+
```

### redis服务

redis 采用最新版本镜像，本项目中，redis 重点用于秒杀接口中，也是各个提高秒杀接口性能、保障数据统一的关键部分

秒杀接口环节重点用了四个缓存，分别是：

key | 数据类型 | 说明
---|---|---
request_num | string | 记录接口请求量，每次请求时进行 incr 操作
activity_info_{活动ID} | hash | 活动详情缓存信息
activity_all_user_ids_{活动ID} | set | 所有参与活动的用户ID，也可以使用zset，记录用户参与时间
activity_success_user_ids_{活动ID} | set | 所有秒杀成功的用户ID，也可以使用zset，记录用户成功时间