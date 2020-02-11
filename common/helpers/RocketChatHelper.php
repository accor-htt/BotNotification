<?php

namespace common\helpers;

use RocketChat\Channel;
use RocketChat\User;

class RocketChatHelper
{
    public static function sendMessage($channel, $message)
    {
        if (!defined('REST_API_ROOT')) {
            define('REST_API_ROOT', '/api/v1/');
        }

        if (!defined('ROCKET_CHAT_INSTANCE')) {
            define('ROCKET_CHAT_INSTANCE', \Yii::$app->params['rocketServer']);
        }
        try {
            $username = \Yii::$app->params['rocketLogin'];
            $password = \Yii::$app->params['rocketPass'];
            $user     = new User($username, $password);

            $user->login();
            $channel = new Channel($channel);

            $channel->postMessage($message);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
