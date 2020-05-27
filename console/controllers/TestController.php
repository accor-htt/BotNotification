<?php

namespace console\controllers;

use common\helpers\DateHelper;
use common\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $name = '/Дежурные.csv';
        $runtime    = \Yii::getAlias('@runtime');
        $allPath    = $runtime . $name;
        $csv        = array_map('str_getcsv', file($allPath));

        $date = date('d.m.Y');
//        $date = "20.03.2020";

        if (DateHelper::isWeekend($date)) {
            return 0;
        }

        $staff = Staff::find()->select('username, rocket_chat_id')->asArray()->all();

        $staff = array_map(function($value){
            $temp = explode(' ',trim($value['username']));
            $value['username'] = $temp[0].' '.$temp[1];
            $value['username'] = trim($value['username']);
            return $value;
        }, $staff);

        $attendats = [];

        foreach($csv as $key => $item)
        {
            if ($item[1] == $date) {
                $attendats[] = $item[0];
            }
        }

        $temp = '';
        $a = [];

        foreach ($attendats as $person)
        {
            foreach ($staff as $s) {
                if (trim($s['username']) == trim($person)) {
                    $a[] = $person;
                    $temp = $temp.' '.$s['rocket_chat_id'];
                    break;
                }
            }
        }

        if (!empty($temp)) RocketChatHelper::sendMessage('eat', '@all, Дежурные сегодня:'.$temp);

        var_dump($temp);
    }

    public function actionTest()
    {
        $ids = [264, 240, 245, 226, 237, 229, 265, 266, 239, 256, 255, 232, 233, 247, 236, 267, 228, 244, 252, 262, 268, 225, 246, 273];
        $text = "Привет! Собираю ежедневный отчет : Над чем сейчас работаешь? Ответ писать @koltays-anastasia до 11:50. Отличного настроения и хорошего дня ☺";
        $staff = Staff::find()
            ->select('rocket_chat_id')
            ->where(['IN', 'id', $ids])
            ->asArray()
            ->all();
        var_dump($staff[22]);
        RocketChatHelper::sendMessage(trim($staff[22]['rocket_chat_id']), 'Раз раз раз, проверка');
    }
}
