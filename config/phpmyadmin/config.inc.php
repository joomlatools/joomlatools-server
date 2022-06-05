<?php
/**
 * phpMyAdmin sample configuration, you can use it as base for
 * manual configuration. For easier setup you can use setup/
 *
 * All directives are explained in documentation in the doc/ folder
 * or at <https://docs.phpmyadmin.net/>.
 */

declare(strict_types=1);

// Logo link back to Dashboard
$cfg['NavigationLogoLink'] = 'http://localhost';

// Theme
$cfg['ThemeDefault'] = 'bootstrap';

// Theme selector on front page
$cfg['ThemeManager'] = false;

// Disable recent tables button
$cfg['NumRecentTables'] = '0';

// Disable favourite tables button
$cfg['NumFavoriteTables'] = '0';

// Disable the server select box
$cfg['NavigationDisplayServers'] = false;