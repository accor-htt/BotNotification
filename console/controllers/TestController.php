<?php

namespace console\controllers;

use console\helpers\JiraHelper;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        JiraHelper::connect();

        die;
    }
}
