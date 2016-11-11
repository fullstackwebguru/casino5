<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Banner;
use frontend\widgets\SideCategory;
use frontend\widgets\SideTop5;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Banner::widget() ?>
<div class="top"></div>
<section id="guide">
    <div class="container">
        <div class="main col-md-8">
        	<?php foreach ($guides as $guide ) {
                        $guideImage = cloudinary_url($guide->image_url, array("width" => 186, "height" => 189, "crop" => "fill"));
			?>


            <div class="post-wrapper">
                <img src="images/post-img-1.jpg" class="img-responsive col-sm-3 no-padding post-img" alt="p-image">
                <div class="text-gui col-sm-9">
                    <h3>Lorem ipsum</h3>
                    <span class="post-date">On <?= Yii::$app->formatter->asDate($guide->created_at , 'long'); ?> </span>
                    <p class="post-content">
                        <?= $guide->meta_description ?>
                    </p>
                    <a href="<?=Url::toRoute($guide->getRoute())?>" class=" btn btn-danger btn-md post-btn">MORE</a>
                </div>
            </div>

            <?php 
		        }
        	?>

		</div>

		 <div class="sidebar col-md-4">
		 	<?= SideTop5::widget(['num'=>5]) ?>
            <?= SideCategory::widget(['num'=>6]) ?>

            <div class="side-wrapp-1">
                <div class="side-letter">
                    <h3 class="newsletter">NEWSLETTER</h3>
                    <form action="#" method="POST">
                        <input type="text" class="form-control" id="side" placeholder="Type your email address ">
                        <div class="col-md-12" id="more">
                        <button type="button" class="btn btn-primary" id="news-sub">SIGN UP NOW</button>
                        </div>
                    </form>
                </div>
            </div>
		 </div>
	</div>
</section>
		