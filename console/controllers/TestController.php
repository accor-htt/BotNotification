<?php

namespace console\controllers;

use app\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(111);
        var_dump(getenv('DB_USERNAME'));
        var_dump(RocketChatHelper::getNewUsers());
        die;
    }
}
