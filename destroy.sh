#!/bin/bash

echo '停止容器'
docker stop miaosha-web miaosha-redis miaosha-mysql

echo '删除容器'
docker rm miaosha-web miaosha-redis miaosha-mysql

echo '删除web镜像'
docker rmi $(docker images miaosha_web:latest -q)

echo '删除mysql和redis数据'
rm -rf ./compose/mysql/data ./compose/redis/data