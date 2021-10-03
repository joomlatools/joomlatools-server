<?php

/**
 * Load application configuration
 */
$config = array();
$config['secret'] = getenv('APP_NONCE');

$files  = array(
    'koowa/default.php',
    'koowa/'.getenv('KOOWA_ENV').'.php'
);

foreach($files as $file)
{
    if (file_exists(__DIR__ .'/'. $file)) {
        $config = array_merge($config, require __DIR__ .'/'. $file);
    }
}

return $config;
