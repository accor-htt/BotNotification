<?php

namespace console\controllers;

use common\helpers\DateHelper;
use yii\console\Controller;
use common\helpers\RocketChatHelper;

class EnglishController extends Controller
{
    public $channel = 'entertainment';

    public function actionIndex()
    {
        $date = date('Y-m-d');
        if (DateHelper::isWeekend($date)) {
            return false;
        }

        $message = '@all, Hello. Напоминаю, что сегодня у нас английский в 17:00 и 18:00';
        RocketChatHelper::sendMessage($this->channel, $message);
    }
}
