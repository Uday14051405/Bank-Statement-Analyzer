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

    'gpu_api' => [
        'base_url' => env('GPU_API_BASE_URL'),
        'download_file' => env('GPU_API_DOWNLOAD_FILE'),
        'list_banks' => env('GPU_API_LIST_BANKS'),
        'bank_analysis' => env('GPU_API_BANK_ANALYSIS'),
        'upload_files' => env('GPU_API_UPLOAD_FILES'),
        'upload_file_stetement' => env('GPU_API_UPLOAD_STATEMENT'),
        'api_id' => env('GPU_API_ID'),
        'api_key' => env('GPU_API_KEY'),
    ],

    'textlocal' => [
        'base_url'         => env('TEXTLOCAL_BASE_URL'), // Now fetching from .env
        'api_key'          => env('TEXTLOCAL_API_KEY'),
        'sender'           => env('TEXTLOCAL_SENDER_NAME'),
        'on_production'    => env('SMS_ON_PRODUCTION', false),
        'expiry_time'      => env('SMS_EXPIRY_TIME', 72),
        'expiry_time_min'      => env('SMS_EXPIRY_TIME_MIN', 5),
        'attempt_block'    => env('SMS_ATTEMPT_BLOCK', 3),
    ],

    'report' => [
        'url_sms' => env('REPORT_URL_SMS'),
    ],


];
