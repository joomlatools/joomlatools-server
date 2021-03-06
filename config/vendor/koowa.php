<?php

return [

    /* Site */
    'sitename'   => 'Joomlatools Server',
    'list_limit' => '20',

    /* Locale */
    'offset'     => 'UTC',
    'language'   => 'en-GB',

    /* Mail */
    'mailer'    => 'smtp',
    'mailfrom'   => 'norepl@localhost.home',
    'fromname'   => 'Joomlatools',
    'sendmail'   => '/usr/sbin/sendmail',
    'smtpauth'   => '0',
    'smtpuser'   => '',
    'smtppass'   => '',
    'smtphost'  => 'host.docker.internal',
    'smtpport'  => '1025',
    'smtpsecure' => 'none',

    /* Cache */
    'caching'     => getenv('APP_CACHE') !== false ? filter_var( getenv('APP_CACHE') , FILTER_VALIDATE_BOOLEAN) : true,
    'lifetime'    => '15',

    /* Debug */
    'debug'       => getenv('APP_DEBUG') !== false ? filter_var( getenv('APP_DEBUG') , FILTER_VALIDATE_BOOLEAN) : false,
    'secret'      =>  getenv('APP_NONCE')
];