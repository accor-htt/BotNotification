<?php

namespace console\controllers;

use common\helpers\CurlHelper;
use common\helpers\DateHelper;
use console\models\Staff;
use console\models\TimeDaemons;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use yii\console\Controller;
use common\helpers\RocketChatHelper;

class EntertainmentController extends Controller
{
    public $channel = 'entertainment';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        $url     = getenv('TABLE_DATA_STAFF');
        $csv     = file_get_contents($url);
        $staff   = CurlHelper::csvStringToArray($csv);
        $dateNow = date('m-d');

        $url        = "http://pozdravlala.ru/gen";
        $value      = "[1,0,1,0,0]";
        $httpClient = new Client();
        $response   = ($httpClient->post($url, [RequestOptions::BODY => $value]))->getBody();
        $str        = CurlHelper::clearStrDayBirthday(CurlHelper::decodeUnicodeEscape($response));
        var_dump($str);
        die;

        $message = 'Сегодня у нас праздник! День рождение! ' . $data[1] . ', принимай поздравление. 
        А лично от себя я тоже хочу тебя поздравить и поделюсь с тобой кусочком своей мудрости. Слушай: ' . $message2;

        foreach ($staff as $data) {
            if (date('m', strtotime($data[2])) == 5) {
                var_dump($data);
            }
        }

//        foreach ($birthday as $birth) {
//            if (date('m-d', strtotime($birth['date_birthday'])) == $dateNow) {
//                $name = explode(' ', $birth['username']);
//                $url = "https://slogen.ru/ajax/slogan.php?type=1&word=" . $name[1];
//                $client = new \GuzzleHttp\Client();
//                $response = $client->get($url);
//                $message2 = (string)$response->getBody();
//                $message = 'Сегодня у нас праздник! День рождение! ' . $birth['rocket_chat_id'] . ', принимай поздравление.
//                       А лично от себя я тоже хочу тебя поздравить и поделюсь с тобой кусочком своей мудрости. Слушай: ' . $message2;
//                RocketChatHelper::sendMessage($this->channel, $message);
//                sleep(30);
//            }
//        }
    }

    public function actionCoursesAndBooks()
    {
        $time = '15:00:00';
        $daemon = 'course_book_daemon';
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

            RocketChatHelper::sendMessage($this->channel, $message3);
            sleep($this->twenty_four_hours * 30);
        }
    }

    public function actionFactDay()
    {
        if (DateHelper::isWeekend(date('Y-m-d'))) { return 0; }
        $count = Staff::find()->count();
        $rand = rand(0, $count - 1);
        $nameVictim = Staff::find()->asArray()->all()[$rand]['username'];

        if (empty($nameVictim)) {
            $rand = rand(0, $count);
            $nameVictim = Staff::find()->asArray()->all()[$rand]['username'];
        }

        $url = "https://slogen.ru/wp-content/themes/homkartath/ajax/slogan.php?type=2&word=" . $nameVictim;
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $message2 = (string)$response->getBody();
        RocketChatHelper::sendMessage("faq_dnya", $message2);
    }

    public function actionHappyDay()
    {
        while (true) {
            var_dump('start');
            $date = DateHelper::getTime();
            $course = number_format(mt_rand(18.55*1000000,20.00*1000000)/1000000, 2);

            $url = [
                '0' => 'http://umorili.herokuapp.com/api/get?site=bash.im&name=bash&num=100',
                '1' => 'http://umorili.herokuapp.com/api/get?site=anekdot.html&name=new+anekdot&num=100'
            ];

            $client = (array)CurlHelper::connection($url[rand(0,1)]);
            $joke = strip_tags($client[ rand(1,25)]->elementPureHtml);

            $url2 = 'https://ignio.com/r/export/utf/xml/daily/com.xml';
            $client = new \GuzzleHttp\Client();
            $response = $client->get($url2);
            $message = $response->getBody();
            $message = new \SimpleXMLElement($message);
            $goroscope = ((array)$message->aries->today)[0];

            if (DateHelper::isWeekend(date('Y-m-d'))) {
                var_dump('today weekend');
                sleep($this->twenty_four_hours);
                continue;
            }
            $message =  strip_tags("
                                         Доброе утро! 
                                         Сегодня {$date}, 
                                         курс PRIZM на данный момент: {$course}, 
                                         и это ли не повод улыбнуться. Удачного рабочего дня :). 
                                         А также вот гороскоп для всех призмавчан и роевцев: {$goroscope}
                                         ");

            $jokeMessage = "Забыл про шутку: 
            {$joke}";
            RocketChatHelper::sendMessage($this->channel, $message);
            sleep(5);
            RocketChatHelper::sendMessage($this->channel, $jokeMessage);
            var_dump('sleep');
            sleep($this->twenty_four_hours);
        }
    }

    public function actionReport()
    {
        if (DateHelper::isWeekend(date('Y-m-d'))) {
            return 0;
        }
        $ids = [264, 240, 245, 226, 237, 229, 265, 266, 239, 256, 255, 232, 233, 247, 236, 267, 228, 244, 252, 262, 268, 225, 246, 273];
        $text = "Привет! Собираю ежедневный отчет : Над чем сейчас работаешь? Ответ писать @koltays-anastasia до 11:50. Отличного настроения и хорошего дня ☺";
        $staff = Staff::find()
            ->select('rocket_chat_id')
            ->where(['IN', 'id', $ids])
            ->asArray()
            ->all();
        foreach ($staff as $key) {
            RocketChatHelper::sendMessage(trim($key['rocket_chat_id']), $text);
            sleep(5);
        }
        return 0;
    }
}
