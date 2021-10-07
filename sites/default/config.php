<?php
return [

    'cache_path' => getenv('APP_VOLUME').'/default/cache',
    'log_path'   => getenv('APP_VOLUME').'/default/log',

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
