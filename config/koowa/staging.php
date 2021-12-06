<?php
/* Staging */
ini_set('display_errors', 1);

return [
    'sitename'   => 'Joomlatools Server [staging]',
    'caching'    => 1,

    //Use https://mailtrap.io
    'mailer'    => 'smtp',
    'smtphost'  => 'smtp.mailtrap.io',
    'smtpport'  => '2525',
    'smtpauth'   => '1',
    'smtpuser'  => getenv('MAILTRAP_USER'),
    'smtppass'  => getenv('MAILTRAP_PASS'),
];