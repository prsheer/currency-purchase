# Currency Purchase

Buy foreign currency application. 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 


### Installing

A step by step series of examples that tell you have to get a development env running.

```
git clone https://github.com/prsheer/currency-purchase.git
```

Run composer install.

```
composer install
```
Now create .env file and create database. Change database name, username and password with your settings.

```
cp .env.example .env
```

Then, you want to set a new application key.
      

```
php artisan key:generate
```

Run the migrations.
```
php artisan migrate
```
Get the lates exchange rates from the api.

```
php artisan update-exchange-rate
```
And you should be ready to go. If you want you can use laravel server for testing purpose. Just go inside the project and run:

```
php artisan serve
```