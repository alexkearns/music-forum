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

### Implementation

- Default Laravel Auth
- [reCaptcha](https://github.com/anhskohbo/no-captcha) by google to prevent bots brute forcing application.
- [Pwnded Password Validation](https://github.com/valorin/pwned-validator) that doesn't allow a user to use a password that has been leaked a certain number of times.
- [Acesss Control](https://github.com/JosephSilber/bouncer) that gives users roles and permissions.
- [Header Configuration](https://github.com/BePsvPT/secure-headers) to modify headers and ensure no vulnerabilities.
- Hide some headers, e.g. server.
- GitHub dependency graphs - shows vulnerably dependecies.
- [Bug Snag](https://www.bugsnag.com/) to effectively log production errors, allowing easy fixes.
- Uses optional Google 2 Factor Authentication, this can be enabled at registration, as well as managed post-registration

### Testing

The reports for security testing can be found [here](https://github.com/alexkearns/music-forum/tree/master/docs)

- PHP Unit Testing
- [Header Testing](https://schd.io/5NKy) to identify weaknesses in header configuation.
- [SSL Testing](https://www.ssllabs.com/) to examine server setup and find vulnerabilities.
- [OpenVAS](http://www.openvas.org/) to scan live site and detect vulnerabilities and provide sollutions.
- [OWASP Zap](https://www.owasp.org/index.php/OWASP_Zed_Attack_Proxy_Project) to automatically find security vulnerabilities while browsing.

