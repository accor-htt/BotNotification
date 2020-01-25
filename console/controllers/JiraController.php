<?php

namespace console\controllers;

use console\helpers\JiraHelper;
use console\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class JiraController extends Controller
{
    public $channel = 'testName';

    public function actionIndex()
    {
        $api = JiraHelper::connect();
        $jql = 'project = SGN AND fixVersion in unreleasedVersions() AND status in ("Check Result", "In Progress", Open, REVIEW, "Review analytics", "TECHNICAL PROJECT", "To do") ORDER BY priority DESC';
        $issues = JiraHelper::getTasks($api, $jql);
        foreach ($issues['issues'] as $task) {
            if (empty($task['fields']['duedate'])) {
                $rocketChat = Staff::find()->where(['jira_nickname' => $task['fields']['assignee']['key']])->one()['rocket_chat_id'];
                $message = 'Привет! На тебе есть задачи в релизе {релиз дата}, нужно срочно выставить срок исполнения. А то черный шар . Вот эти задачи: {список задач из jira}';
                RocketChatHelper::sendMessage($rocketChat, $message);
//                var_dump($task['key'].' '.$task['fields']['assignee']['key']);
            }
        }
    }

    public function actionBlackBall()
    {
        $api = JiraHelper::connect();
        $jql = 'project = SGN AND fixVersion in unreleasedVersions() ORDER BY priority DESC';
        $issues = JiraHelper::getTasks($api, $jql);
        foreach ($issues['issues'] as $task) {
            $t = JiraHelper::getIssueRelease($api, $task['key']);
            var_dump($t);
            die;

                $rocketChat = Staff::find()->where(['jira_nickname' => $task['fields']['assignee']['key']])->one()['rocket_chat_id'];
        }
    }
}
