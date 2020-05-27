<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$array = [1, 2, 3, 4, 5, 6];
?>
<div class="site-index">

    <div class="jumbotron">
        <h2 class="display-">Привет, мир!</h2>
        <p class="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного внимания к содержанию или информации.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php
                for ($i = 0; $i < 6; $i++):
            ?>
            <div class="col-lg-3 blocks">
                <h2>Уведомления <?= $i+1 ?></h2>
<!--                <p>--><?//= $data[0]['name'] ?><!--</p>-->
<!--                <p>Время последнего уведомления: --><?//= date('Y-m-d H:i:s', $data[0]['last_time_work']) ?><!--</p>-->
                <div class="progress">
                    <?php $temp = rand(0,100) ?>
                    <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$temp ?>%;">
                        <?=$temp ?>%
                    </div>
                </div>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Настройки &raquo;</a></p>
            </div>
            <?php endfor;?>
        </div>

    </div>
</div>

<style>

    .blocks {
        border: 1px solid black;
        border-radius: 20px;
        padding: 60px;
        margin: 30px;
        width: 30%;
        background: aliceblue;
    }

    body {
        background-image: url("https://avatars.mds.yandex.net/get-pdb/1245924/724284f6-9a6d-4b38-ac2c-740ef566311f/s1200");
    }

    .jumbotron {
        background: #5a6268;
        opacity: 50%;
    }

    .jumbotron:hover {
        background: #5a6268;
        opacity: 99%;
        transition: 0.5s;
    }

    .btn-default {
        text-align: center;
    }

</style>
