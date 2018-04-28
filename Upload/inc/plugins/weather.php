<?php
/**
 * Provides weather data for use in templates.
 *
 * @author  Kalyn Robinson <dev@shinkarpg.com>
 * @license http://unlicense.org/ Unlicense
 * @version 1.0.0
 */

if (!defined('IN_MYBB')) {
    die('You Cannot Access This File Directly. Please Make Sure IN_MYBB Is Defined.');
}

if (defined('IN_ADMINCP')) {
    require_once MYBB_ROOT . 'inc/plugins/weather/install.php';
} else {
    require_once MYBB_ROOT . 'inc/plugins/weather/forum.php';
}
