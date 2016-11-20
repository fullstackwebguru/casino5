<?php 

use yii\helpers\Url;
use frontend\widgets\Rating;
?>

<div class="side-wrapp-1">
   <p class="side-title-1"><?= $side_title?></p>
        <table class="table table-condensed table-striped">                        
            <tbody>

                <?php foreach ($companies as $company ) {
                    $companyLogo = cloudinary_url($company->logo_url, array("width" => 120, "height" => 38, "crop" => "fill"));
                ?>

                <tr>
                    <td><a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>'); return false;" ><img src="<?= $companyLogo ?>" class=" t-img-gui" alt="casino-img"></a></td>
                    <td>
                        <?= Rating::widget(['rating' => $company->rating, 'type'=>'side', 'link_url'=> Url::toRoute($company->getRoute())]) ?>
                    </td>

                    <td><a href="<?= $company->website_url ?>" class=" btn btn-guide btn-primary" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>'); return false;">PLAY</a></td>
                </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>