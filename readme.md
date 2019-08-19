## About
Transactional email microservice

## Requirments
- PHP >= 7.2.*
- Laravel >= 5.8.*
- MySql >= 8.*
- docker >= 18.*

## Installation 
Clone project through this github URL.
- git clone https://github.com/mbbhatti/takeaway.git

Run docker composer file with following command
- docker-compose up -d

Laravel utilizes composer to manage its dependencies. So, before using Laravel, make sure you have composer installed on your machine. To download all required packages run these commands.
- docker-compose exec php sh
- composer install

Vue js utilizes npm to manage its dependencies. So, before using it, make sure you have npm installed on your machine. To get all required packages run this command.
- npm install

## Database Setup
You need to create a .env file from. env.example. For this run this command if .env not exists.
-  cp .env.example .env

Then, run this command to create key in .env file if not exists.
- php artisan key:generate

Now, set your database credential against these in .env file.

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=homestead
- DB_USERNAME=homestead
- DB_PASSWORD=secret

Use this migration command to create database tables.
- php artisan migrate

## Endpoints
Application implemented by Single-Opt-In process.

- GET /email
- POST /email
- GET /logs

## Mail Setting
External mail services will be set in .env file with these parameters

Mailgun parameters 
- MAILGUN_DOMAIN=
- MAILGUN_PRIVATE=
- MAILGUN_PUBLIC=

Mailjet parameters 
- MAILJET_DRIVER=mailjet
- MAILJET_APIKEY=
- MAILJET_APISECRET=

General parameters
- MAIL_FROM_NAME="NAME"
- MAIL_FROM_EMAIL=EMAIL
- MAIL_REPLY_TO=EMAIL
- MAIL_SUBJECT="SUBJECT"

## Test
php_testability and PHPUnit used for code testability and performance. You may need to run below command for testing within php interface.
- docker-compose exec php sh

Use this command for single file
- vendor/bin/phpunit --filter [FileName]

Use this command for all files tests
- vendor/bin/phpunit

## Run project
Use this command on run project without docker
- php artisan serve