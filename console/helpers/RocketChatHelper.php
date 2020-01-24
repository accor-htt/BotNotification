<?php

namespace console\helpers;

use RocketChat\Channel;
use RocketChat\User;

class RocketChatHelper
{

    public static function sendMessage($channel, $message)
    {
        define('REST_API_ROOT', '/api/v1/');
        define('ROCKET_CHAT_INSTANCE', \Yii::$app->params['rocketServer']);
        try {
            $username = \Yii::$app->params['rocketLogin'];
            $password = \Yii::$app->params['rocketPass'];
            $user     = new User($username, $password);

            var_dump($channel);
            $user->login();
            $channel = new Channel($channel);

            $channel->postMessage($message);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getNewUsers()
    {
        return ['hello_world'];
    }
}
