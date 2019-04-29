# Demo CRUD

## Technologies used
- PHP 7, Laravel 5.8
- Docker
- Nginx
- MongoDB

## Setup

Please insure you have docker up and running

        $ docker-compose build
        $ docker-compose up -d

The first time that you execute this it may take a bit longer. Wait until it's done.
    
You always have to wait till the **dmo-php-fpm** container fully load, you can check this by checking the logs with:
    
        $ docker logs dmo-php-fpm
        
you should see:
    
       [29-April-2019 10:03:43] NOTICE: ready to handle connections

App will be running in http://localhost:8888

## To Run tests

    $ docker exec -it dmo-php-fpm bash
    $ ./vendor/phpunit/phpunit/phpunit

