<?php

namespace console\controllers;

use common\helpers\DateHelper;
use common\helpers\RocketChatHelper;
use console\models\Staff;
use console\models\TimeDaemons;
use yii\console\Controller;
use yii\db\Query;

class EatController extends Controller
{
    public $channel = 'eat';

    public function actionIndex()
    {
        if (DateHelper::isWeekend(date('Y-m-d H:i:s'))) { return 0; }

        $time = '16:20';
        $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в '.$time.', нужно всем успеть до этого времени.
           [Таблица еды](https://docs.google.com/spreadsheets/d/1FCC-JUso0_t80OZyGKJ7ZQFZ1T90pQkm612-asNnbpM).
           А так же, если вы вдруг заболели или не придете на следующий день, то пожалуйста, убери свой заказ.';
        RocketChatHelper::sendMessage($this->channel, $message);
        return 0;
    }
}
