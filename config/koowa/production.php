<?php
/* Production */
ini_set('display_errors', 0);

require_once dirname(__DIR__).'/sentry.php';

return [
    'sitename'   => 'Joomlatools Server',
    'caching'    => 1,

    'mailer'     => 'smtp',
    'smtphost'   => '',
    'smtpport'   => '',
    'smtpauth'   => '',
    'smtpuser'   => '',
    'smtppass'   => ''
];