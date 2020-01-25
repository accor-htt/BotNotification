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
        $t = JiraHelper::getIssueRelease($api, 'SGN-6304');
        foreach ($t as $j) {
            if (stristr($j['body'], '(flag)')) {
                var_dump(date('Y-m-d H:i:s', strtotime($j['created'])));
            }
        }
//        RocketChatHelper::sendMessage('@Anastasiya-Tester', 'nu privet @Anastasiya-Tester ');
        die;
    }
}
