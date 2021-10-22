<?php

return array(
    'http_cache' => getenv('APP_CACHE') !== false ? filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN) : true,
    'http_cache_time'         => '1week',
    'http_cache_time_browser' => '1day',

    'http_static_cache'    => false,
    'http_client_cache'    => getenv('APP_CACHE') !== false ? filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN) : true,

    //'page_cache_validation'     => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),
    //'template_cache_validation' => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),
    //'data_cache_validation'     => filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN),

    //See: https://www.owasp.org/index.php/OWASP_Secure_Headers_Project#xpcdp
    'headers' => [
        'Strict-Transport-Security' => getenv('APP_ENV') == 'production' ? 'max-age=63072000;' : null,
        'X-Xss-Protection'          => '1; mode=block',
        'X-Frame-Options'           => 'DENY',
        'Feature-Policy'            => "camera 'none'; microphone 'none'",
        'Referrer-Policy'           => 'strict-origin-when-cross-origin',
        'X-Permitted-Cross-Domain-Policies' => 'none',
        'Content-Security-Policy'   => in_array(getenv('APP_ENV'), ['production', 'staging']) ? 'upgrade-insecure-requests' : null,
        'X-Content-Type-Options'    => 'nosniff',
    ],

    'aliases' => [
        'theme://'  => 'base://theme/',
        'images://' => 'base://images/',

        'media://koowa/framework/css/debugger.css' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/css/debugger.min.css',
        'media://koowa/framework/js/debugger.js' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/js/debugger.min.js',
    ],

    'url_prefix' => '', //remove index.php

    'extension_path' =>
    [
        PAGES_SITE_ROOT . '/extensions',
        KOOWA_ROOT.'/extensions',
    ],
);