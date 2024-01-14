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

    'facebook' => [
        'client_id' => '355467306372724', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '1700e53dc04c7ac817384056e2db2f56', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://glory.wpgooal.com/ASAS_App/public/api/social/login/father'
    ],

    'google' => [
        'client_id' => '1054444316489-go84beeu43brp4k1figs5kqjrp7jhrkj.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://glory.wpgooal.com/ASAS_App/public/api/social/login/father',
    ],

];
