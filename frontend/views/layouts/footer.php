<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<footer>
    <!-- newsletter section-->
    <section id="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="news-title">GET UPDATED<span class="red"> MONTHLY</span></h3>
                    <p class="news-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna </p>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <input type="text" class="form-control" id="usr" placeholder="Enter your email here">
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter section-->
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
                    <div class="net-wrapp">
                        <p class="title-info-2">GET IN TOUCH</p>
                        <p class="info-text-2"><span class="glyphicon glyphicon-earphone contact-info"></span> (07) 5512 3456</p>
                        <p class="info-text-2"><span class="glyphicon glyphicon-map-marker contact-info"></span> 1234/56 Lorem ipsum dolor sit Consectetur, QLD 4000</p>
                        <p class="info-text-2"><span class="glyphicon glyphicon-envelope contact-info"></span> lorem@ipsum.com.au</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="copy">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 more">
                    <ul class="foot-icons">
                        <li><a href=""><img src="images/foot1.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="images/foot2.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="images/foot3.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="images/foot4.png" class="img-responsive f-width" alt="Image"></a></li>
                        <li><a href=""><img src="images/foot5.png" class="img-responsive f-width" alt="Image"></a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <p class="copy-1-l">Best Casinos Online Top 10 © 2016 All rights reserved.</p>
                </div>
                <div class="col-md-7">
                    <p class="copy-1-r">Best Casinos Online Top 10 is not affiliated with any of the casinos showd on the website</p>
                </div>
            </div>
        </div>
    </section>
</footer>