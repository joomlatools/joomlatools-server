<?php
/* Development */
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

return [
    'sitename'   => 'Joomlatools Server [development]',
    'caching'    => 0,

    //Use https://server.joomlatools.test/mailhog
    'mailer'    => 'smtp',
    'smtphost'  => '127.0.0.1',
    'smtpport'  => '1025',
];