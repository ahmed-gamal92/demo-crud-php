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


# API

## Create Book
#### API Request

``` POST https://base_url/v1/books ```

#### Headers

``` Content-Type  ``` application/json

#### Request JSON Body

| Parameter    | Type    | Description    |
| -------------|---------|----------------|
| name         | string  | Book's name    |                     
| price        | number  | Book's Price   | 
| author       | string  | Book's author  | 
| category     | string  | Book's category| 

#### JSON response examples
HTTP/1.1 201 CREATED

```
{
 "data": {
        "id": "c2a51c70-6a9c-11e9-8423-b5baac023e0b",
        "name": "name",
        "price": 2,
        "author": "auh",
        "category": "rr"
    }
}
```
HTTP/1.1 400 Bad Request

```
{
    "error": {
        "code": "GEN-WRONG-ARGS",
        "http_code": 400,
        "message": {
            "name": [
                "The name has already been taken."
            ],
            "price": [
                "The price field is required."
            ]
        }
    }
}
```

## Update Book
#### API Request

``` PUT https://base_url/v1/books/{id} ```

#### Headers

``` Content-Type  ``` application/json

#### Request JSON Body

| Parameter    | Type    | Description    |
| -------------|---------|----------------|
| name         | string  | Book's name    |                     
| price        | number  | Book's Price   | 
| author       | string  | Book's author  | 
| category     | string  | Book's category| 

#### JSON response examples
HTTP/1.1 200 OK

```
{
 "data": {
        "id": "c2a51c70-6a9c-11e9-8423-b5baac023e0b",
        "name": "name",
        "price": 2,
        "author": "auh",
        "category": "rr"
    }
}
```
HTTP/1.1 400 Bad Request

```
{
    "error": {
        "code": "GEN-WRONG-ARGS",
        "http_code": 400,
        "message": {
            "price": [
                "The price field is required."
            ]
        }
    }
}
```
## GET Book
#### API Request

``` GET https://base_url/v1/books/{id} ```

#### JSON response examples
HTTP/1.1 200 OK

```
{
 "data": {
        "id": "c2a51c70-6a9c-11e9-8423-b5baac023e0b",
        "name": "name",
        "price": 2,
        "author": "auh",
        "category": "rr"
    }
}
```
HTTP/1.1 400 Bad Request

```
{
    "error": {
        "code": "GEN-WRONG-ARGS",
        "http_code": 400,
        "message": {
            "uuid": [
                "The selected uuid is invalid."
            ]
        }
    }
}
```
## List Books
#### API Request

``` GET https://base_url/v1/books ```

#### JSON response examples
HTTP/1.1 200 OK

```
{
    "data": [
        {
            "id": "52d9bba0-6aa0-11e9-95ce-2119e0fae230",
            "name": "name 123 HgfHcszp8bq7eQ==",
            "price": 12,
            "author": "author",
            "category": "cat"
        },
        {
            "id": "52eaeb70-6aa0-11e9-8aa7-25283ca188d9",
            "name": "up gN15jfXdfStmaQ==",
            "price": 34,
            "author": "author up",
            "category": "cat up"
        },
        {
            "id": "52fd8f70-6aa0-11e9-8ab8-93a9d67ff767",
            "name": "name 3P3oisRTdqcbuQ==",
            "price": 12,
            "author": "author",
            "category": "cat"
        }
    ]
}
```