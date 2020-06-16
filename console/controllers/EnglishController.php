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

        $message = '@all, Hello. Напоминаю, сегодня в 18.00 и 19.00 английский язык в конференц-зале на Кирова.';
        RocketChatHelper::sendMessage($this->channel, $message);
    }
}
