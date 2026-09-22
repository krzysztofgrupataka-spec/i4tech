<?php

return [
    'paths' => [
        get_theme_file_path('resources/views'),
    ],
    'compiled' => wp_upload_dir()['basedir'] . '/cache/acorn/views',
];
