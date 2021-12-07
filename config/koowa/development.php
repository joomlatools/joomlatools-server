<?php
/* Development */
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// Set environment config
return [
    'sitename'   => 'Joomlatools Server [development]',
    'caching'    => 0,

    //Use Mailhog on http://localhost:8025
    'mailer'    => 'smtp',
    'smtphost'  => 'host.docker.internal',
    'smtpport'  => '1025',
];