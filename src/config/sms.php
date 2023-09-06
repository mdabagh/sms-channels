<?php

return [
    'driver_active' => env('MSM_DRIVE_ACTIVE', 'mrapi'),

    'mrapi' => [
        'authentication' =>env('MRAPI_AUTHENTICATION'),
        'token' =>env('MRAPI_TOKEN'),
        'patternid' =>env('MRAPI_PATTERNID'),
    ],

    'kavenegar' => [
        'api_key' => env('KAVENEGAR_API_KEY'),
        'template' => env('KAVENEGAR_TEMPLATE'),
    ]


];