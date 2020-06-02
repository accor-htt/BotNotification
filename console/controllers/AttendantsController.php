<?php

namespace console\controllers;

use common\helpers\CurlHelper;
use common\helpers\DateHelper;
use common\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class AttendantsController extends Controller
{
    public function actionOffice($number_office)
    {
        $url     = getenv('TABLE_ATTENDANTS_OFFICE_'.$number_office);
        $csv     = file_get_contents($url);
        $staff   = CurlHelper::csvStringToArray($csv);

        $date = date('d.m.Y');
        if (DateHelper::isWeekend($date)) {
            return 0;
        }

        $attendats = '';

        $iteration = 0;
        foreach($staff as $item)
        {
            if ($item[2] == $date) {

                if ($iteration >= 1) {
                    $attendats .= ', '.$item[1];
                } else {
                    $attendats .= $item[1];
                }

                $iteration++;
            }
        }

        $channel = $this->getChannel($number_office);

        if (!empty($attendats)) {
            RocketChatHelper::sendMessage('overflow_cold_wallets', '@all, Дежурные сегодня:'.$temp);
        }
    }

    private function getChannel($number_office)
    {
        $number_office = --$number_office;

        $channel = [
            'eat',
            'kakto-tam'
        ];

        return $channel[$number_office];
    }
}