#!/bin/sh
#Start docker containers in background
docker-compose up -d
# Wait for DB
until docker-compose exec db mysql -u root -proot -D "laravel" --silent -e "show databases;"
do
  echo "Waiting for database connection..."
  sleep 5
done
# Edit .env
if [ ! -f "./.env" ]; then
    echo Copying .env
    cp .env.example .env
    vim .env
else 
    echo "Found .env, continuing..."
fi
# Install depencies
if [ ! -d "./vendor" ]; then
    echo Installing dependencies
    docker-compose exec app composer install
else 
    echo "Found vendor directory, continuing..."
fi
key=$(cat ./.env | grep ^APP_KEY= | cut -d '=' -f2)
if [ -z $key ]; then
    echo Generating key
    docker-compose exec app php artisan key:generate
fi
# Seed DB. Will determine if there is anything to migrate
echo Seeding database
rm -f bootstrap/cache/*.php
docker-compose exec app php artisan migrate && echo Database migrated
