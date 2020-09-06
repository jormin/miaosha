#!/bin/bash

docker stop miaosha-web miaosha-redis miaosha-mysql

docker rm miaosha-web miaosha-redis miaosha-mysql

docker rmi $(docker images miaosha_web:latest -q)