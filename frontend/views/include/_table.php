<?php

use frontend\widgets\Rating;
use kartik\markdown\Markdown;
use yii\helpers\Url;

?>

<section id="tables-1">
    <h1 class="headlines-hp"><?= $category->getTableTitleText($kw) ?></h1>
    <div class="container" id="front">
        <div class="row">
            <div class="col-sm-6">
                <p id="date"><?= Yii::$app->formatter->asDate('now', 'full'); ?></p>
            </div>
            <div class="col-sm-6">
                    <select id="home">
                        <option value="all"  <?= $filterSelected == 'selected' ? 'selected="selected"' : ''?> >Show All</option>
                        <option value="mobile" <?= $filterSelected == 'mobile' ? 'selected="selected"' : ''?>>Mobile</a></option>
                        <option value="instant"<?= $filterSelected == 'instant' ? 'selected="selected"' : ''?> >Instant Play</a></option>
                        <option value="download"<?= $filterSelected == 'download' ? 'selected="selected"' : ''?> >Download</a></option>
                        <option value="live"<?= $filterSelected == 'live' ? 'selected="selected"' : ''?> >Live Casino</a></option>
                        <option value="vip"<?= $filterSelected == 'vip' ? 'selected="selected"' : ''?> >VIP Program</a></option>
                        <option value="paypal"<?= $filterSelected == 'paypal' ? 'selected="selected"' : ''?> >Paypal</a></option>
                    </select>
                    <p class="top-right"><i class="fa fa-filter" aria-hidden="true"></i> Filter By</p>
                </div>
        </div>
        <div class="table-condensed desk">
            <table class="table sortable tablesorter">
                <thead>
                    <tr class="header-titles">
                        <th data-firstsort data-defaultsort="asc" class="hearder-box">#</th>
                        <th data-defaultsort="disabled" class="hearder-box">Casino Site</th>
                        <?php foreach($category->propCates as $propCate) { ?> 
                        <th data-defaultsort="disabled" class="hearder-box"><?= $propCate->property->title; ?></th>
                        <?php } ?>
                        <th class="hearder-box">Offer</th>
                        <th data-defaultsort="disabled" class="hearder-box">
                            Features
                            <div class="help-tip">
                                <p>Icons describe the features
                                </p>
                            </div>
                        </th>
                        <th class="hearder-box">Ratings</th>
                        <th data-defaultsort="disabled" class="hearder-box">Play</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> </td>
                    </tr>

                    <?php

                    $compIndex = 0;
                    foreach($cateComps as $catComp) {
                        $company = $catComp->company;
                        if ($company->status != 1) {
                            continue;
                        }

                        $compIndex++;
                        $companyImage = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
                    ?>

                    <?php 

                    if ($compIndex == 1) {
                
                    ?>
                    <tr id="first">
                        <td class="t-images-1" data-value="<?= $compIndex ?>"><img src="/images/nr-1.png" id="nr1" alt="nr1"></td>

                    <?php
                    } else {
                    ?>
                        <tr>
                            <td class="offers" data-value="<?= $compIndex ?>" ><p class="nr-desk"><?= $compIndex ?></p></td>
                    <?php } ?>
                        <td class="t-images">
                            <?php if ($company->user_favorite) { ?>
                            <img src="/images/userfavourite.png" id="favourite" alt="favorite-image">
                            <?php } ?>
                            <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                            <img src="<?= $companyImage ?>" class="img-responsive t-img" alt="<?= $company->title ?>"></a>
                        </td>

                        <?php foreach($category->propCates as $propCate) { 
                            $propComp = $company->getPropCompByProperty($propCate->property_id);
                        ?> 

                        <td class="offers" data-value="0">
                            <p class="offers-3"><?= $propComp == null ? ' ' : $propComp->value; ?> </p>
                        </td>

                        <?php } ?>

                        <td class="offers" data-value="<?= $company->bonus_as_value ?>">
                            <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"> 
                            <p class="offers-3" style="font-size:<?= $company->bonus_text_font?>px;"><?= $company->bonus_offer; ?> </p>
                            </a>
                        </td>
                        <td class="padd-2" data-value="0">
                            <div class="i-wrapp">
                                <?php 
                                    $featureCount = 0;
                                ?>
                                <div class="row">
                                <?php if ($company->feature_mobile > 0) {
                                    $featureCount++;
                                    if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-mobile red" aria-hidden="true" title="Mobile"></i></div>
                                <?php
                                }
                                ?>
                                <?php if ($company->feature_instant_play > 0) {
                                    $featureCount++;
                                    if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-play red" aria-hidden="true" title="Instant Play"></i></div>
                                <?php
                                }
                                ?>
                                <?php if ($company->feature_download > 0) {
                                    $featureCount++;
                                    if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-download red" aria-hidden="true" title="Download"></i></div>
                                <?php 
                                }
                                ?>
                                <?php if ($company->feature_paypal > 0) {
                                $featureCount++;
                                if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-paypal red" aria-hidden="true" title="Paypal"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($company->feature_live_casino > 0) {
                                $featureCount++;
                                if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-video-camera red" aria-hidden="true" title="Live Casino"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($company->feature_vip_program > 0) {
                                $featureCount++;
                                if ($featureCount > 3) {
                                        $featureCount =0 ;
                                ?>
                                    </div>
                                    <div class="row">
                                <?php
                                    }
                                ?>
                                <div class="col-xs-4 no-padding"><i class="fa fa-user-circle-o red" aria-hidden="true" title="VIP Program"></i></div>
                                <?php
                                }
                                ?>
                                </div>
                            </div>
                        </td>
                        <td class="padd-1" data-value="<?= $company->rating ?>">
                            <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute()), 'show_review' => $company->show_review_link ]) ?>
                        </td>
                        <td class="btn-padd" data-value="0">
                            <a href="<?= $company->website_url ?>" class=" btn btn-md btn-primary t-btn hvr-rectangle-out" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->button_text ?></a>
                            <p class="visit"><a href="<?= $company->website_url ?>" class="casino-link" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->getLinkText() ?></a></p>
                        </td>

                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        $compIndex = 0;
        foreach($cateComps as $catComp) {
            $company = $catComp->company;
            if ($company->status != 1) {
                continue;
            }
            $compIndex++;

            $companyImage = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
        ?>

        <?php 
        if ($compIndex == 1) {
        ?>
        <hr class="cas-top mob">
        <div class="small-wrapp mob first-mob ">
        <?php
        } else {
        ?>
        <div class="small-wrapp mob">
            <hr class="cas-top">

        <?php } ?>
            <div class="cas-mob-wrapp">
                <?php 
                if ($compIndex == 1) {
                ?>
                <img src="/images/nr1.png" id="nr-1" alt="nr1">
                <?php
                } else {
                ?>
                <p class="nr-mob"><?= $compIndex ?></p>
                <?php } ?>
                <?php if ($company->user_favorite) { ?>
                    <img src="/images/userfavourite.png" id="favourite" alt="favorite-image">
                <?php } ?>
                <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                    <img src="<?= $companyImage ?>" class="img-responsive t-img" alt="<?= $company->title ?>"></a>
                
                <?php foreach($category->propCates as $propCate) { 
                            $propComp = $company->getPropCompByProperty($propCate->property_id);
                        ?> 
                            <p class="offers-3"><?= $propComp == null ? ' ' : $propComp->value; ?> </p>
                <?php } ?>

                <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"> 
                    <p class="offers-3" style="font-size:<?= $company->bonus_text_font?>px;"><?= $company->bonus_offer; ?> </p>
                </a>

                <div class="i-wrapp-mob">
                    <div class="row">
                        <?php if ($company->feature_mobile > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-mobile red" aria-hidden="true" title="Mobile"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_instant_play > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-play red" aria-hidden="true" title="Instant Play"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_download > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-download red" aria-hidden="true" title="Download"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_paypal > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-paypal red" aria-hidden="true" title="Paypal"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_live_casino > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-video-camera red" aria-hidden="true" title="Live Casino"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_vip_program > 0) {
                        ?>
                        <div class="col-xs-4 no-padding"><i class="fa fa-user-circle-o red" aria-hidden="true" title="VIP Program"></i></div>
                        <?php    
                        } 
                        ?>
                    </div>
                </div>
                <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute()), 'show_review' => $company->show_review_link ]) ?>
                <div class="col-sm-12 more">
                    <a href="<?= $company->website_url ?>" class=" btn btn-md btn-primary t-btn hvr-rectangle-out" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->button_text ?></a>
                    <a href="<?= $company->website_url ?>" class="casino-link" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->getLinkText() ?></a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>


    <?= $this->render('_slider', [
        'filterSelected' => $filterSelected,
        'cateComps' => $cateComps
    ]) ?>

</section>