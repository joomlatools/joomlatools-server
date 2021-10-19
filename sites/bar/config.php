<?php

return [

    'cache_path' => getenv('APP_VOLUME').'/bar/cache',
    'log_path'   => getenv('APP_VOLUME').'/bar/log',
    'base_path'  => '/', //default site

    'aliases' => [
        'theme://'  => 'base://theme/',
        'images://' => 'base://images/',
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
