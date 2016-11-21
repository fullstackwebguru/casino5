<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\GetInTouch;
?>

<footer>
    <section id="info">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p class="title-info-1">Best Casinos</p>
                    <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt uvinventore veritatis et </p>
                    <p class="info-text">sed do eiusmod tempor incididunt uvinventore veritatis et quasi architecto </p>
                </div>
                <div class="col-sm-4">
                    <div class="net-wrapp">
                        <p class="title-info-2">SITE</p>
                        <p class="info-text-2"><?=  Html::a('Home',['/']) ?></a></p>
                        <p class="info-text-2"><?=  Html::a('Privacy',['/site/policy']) ?></p>
                        <p class="info-text-2"><?=  Html::a('ToS',['/site/tos']) ?></p>
                        <p class="info-text-2"><?=  Html::a('Disclamer',['/site/disclaimer']) ?></p>
                        <p class="info-text-2"><?=  Html::a('Contact',['/site/contact']) ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?= GetInTouch::widget() ?>
                </div>
            </div>
        </div>
    </section>
    <section id="copy">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 more">
                    <ul class="foot-icons">
                        <li><a href=""><img src="/images/foot1.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="/images/foot2.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="/images/foot3.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="/images/foot4.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="/images/foot5.png" class="img-responsive f-width" alt="Image"></a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <p class="copy-1-l">Top5BestOnlineCasinos.today © 2016 All rights reserved.
                </div>
                <div class="col-md-7">
                    <p class="copy-1-r">Top 5 Best Online Casinos Today is not affiliated with any of the casinos showd on the website</p>
                </div>
            </div>
        </div>
    </section>
</footer>