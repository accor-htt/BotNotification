<?php

namespace console\helpers;

class DateHelper
{
    public static function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    public static function getTime()
    {
        // Вывод даты на русском
        $monthes = array(
            1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
            5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
            9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
        );

        $days = array(
            'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
            'Четверг', 'Пятница', 'Суббота'
        );
        return ($days[(date('w'))].','.date('d ') . $monthes[(date('n'))] . date(' Y'));
    }
}
