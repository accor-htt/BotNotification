<?php

namespace console\controllers;

use console\helpers\DateHelper;
use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
//        $nameVictim = Staff::find()->where(['id' => 239])->asArray()->all();
//        var_dump($nameVictim);

//        setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
//        echo strftime("%d %B, %Y", time());

        var_dump(DateHelper::getTime());


//        $date = date('2020-01-27');
//        var_dump((new \console\helpers\DateHelper)->isWeekend($date));
    }
}
