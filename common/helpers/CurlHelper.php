<?php

namespace common\helpers;

class CurlHelper
{
    public static function connection($url)
    {
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($connection, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connection, CURLOPT_HEADER, 0);
        $output     = curl_exec($connection);
        $data = json_decode($output);
        curl_close($connection);
        return $data;
    }

}
