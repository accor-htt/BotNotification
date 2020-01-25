<?php

namespace console\controllers;

use console\models\Channels;
use console\helpers\RocketChatHelper;
use console\models\TimeDaemons;
use yii\console\Controller;

class EnglishController extends Controller
{
//    public $channel = 'english';
    public $channel = 'overflow_cold_wallets';

    public function actionIndex()
    {
        while(true) {

            $dateNow =

            $model = TimeDaemons::find()->where(['name' => $this->channel])->one();
            if (empty($model)) {
                $model = new TimeDaemons();
                $model->name = $this->channel;
                $model->last_time_work = time();
            }

            $message = '@all, Завтра вечером будет английский, не забудьте сегодня сделать домашнюю работу.
            Ссылка на задания: https://drive.google.com/drive/folders/1uOKONwT3E2rY3VmLnIT1dtNU2zesDQ4q?usp=sharing';
            RocketChatHelper::sendMessage($this->channel, $message);
            sleep(7200);
        }
    }
}
