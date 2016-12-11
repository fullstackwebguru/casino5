<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Banner;
use frontend\widgets\SideCategory;
use frontend\widgets\SideTop5;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

?>

<div class="top"></div>
<section id="guide">
    <div class="container">
        <div class="main col-md-8">
        	<?php foreach ($guides as $guide ) {
                        $guideImage = cloudinary_url($guide->image_url, array("width" => 186, "height" => 189, "crop" => "fill"));
			?>
            
            <div class="post-wrapper">
                <a href="<?=Url::toRoute($guide->getRoute())?>"> <img src="<?= $guideImage ?>" class="img-responsive col-sm-3 no-padding post-img" alt="p-image"> </a>
                <div class="text-gui col-sm-9">
                    <a href="<?=Url::toRoute($guide->getRoute())?>"><h3><?= $guide->title ?></h3></a>
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
		 </div>
	</div>
</section>
		