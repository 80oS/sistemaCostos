<?php

return [
    'paths' => [
        'build' => 'build',
        'manifest' => public_path('build/manifest.json'),
    ],
    
    'dev_server' => [
        'enabled' => env('VITE_DEV_SERVER_ENABLED', false),
        'url' => env('VITE_DEV_SERVER_URL', 'http://localhost:5173'),
    ],

    'manifest_path' => public_path('build/manifest.json'),
];