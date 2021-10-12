<?php
ini_set('error_reporting', E_ERROR | E_PARSE);

return [

    /* Site */
    'sitename'   => 'Joomlatools Server',
    'list_limit' => '20',

    /* Locale */
	'offset'     => 'UTC',
	'language'   => 'en-GB',

	/* Mail */
    'mailer'     => 'mail',
    'mailfrom'   => 'noreply@joomlatools.com',
    'fromname'   => 'Joomlatools',
    'sendmail'   => '/usr/sbin/sendmail',
    'smtpauth'   => '0',
    'smtpuser'   => '',
    'smtppass'   => '',
    'smtphost'   => 'localhost',
    'smtpsecure' => 'none',

	/* Cache */
	'caching'     => getenv('APP_CACHE') !== false ? filter_var( getenv('APP_CACHE') , FILTER_VALIDATE_BOOLEAN) : true,
    'lifetime'    => '15',

	/* Debug */
    'debug'       => getenv('APP_DEBUG') !== false ? filter_var( getenv('APP_DEBUG') , FILTER_VALIDATE_BOOLEAN) : false,
];
