<?php

return [
    'name' => env('APP_NAME', 'i4tech Sage Starter'),
    'env' => env('WP_ENV', 'production'),
    'debug' => (bool) env('WP_DEBUG', false),
    'url' => home_url(),
    'timezone' => get_option('timezone_string') ?: 'UTC',
    'locale' => get_locale(),
];
