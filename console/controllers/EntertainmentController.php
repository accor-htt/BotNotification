<?php

namespace console\controllers;

use console\helpers\CurlHelper;
use console\models\Staff;
use http\Client;
use yii\console\Controller;
use console\helpers\RocketChatHelper;

class EntertainmentController extends Controller
{
//    public $channel = 'entertainment';
    public $channel = 'overflow_cold_wallets';
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

    public function actionCoursesAndBooks()
    {
        while(true)
        {
            $message1 = '@all, Внимание! 
            Для закупки книг в офис или оплаты ваших профессиональных курсов до 10 числа вам нужно оставить заявку в таблице 
            https://docs.google.com/spreadsheets/d/1Pz0eAphG-IescdNte24KuTQqkNbNw76guHXs_ZzneCk/edit#gid=0';

            RocketChatHelper::sendMessage($this->channel, $message1);
            sleep(60);

            $message2 = '@all, Внимание! 
            Для закупки книг в офис или оплаты ваших курсов до 10 числа вам нужно оставить заявку в таблице: 
            https://docs.google.com/spreadsheets/d/13aqwuDFBDJO-eoHOQDHTd85HDXdp3pp9D8oH_B75coE/edit#gid=0';

            RocketChatHelper::sendMessage($this->channel, $message2);
            sleep(60);

            $message3 = '@all, Внимание! 
            Для закупки оплаты ваших занятий по творческому направлению до 15 числа вам нужно оставить заявку в таблице 
            https://docs.google.com/spreadsheets/d/1vZdAIcHrwHowJNQHwwYdeferTIDy8rbeMw_hhaQg9qM/edit#gid=0';

            RocketChatHelper::sendMessage($this->channel, $message2);
            sleep($this->twenty_four_hours * 30);
        }
    }

    public function actionFactDay()
    {
        while (true) {

            $count = Staff::find()->count();
            $rand = rand(0, $count);

            $nameVictim = Staff::find()->asArray()->all()[$rand]['username'];

            var_dump($nameVictim);
            $url = "https://slogen.ru/ajax/slogan.php?type=2&word=" . $nameVictim;

            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);

            $message2 = (string)$response->getBody();
            RocketChatHelper::sendMessage("faq_dnya", $message2);
            sleep($this->twenty_four_hours);
        }
    }
}
