<?php

return [
    'default' => env('CACHE_DRIVER', 'file'),

    'stores' => [
        'memcached' => [
            'driver' => 'memcached',
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],
    ],

    'prefix' => env('CACHE_PREFIX', 'lumen'),
];