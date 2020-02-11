<?php

namespace common\helpers;

use JiraClient\JiraClient;

class JiraHelper
{
    public static function connect()
    {
        $username = \Yii::$app->params['jiraLogin'];
        $password = \Yii::$app->params['jiraPass'];
        $server   = \Yii::$app->params['jiraServer'];
        $api = new JiraClient($server, $username, $password);
        return $api;
    }

    public static function getIssueRelease($api, $task)
    {
        // https://sigencore.atlassian.net/rest/api/2/search?jql=project%20=%20%22SGN%22%20AND%20resolution%20=%20Unresolved%20ORDER%20BY%20priority%20DESC
        $request = $api->call('GET', '/issue/'.$task);
        $data = $request->getData()['fields']['comment']['comments'];
        return $data;
    }

    public static function getTasks($api, $jql) {
//        $jql = 'project = SGN AND fixVersion in unreleasedVersions() AND status in ("Check Result", "In Progress", Open, REVIEW, "Review analytics", "TECHNICAL PROJECT", "To do") ORDER BY priority DESC';
//        $jql = 'project = SGN AND fixVersion = "6.2.1. S - после НГ" ORDER BY priority DESC';
        $request = $api->call('GET', '/search?jql='.$jql);
        $data = $request->getData();
        return $data;
    }
}
