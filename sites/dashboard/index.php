<?php
define('KOOWA_ROOT'  , getenv('APP_ROOT'));
define('KOOWA_VENDOR', getenv('APP_DATA').'/vendor');
define('KOOWA_CONFIG', getenv('APP_DATA').'/config/vendor');

require KOOWA_VENDOR.'/joomlatools/pages/resources/pages/bootstrapper.php';