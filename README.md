<div align="left">
  <h3 align="center">Next Basket PHP assessment</h3>

  <p align="center">
    Project for senior php developer for next basket using laravel (php), mysql, redis, rabbitmq and docker
    <br />
  </p>

## Getting Started

Follow the instruction below to setting up your project.

### Prerequisites

- Download and Install [Docker](https://docs.docker.com/engine/install/)

### Clone This Repository

<code>
    git clone https://github.com/boluajileye/nextBasketAssessment.git next_basket_assessment
</code>

## Installation Steps for CLI

- Run `cd next_basket_assessment` to change the directory into project folder.

#

- Run `cd NotificationService` to change the directory into notification service folder.
- Run `composer install && cp .env.example .env && php artisan key:generate` to install all dependencies, copy .env.example to .env and generate new app key.

#

- Run `cd ../UserService` to change the directory into user service folder.
- Run `composer install && cp .env.example .env && php artisan key:generate` to install all dependencies, copy .env.example to .env and generate new app key.

#

- Run command `cd ..` on your terminal to go back to project terminal.
- Run command `sudo chown -R www-data:www-data NotificationService UserService/ ` on your terminal in the project directory.
- Run command `docker-compose build` on your terminal.
- Run command `docker stop notification_app user_app rabbitmq_next redis_next mysql_next` on your terminal to kill all existing containers with similar name.
- Run command `docker-compose up -d` on your terminal.

#

- Open a new terminal and run `docker exec -it user_app /bin/sh`
- Run command `php artisan migrate --force && php artisan test && php artisan queue:work` on your terminal to migrate database tables, run test and start queue worked to run "NotificationEventJob" to dispatch notification messages.

#

- Open a new terminal and run command `docker exec -it notification_app /bin/sh` on your terminal
- Run command `php artisan migrate --force && php artisan test && php artisan schedule:run` on your terminal to migrate database tables, run test and start schedular to call "php artisan notify" to listen for notification messages.

#

- Open a new terminal and run `docker exec -it notification_app /bin/sh`
- Run command `php artisan queue:work` on your terminal

#

- Open a new terminal and run `docker exec -it notification_app /bin/sh`
- Run command `tail -f storage/logs/laravel.log` on your terminal

- Make a post request to http://localhost:8001 (User Service) using the sample data below

#### User Payload

<pre>
<code>
    "email": "test@user.com",
    "firstName": "jasonon",
    "lastName": "statam"
</code>
</pre>

**Check the terminal on where you are tailing the laravel.log to view the user data log on the notification service app**
