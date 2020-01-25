<?php

namespace console\controllers;

use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $api = JiraHelper::connect();
        JiraHelper::getIssueRelease($api, 'SGN-6304');
//        RocketChatHelper::sendMessage('@Anastasiya-Tester', 'nu privet @Anastasiya-Tester ');
        die;
    }
}
