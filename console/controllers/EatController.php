<?php

namespace console\controllers;

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

            $dateNow = date('H:i:s', strtotime('+7 hours'));
            $model = TimeDaemons::find()->where(['name' => $this->channel])->one();
            if (empty($model)) {

                if (strtotime($time) != strtotime($dateNow)) {
                    $sleep = strtotime($time) - strtotime($dateNow);
                    sleep($sleep);
                }

                $model = new TimeDaemons();
                $model->name = $this->channel;
                $model->last_time_work = time();

                $time = '16:20';
                $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в'.$time.', нужно всем успеть до этого времени.';
                RocketChatHelper::sendMessage($this->channel, $message);
                sleep($this->twenty_four_hours);
            }

            $time = '16:20';
            $message = '@all Ребята, не забудьте заказать еду! Заказ будет отправлен в'.$time.', нужно всем успеть до этого времени.';
            RocketChatHelper::sendMessage($this->channel, $message);
            sleep($this->twenty_four_hours);
        }
    }

    // Дежурные

    public function actionAttendants()
    {
        while (true) {

            $dateNow        = date('Y-m-d 00:00:00');
            $attendantsId = (new Query())->from('Attendants')->where(['date' => $dateNow])->one()['staff'];
            $attendantsId = explode(',', trim($attendantsId, '{}'));
//            var_dump($attendantsId);
//            die;
            $staff = Staff::find()->andWhere(['IN', 'id', $attendantsId])->asArray()->all();
            var_dump($staff);
//            $message = '';
//            RocketChatHelper::sendMessage($this->channel, $message);
//            sleep($this->twenty_four_hours);
        }
    }
}
