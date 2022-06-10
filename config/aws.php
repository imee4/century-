<?php

use Aws\Laravel\AwsServiceProvider;
use Aws\S3\S3Client;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. This file
    | is published to the application config directory for modification by the
    | user. The full set of possible options are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
    'credentials' => [
        'key'    => env('AKIAX4WUFPBA2S37PQEU', ''),
        'secret' => env('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', ''),
    ],
    'region' => env('AWS_REGION', 'us-east-1'),
    'version' => 'v4',
    'ua_append' => [
        'L5MOD/' . AwsServiceProvider::VERSION,
    ],
];
