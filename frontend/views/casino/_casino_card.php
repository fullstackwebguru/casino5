
<?php

use yii\helpers\Url;
use frontend\widgets\Rating;

$casinoLogo = cloudinary_url($casino->image_url, array("width" => 365, "height" => 214, "crop" => "fill"));

?>

<div class="col-md-4 col-sm-6 padd-left">
    <div class="cas-wrapp ">
        <img src="<?= $casinoLogo ?>" class="img-responsive " alt="casino-img">
        <div class="cas-wrapp-2">
        <p class="cas-title "><?= $casino->title ?></p>
        <p class="cas-text "><?= $casino->short_description ?></p>
        <div class="col-xs-6 ">
            <?= Rating::widget(['rating' => $casino->rating, 'link_url'=> Url::toRoute($casino->getRoute()), 'type' => 'category']) ?>
        </div>
        <div class="col-xs-6 ">
            <a href="<?= $casino->website_url ?>" target="_blank" class=" btn btn-md btn-danger cas-btn " onclick="trackOutboundLink('<?= $casino->title ?>', '<?= $casino->website_url ?>'); return false;">PLAY</a>
        </div>
      </div>
    </div>
</div>