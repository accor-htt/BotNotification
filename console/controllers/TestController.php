<?php

namespace console\controllers;

use console\helpers\DateHelper;
use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
//        RocketChatHelper::sendMessage('overflow_cold_wallets', ':roma_s:');
        $date = date('2020-01-27');
        var_dump((new \console\helpers\DateHelper)->isWeekend($date));
    }
}
