<?php

namespace console\controllers;

use common\helpers\DateHelper;
use yii\console\Controller;
use common\helpers\RocketChatHelper;

class EnglishController extends Controller
{
    public $channel = 'declaration';
//    public $channel = 'overflow_cold_wallets';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        while(true) {

            $date = date('Y-m-d');

            if (DateHelper::isWeekend($date)) {
                var_dump('today weekend');
                sleep($this->twenty_four_hours);
                continue;
            }

            if (DateHelper::isEnglishWednesday($date) || DateHelper::isEnglishFriday($date)) {
                $message = '@all, Hello. Напоминаю, что сегодня у нас английский в 17:00 и 18:00
                [Ссылка на задания](https://drive.google.com/drive/folders/1uOKONwT3E2rY3VmLnIT1dtNU2zesDQ4q?usp=sharing)';
                RocketChatHelper::sendMessage($this->channel, $message);
                sleep($this->twenty_four_hours);
            } else {
                var_dump('today not friday or wednesday');
                sleep($this->twenty_four_hours);
                continue;
            }
        }
    }
}
