#!/bin/sh
echo Stopping containers
docker stop webserver db app
echo Removing containers
docker rm webserver db app
echo Removing images
if [ "$1" == "--clean-up" ]; then
    docker rmi php_service php:7.2-fpm nginx:alpine mysql:5.7.22
    dangling=$(docker images -f "dangling=true" -q)
    if [ ! -z "$dangling"];then
        echo Removing danlging images
        docker rmi $dangling
    fi
fi