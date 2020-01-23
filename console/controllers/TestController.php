<?php

namespace console\controllers;

use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(111);
        var_dump(getenv('DB_USERNAME'));
        $a = \console\helpers\RocketChatHelper::getNewUsers();
        var_dump($a);
        die;
    }
}
