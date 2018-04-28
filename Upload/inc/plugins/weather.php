<?php
/**
 * Provides weather data for use in templates.
 *
 * @author  Kalyn Robinson <dev@shinkarpg.com>
 * @license http://unlicense.org/ Unlicense
 * @version 1.0.0
 */

if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.");
}

require_once MYBB_ROOT . "inc/plugins/weather/hooks.php";
require_once MYBB_ROOT . "inc/plugins/weather/settings.php";

function weather_info()
{
    global $lang;
    $lang->load("weather");

    return array(
        "name" => $lang->weather,
        "description" => $lang->weather_description,
        "website" => "https://github.com/ShinkaDev-MyBB/mybb-weather",
        "author" => "Shinka",
        "authorsite" => "https://github.com/ShinkaDev-MyBB/",
        "version" => "1.0.0",
        "codename" => "weather",
        "compatibility" => "18*",
    );
}

function weather_install()
{
    global $db, $mybb, $lang;

    $gid = $db->insert_query("settinggroups", get_settings_group());

    $settings = get_settings();
    foreach ($settings as $name => $setting) {
        $setting["name"] = $name;
        $setting["gid"] = $gid;

        $db->insert_query("settings", $setting);
    }

    rebuild_settings();
}

function weather_is_installed()
{
    global $mybb;

    return isset($mybb->settings["weather_zip"]);
}

function weather_uninstall()
{
    global $db;

    $settings = array_keys(get_settings());
    $to_delete = array_map(function ($key) {
        return "'" . $key . "'";
    }, $settings);

    $db->delete_query("settings", "name IN (" .
        join(', ', $to_delete)
        . ")");
    $db->delete_query("settinggroups", "name = 'weathergroup'");

    rebuild_settings();
}

function weather_activate()
{}

function weather_deactivate()
{}
