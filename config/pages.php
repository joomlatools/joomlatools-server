<?php

return array(
    'script_name' => '', //remove index.php

    'cache_path' => getenv('APP_VOLUME').'/sites/'.basename(PAGES_SITE_ROOT).'/cache',
    'log_path'   => getenv('APP_VOLUME').'/sites/'.basename(PAGES_SITE_ROOT).'/log',

    'http_cache' => getenv('APP_CACHE') !== false ? filter_var(getenv('APP_CACHE'), FILTER_VALIDATE_BOOLEAN) : true,
    'http_cache_time'         => '1week',
    'http_cache_time_browser' => '1day',

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

        'assets://css/debugger' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/css/debugger',
        'assets://js/debugger' => 'https://files.joomlatools.com/joomlatools-framework/resources/assets/js/debugger',
    ],

    'extension_path' =>
    [
        PAGES_SITE_ROOT . '/extensions',
        getenv('APP_ROOT').'/extensions',
    ],

    'extension_config' =>
        [
            'ext:sentry.event.subscriber.exception' => [
                'environment' => getenv('SENTRY_ENVIRONMENT') ?: getenv('APP_ENV'),
                'release' => null, //unset
                'scope'   => function(\Sentry\State\Scope $scope)
                {
                    if(getenv('FLY_REGION')) {
                        $scope->setTag('app.region', getenv('FLY_REGION'));
                    }

                    if(getenv('FLY_ALLOC_ID')) {
                        $scope->setTag('app.id', hash('crc32b', getenv('FLY_ALLOC_ID')));
                    }
                }
            ],
        ]
);