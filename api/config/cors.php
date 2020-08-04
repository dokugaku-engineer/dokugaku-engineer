<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supports_credentials' => true,
    'allowed_origins' => [env('CLIENT_SCHEME', 'http') . '://' . env('CLIENT_URL', 'localhost:3333')],
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Origin'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    'exposed_headers' => [],
    'maxAge' => 0,
    'paths' => ['api/*'],
];
