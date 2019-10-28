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

    'supportsCredentials' => false,
    'allowedOrigins' => [env('CLIENT_SCHEME', 'http') . '://' . env('CLIENT_HOST', 'localhost') . ':' . env('CLIENT_PORT', '3000')],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
