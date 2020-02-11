<?php

namespace console\controllers;

use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(\common\helpers\DateHelper::getTime());
    }
}
