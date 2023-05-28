<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'firebase' => [
            'driver' => 'firebase',
            'credentials' => [
                'type' => env('FIREBASE_CREDENTIALS_TYPE'),
                'project_id' => env('FIREBASE_CREDENTIALS_PROJECT_ID'),
                'private_key_id' => env('FIREBASE_CREDENTIALS_PRIVATE_KEY_ID'),
                'private_key' => str_replace('\\n', "\n", env('FIREBASE_CREDENTIALS_PRIVATE_KEY')),
                'client_email' => env('FIREBASE_CREDENTIALS_CLIENT_EMAIL'),
                'client_id' => env('FIREBASE_CREDENTIALS_CLIENT_ID'),
                'auth_uri' => env('FIREBASE_CREDENTIALS_AUTH_URI'),
                'token_uri' => env('FIREBASE_CREDENTIALS_TOKEN_URI'),
                'auth_provider_x509_cert_url' => env('FIREBASE_CREDENTIALS_AUTH_PROVIDER_CERT_URL'),
                'client_x509_cert_url' => env('FIREBASE_CREDENTIALS_CLIENT_CERT_URL'),
            ],
            'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
