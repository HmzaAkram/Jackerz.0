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

    'stripe' => [
    'key' => env('pk_test_51Qdpl5P8wgT50cNztkNlbsjBNpYlTs9Q4OxfPJSw5NjtU6kgyD0GBDPMT7S5KeZ1sRUcKCSLisJY0GyKs9kDVbgo00y8oAyvZe'),
    'secret' => env('sk_test_51Qdpl5P8wgT50cNzhNNxNQAZUL2lmybGoAokgVnhNLknVnfCD821G23ZUVfqh6vtBPVMpkeYATH4MRVOr4mF7TO700t7MFwl1P'),
],


];
