<?php

namespace console\controllers;

use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        RocketChatHelper::sendMessage('overflow_cold_wallets', ':roma_s:');
    }
}
