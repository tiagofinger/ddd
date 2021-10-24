# DDD

This is a simple way to create a DDD aplication with PHP without framework. This application is very simple, only to show the concepts of DDD.

## Installation

Use PHP 8, PHPUnit 9.5.10 and composer

Run:
```composer
composer install
```
Run unit tests:
```phpunit
./vendor/bin/phpunit
```

## Usage

Enroll Student:
```enroll
php enroll-student.php "016.404.187-90" "Nome" "test@gmail.com" "51" "981474017"
```

Get All Students:
```getall
php get-all-enrolled-student.php
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)