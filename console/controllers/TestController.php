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

        $date = date('Y-m-d');
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

        if (!empty($temp)) RocketChatHelper::sendMessage('overflow_cold_wallets', 'Дежурные сегодня:'.$temp);

        var_dump($temp);
    }
}
