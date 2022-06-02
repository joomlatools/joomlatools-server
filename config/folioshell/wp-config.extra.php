if (getenv('APP_NAME') === 'joomlatools-server' && isset($_SERVER['HTTP_HOST']))
{
    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $_SERVER['HTTPS'] = 'on';
    }

    $scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ($_SERVER['REQUEST_SCHEME'] ?? 'http');
    $host   = $_SERVER['HTTP_HOST'];

    $url = $scheme.'://'.$host . (isset($_SERVER['HTTP_X_SITE_BASE']) ? rtrim($_SERVER['HTTP_X_SITE_BASE'], '/\\') : '');

    define('WP_SITEURL', $url);
    define('WP_HOME', $url);

    require_once ABSPATH . 'wp-includes/plugin.php';

    add_filter('option_siteurl', function($option) {
        return WP_SITEURL;
    });
}