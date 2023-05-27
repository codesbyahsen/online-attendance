<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Attendance Feature Web App

After clone this project follow these steps:

Run these commands
```php
    composer install
```

```js
    npm install
```

### Environment Setup

DB_DATABASE=online_attendance

Run this command, remember to seed for testing data

```php
    php artisan migrate --seed
```

## About the role and authentication

There would be a record for admin and other users in database,
Admin can mark attendance for every user however, other users can
only mark their own attendance.

#### Credentials
Email: admin@admin.com
Password: password

for other users you can see into database for the email and the password is 'password'
you can also register yourself and login to access attendance feature.

Thank You

# AHSEN ALEE
### ahsenalee4@gmail.com
