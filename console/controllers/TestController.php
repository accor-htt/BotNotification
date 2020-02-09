<?php

namespace console\controllers;

use console\helpers\CurlHelper;
use console\helpers\DateHelper;
use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $url = 'https://ignio.com/r/export/utf/xml/daily/com.xml';
//        $client = new \GuzzleHttp\Client();
//        $response = $client->get($url);
//        $message = $response->getBody();
//        $message = new \SimpleXMLElement($message);
//        var_dump((array)$message->aries->today);

        die;
    }
}
