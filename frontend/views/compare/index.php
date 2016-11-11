<?php

/* @var $this yii\web\View */

use frontend\widgets\LatestGuide;
use frontend\widgets\NewsletterBox;
use frontend\widgets\Banner;
use frontend\widgets\HowToFind;
use frontend\widgets\HowWeWork;
use yii\helpers\Url;
use frontend\widgets\Rating;
use kartik\markdown\Markdown;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Banner::widget() ?>

<!-- table section-->
    <section id="tables-1">
        <div class="container">
            <h1 class="headlines-comp">FEATURE<span class="red"> COMPARISON</span></h1>
            <?= Markdown::convert($model->description) ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="top-question-comp"><i class="fa fa-question-circle" aria-hidden="true"></i> Wondering how we rank the products?</p>
                </div>
            </div>
            <div class="table-condensed desk">
                <table class="table">
                    <thead>
                        <tr class="header-titles">
                            <th class="hearder-box-comp"><p class="hbc">#</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Casino site</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Mobile</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Instant Play</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Download version</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Live Casino</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">VIP Program</p></th>
                            <th class="hearder-box-comp min"><p class="hbc">Play</p></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($companies as $company ) {
                        $companyLogo = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
                    ?>
                        <tr>
                            <td class="offers-comp">1</td>
                            <td class="t-images-comp"><img src="<?= $companyLogo ?>" class="img-responsive t-img-company" alt="casino-img"></td>
                            <td class="padd-comp">
                                <?php if ($company->feature_mobile > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_instant_play > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>

                            <td class="padd-comp">
                                <?php if ($company->feature_download > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_live_casino > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="padd-comp">
                                <?php if ($company->feature_vip_program > 0) {
                                ?>
                                <div class="i-wrapp">
                                    <i class="fa fa-check size" aria-hidden="true"></i>
                                </div>
                                <?php }  ?>
                            </td>
                            <td class="btn-padd-1"><a href="<?= $company->website_url ?>" class=" btn btn-comp btn-primary">PLAY</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
