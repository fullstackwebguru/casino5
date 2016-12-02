<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Banner;
use frontend\widgets\Rating;

use frontend\widgets\HowToFind;
use frontend\widgets\HowWeWork;

use frontend\assets\Top10JsAsset;

$this->title = 'Category - '. $category->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $category->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $category->meta_description
        ]);

?>

<?= Banner::widget(['breadcrumbs' => [
    [  
        'title' => 'Home', 
        'route' => ['/']
    ],
    [  
        'title' => $parentPage->title,
        'route' => ['/category']
    ],
], 'title' => $category->title ]) ?>

<section id="tables-1">
    <h1 class="headlines-hp">TOP 5<span class="red"> CASINO WEBSITES</span></h1>
    <div class="container" id="front">
        <div class="row">
            <div class="col-sm-6">
                <a href="javascript:void(0)" class="goto_section_bottom"><p class="top-question"><i class="fa fa-question-circle" aria-hidden="true"></i> Wondering how we rank casinos?</p></a>
            </div>
            <div class="col-sm-6">
                    <select id="home">
                        <option value="all"  <?= $filterSelected == 'selected' ? 'selected="selected"' : ''?> >Show All</option>
                        <option value="mobile" <?= $filterSelected == 'mobile' ? 'selected="selected"' : ''?>>Mobile</a></option>
                        <option value="instant"<?= $filterSelected == 'instant' ? 'selected="selected"' : ''?> >Instant Play</a></option>
                        <option value="download"<?= $filterSelected == 'download' ? 'selected="selected"' : ''?> >Download</a></option>
                        <option value="live"<?= $filterSelected == 'download' ? 'selected="selected"' : ''?> >Live Casino</a></option>
                        <option value="vip"<?= $filterSelected == 'download' ? 'selected="selected"' : ''?> >VIP Program</a></option>
                    </select>
                    <p class="top-right"><i class="fa fa-filter" aria-hidden="true"></i> Filter By</p>
                </div>
        </div>
        <div class="table-condensed desk">
            <table class="table sortable">
                <thead>
                    <tr class="header-titles">
                        <th data-firstsort data-defaultsort="asc" class="hearder-box">#</th>
                        <th data-defaultsort="disabled" class="hearder-box">Casino Site</th>
                        <?php foreach($category->propCates as $propCate) { ?> 
                        <th data-defaultsort="disabled" class="hearder-box"><?= $propCate->property->title; ?></th>
                        <?php } ?>  
                        <th class="hearder-box">Offer</th>
                        <th data-defaultsort="disabled" class="hearder-box">Features</th>
                        <th class="hearder-box">Ratings</th>
                        <th data-defaultsort="disabled" class="hearder-box">Play</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> </td>
                    </tr>

                    <?php
                    foreach($cateComps as $catComp) {
                        $company = $catComp->company;
                        $companyImage = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
                    ?>

                    <?php 

                    if ($catComp->rank == 0) {
                    ?>
                    <tr id="first">
                        <td class="t-images-1" data-value="<?= $catComp->rank ?>"><img src="/images/nr1.jpg" id="nr1" alt="nr1"></td>

                    <?php
                    } else {
                    ?>
                        <tr>
                            <td class="offers" data-value="<?= $catComp->rank ?>"><p class="nr-desk"><?= $catComp->rank+1 ?></p></td>
                    <?php } ?>
                        <td class="t-images">
                            <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                                <img src="<?= $companyImage ?>" class=" t-img" alt="<?= $company->title ?>"></a>
                        </td>

                        <?php foreach($category->propCates as $propCate) { 
                            $propComp = $company->getPropCompByProperty($propCate->property_id);
                        ?> 

                        <td class="offers">
                            <p class="offers-3"><?= $propComp == null ? ' ' : $propComp->value; ?> </p>
                        </td>

                        <?php } ?>

                        <td class="offers" data-value="<?= $company->bonus_as_value ?>">   
                            <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"> 
                            <p class="offers-3" style="font-size:<?= $company->bonus_text_font?>px;"><?= $company->bonus_offer; ?> </p>
                            </a>
                        </td>
                        <td class="padd-2">
                            <div class="i-wrapp">
                                <?php if ($company->feature_mobile > 0) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-mobile red" aria-hidden="true" title="Mobile"></i></div>
                                <?php
                                }
                                ?>
                                <?php if ($company->feature_instant_play > 0) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-play red" aria-hidden="true" title="Instant Play"></i></div>
                                <?php
                                }
                                ?>
                                <?php if ($company->feature_download > 0) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-download red" aria-hidden="true" title="Download" ></i></div>
                                <?php 
                                }
                                ?>
                                <?php if ($company->feature_live_casino > 0) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-video-camera red" aria-hidden="true" title="Live Casino"></i></div>
                                <?php    
                                }
                                ?>
                                <?php if ($company->feature_vip_program > 0) {
                                ?>
                                <div class="col-xs-6 no-padding"><i class="fa fa-user-circle-o red" aria-hidden="true" title="VIP Program"></i></div>
                                <?php    
                                }
                                ?>
                            </div>
                        </td>
                        <td class="padd-1" data-value="<?= $company->rating ?>">
                            <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute())]) ?>
                        </td>
                        <td class="btn-padd">
                            <a href="<?= $company->website_url ?>" class=" btn btn-md t-btn" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->button_text ?></a>
                            <a href="<?= $company->website_url ?>" class=" btn btn-md" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->getLinkText() ?></a>
                        </td>

                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        foreach($cateComps as $catComp) {
            $company = $catComp->company;

            $companyImage = cloudinary_url($company->logo_url, array("width" => 247, "height" => 78, "crop" => "fill"));
        ?>

        <?php 
        if ($catComp->rank == 0) {
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
                if ($catComp->rank == 0) {
                ?>
                <img src="/images/nr1.png" id="nr-1" alt="nr1">
                <?php
                } else {
                ?>
                <p class="nr-mob"><?= $catComp->rank+1 ?></p>
                <?php } ?>
                 <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;">
                    <img src="<?= $companyImage ?>" class="img-responsive t-img" alt="<?= $company->title ?>"></a>


                <?php foreach($category->propCates as $propCate) { 
                            $propComp = $company->getPropCompByProperty($propCate->property_id);
                        ?> 
                            <p class="offers-3"><?= $propComp == null ? ' ' : $propComp->value; ?> </p>
                <?php } ?>

                <a href="<?= $company->website_url ?>" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"> <p class="offers-3" style="font-size:<?= $company->bonus_text_font?>px;"><?= $company->bonus_offer; ?> </p> </a>
                <div class="i-wrapp-mob">
                    <div class="row">
                        <?php if ($company->feature_mobile > 0) {
                        ?>
                        <div class="col-xs-6 no-padding"><i class="fa fa-mobile red" aria-hidden="true" title="Mobile"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_instant_play > 0) {
                        ?>
                        <div class="col-xs-6 no-padding"><i class="fa fa-play red" aria-hidden="true" title="Instant Play"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_download > 0) {
                        ?>
                        <div class="col-xs-6 no-padding"><i class="fa fa-download red" aria-hidden="true" title="Download"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_live_casino > 0) {
                        ?>
                        <div class="col-xs-6 no-padding"><i class="fa fa-video-camera red" aria-hidden="true" title="Live Casino"></i></div>
                        <?php    
                        }
                        ?>
                        <?php if ($company->feature_vip_program > 0) {
                        ?>
                        <div class="col-xs-6 no-padding"><i class="fa fa-user-circle-o red" aria-hidden="true" title="VIP Program"></i></div>
                        <?php    
                        } 
                        ?>
                    </div>
                </div>
                <?= Rating::widget(['rating' => $company->rating, 'link_url'=> Url::toRoute($company->getRoute())]) ?>
                <div class="col-sm-12 more"> <a href="<?= $company->website_url ?>" class=" btn btn-md btn-primary t-btn" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>', '<?= $catComp->rank+1 ?>'); return false;"><?= $company->button_text ?></a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>

<?= HowWeWork::widget() ?>

<!--end of what we do section-->
<hr class="divider">


<?= HowToFind::widget() ?>

<?php

$this->registerJs(
   '$(document).ready(function(){ 
        var currentBaseUrl = "' . Url::current() . '";
        $(document).on("change", "#home", function(e, id) {
            var id = $("#home").val();
            window.location.href = currentBaseUrl + "?filter="+id;
        });



    });'
);

?>