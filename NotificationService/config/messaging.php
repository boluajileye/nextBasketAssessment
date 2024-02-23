<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Message Event Configuration
    |--------------------------------------------------------------------------
    |
    */

    "queue_name" => env('RABBITMQ_QUEUE_NAME', "APP_NAME"),
    "rabbitmq_host" => env('RABBITMQ_HOST'),
    "rabbitmq_port" => env('RABBITMQ_PORT'),
    "rabbitmq_user" => env("RABBITMQ_USER"),
    "rabbitmq_password" => env("RABBITMQ_PASSWORD")
];

?>
