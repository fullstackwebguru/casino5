<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Rating;
use frontend\widgets\Banner;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

?>

<?= Banner::widget(['breadcrumbs' => [
    [  
        'title' => 'Home', 
        'route' => ['/']
    ],
], 'title' => $this->title ]) ?>

<section id="casinos-1">
    <div class="container" id="all-casino-container">
        <h1 class="headlines-2 ">OUR TOP<span class="red "> CASINOS</span></h1>

        <input id="company_start_list" type="hidden" value="0"></input>

        <?=  $this->render('_companyList', [
        		'companies' => $companies,
        		'more' => $more,
        		'fromLoad' => 1,
                'startPos' => $startPos
			]); ?>
        
		<!-- everything you put in lazi wrap will be appear on show more click-->
		
    </div>
</section>
