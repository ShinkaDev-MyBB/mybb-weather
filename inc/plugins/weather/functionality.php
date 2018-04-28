<?php

function weather_get()
{
    $api_key = weather_get_setting_value('api_key');
    $zip = weather_get_setting_value('zip');
    $country = weather_get_setting_value('country');

    if (!($api_key && $zip && $country)) {
        return false;
    }

    if (!weather_check_cache($zip, $country, $api_key)) {
        return weather_get_cached();
    }

    $url = weather_build_url($zip, $country, $api_key);
    $weather = weather_send_request($url);
    weather_update_cache($weather, $zip, $country, $api_key);

    return $weather;
}

function weather_build_url($zip, $country, $api_key)
{
    return "http://api.openweathermap.org/data/2.5/weather?zip={$zip},{$country}&units=metric&APPID={$api_key}";
}

function weather_send_request($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}

function weather_get_setting_value($name)
{
    global $mybb;
    return $mybb->settings['weather_' . $name];
}

function weather_update_cache($response, $zip, $country, $api_key)
{
    global $cache;

    $weather = $cache->read('weather');
    $weather = !$weather ? array() : $weather;
    $weather['settings'] = array(
        'api_key' => $api_key,
        'zip' => $zip,
        'country' => $country,
    );
    $weather['response'] = $response;
    $weather['time'] = time();
    $cache->update('weather', $weather);
}

/**
 * @return boolean `true` if cache should be invalidated
 */
function weather_check_cache($zip, $country, $api_key)
{
    global $cache;

    $weather = $cache->read('weather');

    if (!$weather) {
        return true;
    }

    $ONE_HOUR = 3600;
    return (
        (!isset($weather['time']) || $weather['time'] < time() - $ONE_HOUR) ||
        $weather['settings']['api_key'] != $api_key ||
        $weather['settings']['zip'] != $zip ||
        $weather['settings']['country'] != $country
    );
}

function weather_get_cached()
{
    global $cache;
    $weather = $cache->read('weather');
    return $weather['response'];
}
