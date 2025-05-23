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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
//    USERNAME = "M521";
//const PASSWORD = "kOdVD5US";
//const CLIENT_ID = "62040925";
//const CLIENT_SECRET = "5SjZHaBgiAiC-1N91lq2LrVTgqvJw9Z8erR0DYyrCD41";
//const ENCRP_KEY = "2dvYuN8uEvilNk9sXPofGuzRA4tT0m1OQf7KZgBO2tl3G3QnhDNKh1uHdiOPku7VVG5MoowAX45ivfU_cpPSK5QDP83J4F0uu7xIe7tFJ1c1";
//const BASE_URL = "https://pg.cbk.com";
    //Payment gateway
    'payment_gateway' => [
        'cbk_payment' => [
            'payment_mode' => env('CBK_PAYMENT_MODE','live_mode'),
            'test_mode' => [
                'ENCRP_KEY' => 'H2rPoim9VBrCi6Hz-eUHpyIdGBTiWoA6h5Ov-0uIMoQZFFodDhjoeitj288mL0Yrgo0So5bp2K3URrGtjpGtvodEbkfkHPE-fnNOLCwjnks1',
                'CLIENT_ID' => '33657173',
                'CLIENT_SECRET' => '7niT7KbZKWbYYLfca8f92BA329VHEbqdG_KruDs7kOQ1',
                'PAYMENT_URL' => 'https://pgtest.cbk.com',
            ],
            'live_mode' => [
                'ENCRP_KEY' => env('CBK_ENCRP_KEY','0JKIRO4jw3qUxePXHhHi__GQJJb5XhpV1RU70ekEI6-lalOccK5hbgvEpRnVnXCvSzBfQ67JWNSXF9kyPZscwg9Jj3HsIqedNCYTRrzI9Qs1'),
                'CLIENT_ID' => env('CBK_CLIENT_ID','33657173'),
                'CLIENT_SECRET' => env('CBK_CLIENT_SECRET','rrv6iZ5WU1sImYXXxz6vPxD2m3nVSH1TbNiwwDEF-gQ1'),
                'PAYMENT_URL' => 'https://pg.cbk.com',
            ],
        ],
    ],
];


