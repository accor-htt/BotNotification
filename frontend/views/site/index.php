<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="display-4">Привет, мир!</h1>
        <p class="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного внимания к содержанию или информации.</p>
        <hr class="my-4">
        <p>Использются служебные классы для типографики и расстояния содержимого в контейнере большего размера.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3 blocks">
                <h2>Уведомления еды</h2>
                <p><?= $data[0]['name'] ?></p>
                <p><?= date('Y-m-d H:i:s', $data[0]['last_time_work']) ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
            <div class="col-lg-3 blocks">
                <h2>Heading</h2>
                <p></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
            <div class="col-lg-3 blocks">
                <h2>Heading</h2>
                <p></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
            <div class="col-lg-3 blocks">
                <h2>Heading</h2>
                <p></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
            <div class="col-lg-3 blocks">
                <h2>Heading</h2>
                <p></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
            <div class="col-lg-3 blocks">
                <h2>Heading</h2>
                <p></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        60%
                    </div>
                </div>
            </div>
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
        opacity: 95%;
    }

</style>
