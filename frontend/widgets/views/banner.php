<?php

use yii\helpers\Url;
use kartik\markdown\Markdown;
?>

<!-- top banner-->

<?php

if ($theme->banner_image) {
    $banner_image =  cloudinary_url($theme->banner_image, array("width" => 1918, "height" => 257, "crop" => "fill"));
?>
<section id="top-hp" style="background-image: url('<?= $banner_image ?>');">
<?php
} else  { 
?>
<section id="top-hp" >
<?php
}
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p id="banner-text-3-hp">
                    <?= $theme->banner_heading; ?>
                    <span><a class=" read-more">Read More</a></span>
                </p>
                <p class="lazy">
                    <?= $theme->banner_subheading; ?>
                </p>
            </div>
        </div>
    </div>
</section>
<!--end of top banner-->