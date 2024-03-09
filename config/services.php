<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'transport' => 'mailgun',
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id'     => '584504173047-qhad3gbsqgmmrmidl54nd76f6e2vbhj4.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://127.0.0.1:8000/login/google/callback',
    ],

    'facebook' => [
        'client_id'     => '690581659882777',
        'client_secret' => '04e1041f6738b287837bd9f6b4c264d3',
        'redirect'      => 'https://alshaerawy.aait-sa.com/login/facebook/callback',
    ],

];
