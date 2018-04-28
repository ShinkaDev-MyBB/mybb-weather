<?php

function get_settings_group()
{
    global $lang;

    $lang->load('weather');
    return array(
        "name" => "weathergroup",
        "title" => $lang->weather_settings_title,
        "description" => $lang->weather_settings_description,
        "disporder" => 5,
        "isdefault" => 0,
    );
}

function get_settings()
{
    global $lang;

    if (!$lang->weather) {
        $lang->load('weather');
    }

    return array(
        "weather_api_key" => array(
            "title" => $lang->weather_api_key,
            "description" => $lang->weather_api_key_description,
            "optionscode" => "text",
            "value" => "",
            "disporder" => 1,
        ),
        "weather_zip" => array(
            "title" => $lang->weather_zip_code,
            "description" => $lang->weather_zip_code_description,
            "optionscode" => "text",
            "value" => "",
            "disporder" => 2,
        ),
        "weather_country" => array(
            "title" => $lang->weather_country,
            "description" => $lang->weather_country_description,
            "optionscode" => "text",
            "value" => "",
            "disporder" => 3,
        ),
    );
}
