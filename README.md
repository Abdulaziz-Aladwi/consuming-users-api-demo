## About Application

Simple Demo that have a command which consumes users from external APIs and save them to Database.
And two endpoints to fetch these data and search form them.

## Prerequisites

1- PHP 7.4  <br/>
2- Composer  <br/>
3- MySQL 5.7.38 

## Installation

1- Configure database credentials in .env <br/>
2- Initialize API secret which you will send in request headers with key ##api-token to be able to access the APIs. <br/>
3- Install dependencies using composer.
2- Migrate database files. <br/>

## Command to consume users:

```bash
php artisan consume:users
```

## EndPoints:

1- Fetch Users Endpoint {{baseUri}}/api/users/list <br/>
2- Search Users Endpoint {{baseUri}}/api/users/search with query parameters (firstName, lastName, email)
