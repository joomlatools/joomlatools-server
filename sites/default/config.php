<?php
return [

    'cache_path' => getenv('APP_DISK').'/default/cache',
    'log_path'   => getenv('APP_DISK').'/default/log',

    'aliases' => [
        'theme://'  => '/theme/',
        'images://' => '/images/',
    ],

    'redirects' =>  include __DIR__.'/redirects.php',

    'extension_path' =>
    [
        PAGES_SITE_ROOT . '/extensions',
        KOOWA_ROOT.'/extensions',
    ],

    'extension_config'     =>
    [

    ]
];
