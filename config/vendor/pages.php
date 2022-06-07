<?php
ini_set('display_errors', getenv('APP_DEBUG'));

return array(
    'environment' => getenv('APP_ENV'),
    'script_name' => '', //remove index.php

    'cache_path'     => getenv('APP_VOLUME').'/sites/'.basename(PAGES_SITE_ROOT).'/cache',
    'log_path'       => getenv('APP_VOLUME').'/sites/'.basename(PAGES_SITE_ROOT).'/log',

    'http_cache' => getenv('APP_CACHE') !== false ? filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN) : true,
    'http_cache_time'         => '1week',
    'http_cache_time_browser' => '1day',

    'http_client_cache'    => getenv('APP_CACHE') !== false ? filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN) : true,

    //'page_cache_validation'     => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),
    //'template_cache_validation' => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),
    //'data_cache_validation'     => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),

    'aliases' => [
        'theme://'  => 'base://theme/',
        'images://' => 'base://images/',

        'assets://css/debugger' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/css/debugger',
        'assets://js/debugger' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/js/debugger',
    ],
);