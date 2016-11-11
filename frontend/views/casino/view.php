<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\markdown\Markdown;
use frontend\widgets\Rating;
use frontend\widgets\SideCategory;
use frontend\widgets\SideTop5;

$this->title = 'Casino -' . $model->title;
$this->params['breadcrumbs'][] = $this->title;

$companyLogo = cloudinary_url($model->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
$companyImage = cloudinary_url($model->image_url, array("width" => 250, "height" => 190, "crop" => "fill"));
?>

<div class="top"></div>
<section id="company">
    <div class="container">
        <div class="main col-md-8">
            <p class="comp-title "><?= $model->title ?></p>
            <hr class="hr-comp">
            <div class="logo-wrapp">
                <div class="col-sm-6 no-padding">
                    <img src="<?= $companyLogo ?>" class="img-responsive comp-logo" alt="logo">
                </div>
                <div class="col-sm-6 no-padding" id="more-top">
                    <a href="<?= $model->website_url ?>" class="btn btn-bonus">GET BONUS</a>
                </div>
            </div>
            <div class="text-wrapp">
                <img src="<?= $companyImage ?>" class="img-responsive comp-img" alt="casino" >
                <?= Markdown::convert($model->description) ?>
            </div>

            <div class="review">
                <p>EDITOR REVIEW</p>
            </div>
            <div class="comp-wrapp">
                
                <?= Markdown::convert($model->review) ?>

                <div class="last-section">
                <div class="col-sm-6 no-padding">
                    <p class="comp-review"><span class="bold">RATINGS</span></p>
                    <hr class="comp-hr">
                                <?= Rating::widget(['rating' => $model->rating, 'type'=>'red']) ?>
                    <div class="first-color">
                            <p class="sec-title">RATINGS</p>
                    </div>
                </div>
                <div class="col-sm-6 no-padding">
                    <p class="comp-review"><span class="bold">FEATURES</span> for this casino</p>
                    <hr class="comp-hr">
                           <div class="i-wrapp-comp">
                           		<?php 
                           			$feature_count = 0;
                           		?>
                           		<?php if ($model->feature_mobile > 0 && $feature_count < 4) {
                           			$feature_count++;
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-mobile red-size-comp-2" aria-hidden="true"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($model->feature_instant_play > 0 && $feature_count < 4) {
                                	$feature_count++;
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-play red-size-comp-2" aria-hidden="true"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($model->feature_download > 0 && $feature_count < 4) {
                                	$feature_count++;
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-download red-size-comp-2" aria-hidden="true"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($model->feature_live_casino > 0 && $feature_count < 4) {
                                	$feature_count++;
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-video-camera red-size-comp-2" aria-hidden="true"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($model->feature_vip_program > 0 && $feature_count < 4) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-user-circle-o red-size-comp-2" aria-hidden="true"></i></div>
                                <?php    
                                }
                                ?>
                            </div>
                    <div class="sec-color">
                        <p class="sec-title">FEATURES</p>
                    </div>
                </div>
                        <div class="col-sm-12" id="more-top-2">
                                <a href="<?= $model->website_url ?>" class="btn btn-bonus-1">GET BONUS</a>
                        </div>
                </div>
            
            </div>

            <div class="col-md-12 no-padding">
                <p class="left single-title-2">OVERVIEW</p>
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Website</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->website_url ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Bonus offers</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->bonus_offer ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 no-padding">
                <p class="left single-title-2-a">ADDITIONAL INFORMATION</p>
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Software</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->software ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Type of games</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->type_of_games ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Support</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->support ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Currencies</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->currencies ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="left bold">
                                <p class="s-table-2">Languages</p>
                            </td>
                            <td class="right">
                                <p class="s-table-2"><?= $model->languages ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!--  sidebar  -->
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