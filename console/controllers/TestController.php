<?php

namespace console\controllers;

use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
//        JiraHelper::connect();
        RocketChatHelper::sendMessage('overflow_cold_wallets', 'privet @Anastasiya-Tester ');
        die;
    }
}
