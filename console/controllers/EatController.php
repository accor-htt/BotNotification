<?php

namespace console\controllers;

use console\helpers\DateHelper;
use console\helpers\RocketChatHelper;
use console\models\Staff;
use console\models\TimeDaemons;
use yii\console\Controller;
use yii\db\Query;

class EatController extends Controller
{
//    public $channel = 'eat';
    public $channel = 'overflow_cold_wallets';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        $time = '16:00:00';
        while (true) {

            $timeN = '16:20';
            $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в '.$timeN.', нужно всем успеть до этого времени.';

            if (DateHelper::isWeekend(date('Y-m-d H:i:s'))) {
                sleep($this->twenty_four_hours);
                continue;
            }

            $dateNow = date('H:i:s', strtotime('+7 hours'));
            $model = TimeDaemons::find()->where(['name' => $this->channel])->asArray()->one();
            if (empty($model)) {


                if (strtotime($time) != strtotime($dateNow)) {
                    $sleep = strtotime($time) - strtotime($dateNow);
                    sleep($sleep);
                }

                RocketChatHelper::sendMessage($this->channel, $message);
                $model = new TimeDaemons();
                $model->name = $this->channel;
                $model->last_time_work = time() + 7 * 3600;
                $model->save();

                sleep($this->twenty_four_hours);
                continue;
            }

            // todo проверку на выключение демона
//            if ($model['last_time_work'])

            $time = '16:20';
            $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в '.$time.', нужно всем успеть до этого времени.
            https://docs.google.com/spreadsheets/d/1FCC-JUso0_t80OZyGKJ7ZQFZ1T90pQkm612-asNnbpM';
            RocketChatHelper::sendMessage($this->channel, $message);
            sleep($this->twenty_four_hours);
        }
    }

    // Дежурные
    public function actionAttendants()
    {
        $time = '10:00:00';
        while (true) {

            $dateNow = date('H:i:s', strtotime('+7 hours'));

            $dateCheck        = date('Y-m-d 00:00:00');

            if (DateHelper::isWeekend($dateCheck)) {
                sleep($this->twenty_four_hours);
                continue;
            }

            $attendantsId = (new Query())->from('Attendants')->where(['date' => $dateCheck])->one()['staff'];

            if (empty($attendantsId)) {
                sleep($this->twenty_four_hours);
                continue;
            }

            $attendantsId = explode(',', trim($attendantsId, '{}'));
            $staff = Staff::find()->andWhere(['IN', 'id', $attendantsId])->asArray()->all();
            $message = 'Обед! Сегодня дежурные. '.$staff[0]['rocket_chat_id'].' '.$staff[1]['rocket_chat_id'].' '.$staff[2]['rocket_chat_id'].'';

            $model = TimeDaemons::find()->where(['name' => $this->channel])->asArray()->one();
            if (empty($model)) {

                if (strtotime($time) != strtotime($dateNow)) {
                    $sleep = strtotime($time) - strtotime($dateNow);
                    sleep($sleep);
                }

                RocketChatHelper::sendMessage($this->channel, $message);
                $model = new TimeDaemons();
                $model->name = $this->channel;
                $model->last_time_work = time() + 7 * 3600;
                $model->save();

                sleep($this->twenty_four_hours);
                continue;
            }


            RocketChatHelper::sendMessage($this->channel, $message);
            sleep($this->twenty_four_hours);
        }
    }
}
