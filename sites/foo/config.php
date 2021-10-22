<?php

return [

    'cache_path' => getenv('APP_VOLUME').'/foo/cache',
    'log_path'   => getenv('APP_VOLUME').'/foo/log',

    'redirects' =>  include __DIR__.'/redirects.php',

    'extension_config'     =>
    [

    ]
];
