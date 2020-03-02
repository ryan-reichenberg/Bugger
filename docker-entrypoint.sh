#!/bin/sh
# Edit .env
if [ ! -f "./.env" ]; then
    echo Copying .env
    cp .env.example .env
    echo Please edit your .env file and rerun the container...
    exit 1;
else 
    echo "Found .env, continuing..."
fi
# Install depencies
if [ ! -d "./vendor" ]; then
    echo Installing dependencies
    composer install
else 
    echo "Found vendor directory, continuing..."
fi
key=$(cat ./.env | grep ^APP_KEY= | cut -d '=' -f2)
if [ -z $key ]; then
    echo Generating key
    php artisan key:generate
fi
# Seed DB. Will determine if there is anything to migrate
echo Seeding database
rm -f bootstrap/cache/*.php
php artisan migrate

exec $@