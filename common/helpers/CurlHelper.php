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
//        $data = json_decode($output);
        curl_close($connection);
        return $output;
    }

    static function csvStringToArray($csv)
    {
        $lines = explode(PHP_EOL, $csv);
        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }
        return $array;
    }

    // How decode Unicode escape sequences like “\u00ed” to proper UTF-8 encoded characters

    static function decodeUnicodeEscape($str)
    {
        return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $str);
    }

    static function clearStrDayBirthday($str)
    {
        return trim(str_replace(['"text":', '{', '}', '"'], '', $str));
    }
}
