<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'exchange-api' => [
        'default' => 'exchange_rates',

        'fixer' => [
            'key' => env('fixer_api_key'),
            'class' => 'Webkul\Core\Helpers\Exchange\FixerExchange'
        ],

        'exchange_rates' => [
            'class' => 'Webkul\Core\Helpers\Exchange\ExchangeRates'
        ],
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '607988420103433',
        'client_secret' => '352b7f6bf6707cdc4a212937a7675718',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '556897270707-aj5buafcdjimd1t0itnpf4l9j8rsni1m.apps.googleusercontent.com',
        'client_secret' => 'E1V3SBfeUPb47KSmHU6GklF3',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ]
    
];
