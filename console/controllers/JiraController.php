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
        $dateNow = date('Y-m-d H:i:s');
        $dateYesterday = date('Y-m-d H:i:s', strtotime('-24 hours', time()));
        $jql = 'project = SGN AND fixVersion in unreleasedVersions() ORDER BY priority DESC';
        $jqlLastDay = 'project = SGN AND updated >= -1d ORDER BY priority DESC';
        $issues = JiraHelper::getTasks($api, $jql);
        foreach ($issues['issues'] as $task) {
            $comments = JiraHelper::getIssueRelease($api, $task['key']);
            foreach ($comments as $comment) {
                $dateComment = date('Y-m-d H:i:s', strtotime($comment['created']));
                if ($dateNow >= $dateComment && $dateComment >= $dateYesterday) {
                    if (stristr($comment['body'], '(flag)')) {
                        var_dump($task['key']);
                    }
                }
            }

        }
    }
}
