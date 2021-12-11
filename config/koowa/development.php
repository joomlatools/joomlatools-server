<?php
/* Development */

// Set environment config
return [
    'sitename'   => 'Joomlatools Server [development]',
    'caching'    => 0,

    //Use Mailhog on http://localhost:8025
    'mailer'    => 'smtp',
    'smtphost'  => 'host.docker.internal',
    'smtpport'  => '1025',
];