<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\markdown\Markdown;
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

$guideImage = cloudinary_url($model->image_url, array("width" => 744, "height" => 347, "crop" => "fill"));
?>

<div class="top"></div>
<section id="guide">
	<div class="container">
	    <div class="main col-md-8">
	       <img src="<?= $guideImage ?>" class="img-responsive top-gs" alt="top-image">
            <h3 class="gs-3"><?= $model->title ?></h3>

            <?= Markdown::convert($model->description) ?>
	        
	    </div>

	    <div class="sidebar col-md-4">
	 	<?= SideTop5::widget(['num'=>5]) ?>
	    <?= SideCategory::widget(['num'=>6]) ?>
	 </div>

	</div>
</section>