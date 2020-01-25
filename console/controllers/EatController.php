<?php

namespace console\controllers;

use console\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;
use yii\db\Query;

class EatController extends Controller
{
    public $channel = 'eat';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        while (true) {
            $time = '16:20';
            $message = 'Ребята, не забудьте заказать еду! Заказ будет отправлен в'.$time.', нужно всем успеть до этого времени.';
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
