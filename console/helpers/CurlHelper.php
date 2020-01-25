<?php


namespace console\helpers;


class CurlHelper
{
    public static function connection($url)
    {

        $connection = curl_init();
        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        $output     = curl_exec($connection);
        curl_close($connection);
        return $output;
    }

}
