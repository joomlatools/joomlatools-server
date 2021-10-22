<?php

return [

    'cache_path' => getenv('APP_VOLUME').'/bar/cache',
    'log_path'   => getenv('APP_VOLUME').'/bar/log',

    'redirects' =>  include __DIR__.'/redirects.php',

    'extension_config'     =>
    [

    ]
];
