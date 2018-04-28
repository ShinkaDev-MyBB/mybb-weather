<?php

require_once MYBB_ROOT . "inc/plugins/weather/functionality.php";

$plugins->add_hook("index_start", "weather_index");
function weather_index()
{
    global $weather;
    $weather = weather_get();
}
