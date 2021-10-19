<?php

return [

    'cache_path' => getenv('APP_VOLUME').'/bar/cache',
    'log_path'   => getenv('APP_VOLUME').'/bar/log',
    //'url_prefix' => '/bar',

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
