if (isset($_SERVER['SITE_ROOT']))
{
    $site    = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']), '/');
    $segments = explode('/', $site);

    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $_SERVER['HTTPS'] = 'on';
    }

    $scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ($_SERVER['REQUEST_SCHEME'] ?? 'http');
    $host   = $_SERVER['HTTP_HOST'];

    if($segments && is_dir($_SERVER['SITE_ROOT'].'/'.$segments[0])) {
        $url = $scheme.'://'.$host . '/'. $segments[0];
    } else {
        $url = $scheme.'://'.$host;
    }

    define('WP_SITEURL', $url);
    define('WP_HOME', $url);

    require_once ABSPATH . 'wp-includes/plugin.php';

    add_filter('do_redirect_guess_404_permalink', function($result) {
        return false;
    }, 100000, 1);

    add_filter('option_siteurl', function($option) {
        return WP_SITEURL;
    });

    add_filter('option_home', function($option) {
        return WP_HOME;
    });
}