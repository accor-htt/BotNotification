<?php

namespace console\controllers;

use yii\console\Controller;
use common\helpers\DateHelper;
use common\helpers\RocketChatHelper;

class EatController extends Controller
{
    public $channel         = 'eat';
    public $second_channel  = 'general-enisejskaya';

    public function actionIndex()
    {
        if (DateHelper::isWeekend(date('Y-m-d H:i:s'))) { return 0; }

        $time = '16:20';
        $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в '.$time.', нужно всем успеть до этого времени.
           [Таблица еды](https://docs.google.com/spreadsheets/d/1FCC-JUso0_t80OZyGKJ7ZQFZ1T90pQkm612-asNnbpM).
           А так же, если вы вдруг заболели или не придете на следующий день, то пожалуйста, убери свой заказ.';
        RocketChatHelper::sendMessage($this->channel, $message);
        sleep(5);
        RocketChatHelper::sendMessage($this->second_channel, $message);
        return 0;
    }
}
