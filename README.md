# MusicForum

[![header_security A+](https://img.shields.io/badge/header_security-A+-green.svg)](https://schd.io/5NKy)

A fictional music forum written in PHP, focusing on web security.

## Setup

- cd into project root
- run ```composer install``` to install the required packages.
- ```cp .env.example .env``` and update values according to your local environment.
- run ```php artisan migrate --seed ``` to setup the db and seed it with test data.
- serve the site using your method of choice. ([Homestead](https://laravel.com/docs/5.5/homestead) can be used))
- If needed, run ```npm install``` to install the javascript packages and use ```npm run dev``` to generate the js and scss assets.

## Logs

[Laravel Log Viewer](https://github.com/rap2hpoutre/laravel-log-viewer) can be accessed at myApp/logs to view a more readable version of the laravel log.

## Security

[Header Testing](https://schd.io/5NKy)
