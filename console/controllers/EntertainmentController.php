<?php

namespace console\controllers;

use console\helpers\CurlHelper;
use console\models\Staff;
use console\models\TimeDaemons;
use yii\console\Controller;
use console\helpers\RocketChatHelper;
use yii\helpers\HtmlPurifier;

class EntertainmentController extends Controller
{
//    public $channel = 'entertainment';
    public $channel = 'overflow_cold_wallets';
    public $twenty_four_hours = 86400;

    public function actionIndex()
    {
        $time = '11:00:00';
        $daemon = 'birthday_daemon';
        while(true) {

            $dateNow        = date('m-d');
            $currentYear    = date('Y');
            $birthday = Staff::find()->asArray()->all();

            $dateNow = date('H:i:s', strtotime('+7 hours'));
            $model = TimeDaemons::find()->where(['name' => $daemon])->one();
            if (empty($model)) {

                if (strtotime($time) != strtotime($dateNow)) {
                    $sleep = strtotime($time) - strtotime($dateNow);
                    var_dump($sleep);
                    sleep($sleep);
                }

                if ( !empty($birthday)) {
                    foreach ($birthday as $birth) {
                        if (date('m-d', strtotime($birth['date_birthday'])) == $dateNow) {
                            $name = explode(' ', $birth['username']);
                            $url = "https://slogen.ru/ajax/slogan.php?type=1&word=".$name[1];
                            $client = new \GuzzleHttp\Client();
                            $response = $client->get($url);
                            $message2 = (string)$response->getBody();
                            $message = 'Сегодня у нас праздник! День рождение! '.$birth['rocket_chat_id'].', принимай поздравление. 
                        А лично от себя я тоже хочу тебя поздравить и поделюсь с тобой кусочком своей мудрости. Слушай: '.$message2;
                            RocketChatHelper::sendMessage($this->channel, $message);
                            sleep(30);
                        }
                    }
                }

                $model = new TimeDaemons();
                $model->name = $daemon;
                $model->last_time_work = time() + 7 * 3600;
                sleep($this->twenty_four_hours);
                continue;
            }

            if ( !empty($birthday)) {
                foreach ($birthday as $birth) {
                    if (date('m-d', strtotime($birth['date_birthday'])) == $dateNow) {
                        $name = explode(' ', $birth['username']);
                        $url = "https://slogen.ru/ajax/slogan.php?type=1&word=".$name[1];
                        $client = new \GuzzleHttp\Client();
                        $response = $client->get($url);
                        $message2 = (string)$response->getBody();
                        $message = 'Сегодня у нас праздник! День рождение! '.$birth['rocket_chat_id'].', принимай поздравление. 
                        А лично от себя я тоже хочу тебя поздравить и поделюсь с тобой кусочком своей мудрости. Слушай: '.$message2;
                        RocketChatHelper::sendMessage($this->channel, $message);
                        sleep(30);
                    }
                }
            }
            sleep($this->twenty_four_hours);
        }
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
        while (true) {

            $count = Staff::find()->count();
            $rand = rand(0, $count - 1);

            $nameVictim = Staff::find()->asArray()->all()[$rand]['username'];

            if (empty($nameVictim)) {
                $rand = rand(0, $count);
                $nameVictim = Staff::find()->asArray()->all()[$rand]['username'];
            }

            var_dump($nameVictim);
            $url = "https://slogen.ru/ajax/slogan.php?type=2&word=" . $nameVictim;

            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);

            $message2 = (string)$response->getBody();
            RocketChatHelper::sendMessage("faq_dnya", $message2);
            sleep($this->twenty_four_hours);
        }
    }

    public function actionHappyDay()
    {
        while (true) {
            $date = (date('l \t\h\e jS'));
            $course = number_format(mt_rand(15.1*1000000,16.7*1000000)/1000000, 2);
            $url = [
                '0' => 'http://umorili.herokuapp.com/api/get?site=bash.im&name=bash&num=100',
                '1' => 'http://umorili.herokuapp.com/api/get?site=anekdot.html&name=new+anekdot&num=100'
            ];

            $client = (array)CurlHelper::connection($url[rand(0,1)]);
            $joke = strip_tags($client[ rand(1,25)]->elementPureHtml);
            $message =  strip_tags("Доброе утро! <br />Сегодня {$date}, курс PRIZM на данный момент: {$course}, а жизнь все еще прекрасна и удивительна. Удачной работы и вот вам шутка дня: {$joke}");
            RocketChatHelper::sendMessage($this->channel, $message);
            var_dump('sleep');
            sleep($this->twenty_four_hours);
        }
    }
}
