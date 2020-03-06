<?php

namespace console\controllers;

use Cassandra\Date;
use common\helpers\DateHelper;
use common\helpers\RocketChatHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $date = date('Y-m-d H:i:s');
        var_dump(DateHelper::isEnglishFriday($date));

    }
}
