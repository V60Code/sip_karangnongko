<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | These settings help optimize the application performance
    |
    */

    'database' => [
        'query_log' => env('DB_QUERY_LOG', false),
        'slow_query_threshold' => env('DB_SLOW_QUERY_THRESHOLD', 1000), // milliseconds
    ],

    'cache' => [
        'views' => env('CACHE_VIEWS', true),
        'config' => env('CACHE_CONFIG', true),
        'routes' => env('CACHE_ROUTES', true),
        'events' => env('CACHE_EVENTS', true),
    ],

    'filament' => [
        'polling_interval' => env('FILAMENT_POLLING_INTERVAL', 60), // seconds
        'pagination_size' => env('FILAMENT_PAGINATION_SIZE', 25),
        'defer_loading' => env('FILAMENT_DEFER_LOADING', true),
    ],

];