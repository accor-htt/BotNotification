<?php

namespace console\controllers;

use console\models\Staff;
use yii\console\Controller;
use console\helpers\RocketChatHelper;

class EntertainmentController extends Controller
{
    public $channel = 'entertainment';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        while(true) {

            // todo проверка на первое включение, чтобы уведомление было в 10 утра, а потом каждые 24 часа

            $dateNow        = date('Y-m-d 00:00:00');
            $currentYear    = date('Y');
            $birthday = Staff::find()->where(['date_birthday' => $dateNow])->asArray()->all();

            if ( !empty($birthday)) {
                foreach ($birthday as $birth) {
                    $age = $currentYear - date('Y', strtotime($birth['date_birthday']));
                    $message = 'Сегодня у нас праздник! День рождение!'.$birth['rocket_chat_id'].', принимай поздравление. 
                    А лично от себя я тоже хочу тебя поздравить и поделюсь с тобой кусочком своей мудрости. Слушай: {бред]';
                    RocketChatHelper::sendMessage($this->channel, $message);
                }
            }

            sleep($this->twenty_four_hours);
        }
    }
}
