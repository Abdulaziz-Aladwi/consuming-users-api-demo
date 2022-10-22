## About Application

Simple Demo that have a command which consume users from external APIs and save them to Database.
And two endpoints to fetch these and search form them.

## Prerequisites

1- PHP 7.4  <br/>
2- Composer  <br/>
3- MySQL 5.7.38 

## Installation

1-configure database credentials in .env
2-Initialize API secret which you will send in request headers with key ##api-token to be able to access the APIs.
3-composer install

## EndPoints you will user
1- Command to fetch data from APIs "php artisan consume:users"

## EndPoints you will user

1-Fetch Users Endpoint {{baseUri}}/api/users/list
2- Search Users Endpoint {{baseUri}}/api/users/search with query parameters (firstName, LastName, Email)
