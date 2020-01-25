<?php

namespace console\helpers;

class DateHelper
{
    public static function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
}
