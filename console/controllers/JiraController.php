<?php

namespace console\controllers;

use common\helpers\JiraHelper;
use common\helpers\RocketChatHelper;
use console\models\Staff;
use yii\console\Controller;

class JiraController extends Controller
{
    public $channel = 'overflow_cold_wallets';

    public function actionIndex()
    {
        $api = JiraHelper::connect();
        $jql = 'project = SGN AND fixVersion in unreleasedVersions() AND status in ("Check Result", "In Progress", Open, REVIEW, "Review analytics", "TECHNICAL PROJECT", "To do") ORDER BY priority DESC';
        $issues = JiraHelper::getTasks($api, $jql);
        $temp = [];
        foreach ($issues['issues'] as $task) {
            if (empty($task['fields']['duedate'])) {
                $rocketChat = Staff::find()->where(['jira_nickname' => $task['fields']['assignee']['key']])->one();
                $temp[$rocketChat['rocket_chat_id']] = $task['key'];
                $message = 'Привет! На тебе есть задачи в релизе {релиз дата}, нужно срочно выставить срок исполнения. А то черный шар . Вот эти задачи: '.$task['key'];
                RocketChatHelper::sendMessage('@Anastasiya-Tester', $message);
            }
        }
        var_dump($temp);
    }

    public function actionBlackBall()
    {
        $api = JiraHelper::connect();
        $dateNow = date('Y-m-d H:i:s');
        $dateYesterday = date('Y-m-d H:i:s', strtotime('-24 hours', time()));
//        $jql = 'project = SGN AND fixVersion in unreleasedVersions() ORDER BY priority DESC';
        $jqlLastDay = 'project = SGN AND updated >= -1d ORDER BY priority DESC';
        $issues = JiraHelper::getTasks($api, $jqlLastDay);
        if (!empty($issues)) {
            RocketChatHelper::sendMessage('private_black_balls', 'SIGEN');
            foreach ($issues['issues'] as $task) {
                $comments = JiraHelper::getIssueRelease($api, $task['key']);
                foreach ($comments as $comment) {
                    $dateComment = date('Y-m-d H:i:s', strtotime($comment['created']));
                    if ($dateNow >= $dateComment && $dateComment >= $dateYesterday) {
                        if (stristr($comment['body'], '(flag)')) {
                            var_dump($task['key']);
                            RocketChatHelper::sendMessage('private_black_balls', 'https://sigencore.atlassian.net/browse/'.$task['key']);

                        }
                    }
                }

            }
        }
        var_dump('end');
    }
}
