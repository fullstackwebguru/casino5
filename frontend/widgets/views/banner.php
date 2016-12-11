<?php

use yii\helpers\Url;
use kartik\markdown\Markdown;
use yii\helpers\Html;

?>

<!-- top banner-->
<section id="top-hp">
    <div class="container">
        <ul class="icon-menu">
            <?php foreach ($categories as $category) {
                $banner_icon = $category->banner_icon ? $category->banner_icon : "/images/icons-01-b.png";
            ?>
            
            <li class="top-banner">
                <a href="<?= Url::toRoute($category->getRoute())?>">
                    <img src="/images/icons-01-b.png" class="img-responsive menu-icons icon1-b invert-normal" alt="icons" >
                    <p class="i-text-1"><?= $category->title ?></p>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
             <p class="banner-text-3-hp">
                    <?= $category->banner_heading ?>
                    <span><a class=" read-more">Read More</a></span>
              </p>
              <p class="lazy">
                    <?= $category->banner_subheading ?>
              </p>

    </div>
</section>