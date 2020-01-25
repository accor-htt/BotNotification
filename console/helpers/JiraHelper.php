<?php

namespace console\helpers;

use JiraClient\JiraClient;

class JiraHelper
{
    public static function connect()
    {
        $username = \Yii::$app->params['jiraLogin'];
        $password = \Yii::$app->params['jiraPass'];
        $server   = \Yii::$app->params['jiraServer'];
        $api = new JiraClient($server, $username, $password);
        // https://sigencore.atlassian.net/rest/api/2/search?jql=project%20=%20%22SGN%22%20AND%20resolution%20=%20Unresolved%20ORDER%20BY%20priority%20DESC
        $request = $api->call('GET', '/issue/SGN-3319');
        $data = $request->getData()['fields']['comment']['comments'];
        foreach ($data as $key => $comment) {
            echo('['.$key.']'.$comment['body'].PHP_EOL);
        }
    }
}
