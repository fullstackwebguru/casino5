
    <!--testimonial slider-->
 
    <div class="cd-testimonials-wrapper cd-container">
        <ul class="cd-testimonials">
            <?php foreach($cateComps as $catComp) {
                        $company = $catComp->company;
                        if ($company->status != 1) {
                            continue;
                        }

                        $companyImage = cloudinary_url($company->image_url, array("width" => 219, "height" => 119, "crop" => "fill"));
                    ?>
            ?>
            <li>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="col-lg-4">
                            <p class="slider-name"><?= $company->title ?></p>
                        </div>
                        <div class="col-lg-8">
                            <div class="slider-i-wrapp">
                                <span class="slider-i"><i class="fa fa-apple" aria-hidden="true"></i></span>
                                <span class="slider-i"><i class="fa fa-android" aria-hidden="true"></i></span>
                                <span class="slider-i"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                <span class="slider-i"><i class="fa fa-bolt" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p class="slider-text"><?= $company->slider_text ?></p>
                            <p class="slider-offer"><?= $company->bonus_offer ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="cd-author">                                 
                            <ul class="cd-author-info">
                                <li><img src="<?= $companyImage ?>" alt="Author image"></li>
                                <li><a href="<?= $company->website_url ?>" class="btn btn-md btn-slider" onclick="trackOutboundLink('<?= $company->title ?>', '<?= $company->website_url ?>'); return false;">  <?= $company->getLinkText() ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

            <?php 
            }
            ?>
            
        </ul> <!-- cd-testimonials -->
            <p class="cd-see-all"></p>
     <!--   <a href="#0" class="cd-see-all"></a>-->
    </div> <!-- cd-testimonials-wrapper -->

    <!--end of testimonial slider-->