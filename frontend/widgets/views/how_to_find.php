<?php

use yii\helpers\Url;
use kartik\markdown\Markdown;
?>

<!-- top banner-->

<section id="text-block">
    <div class="container">
        <h1 class="headlines-1">HOW TO FIND THE<span class="red"> BEST ONLINE CASINOS</span></h1>
        <?= Markdown::convert($theme->how_to_find_best) ?>
    </div>
</section>
