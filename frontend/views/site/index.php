<?php

/* @var $this yii\web\View */

use frontend\widgets\Banner;
use frontend\widgets\HowToFind;
use frontend\widgets\HowWeWork;
use yii\helpers\Url;
use frontend\widgets\Rating;
use kartik\markdown\Markdown;

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

<?= Banner::widget(['category'=> $category]) ?>


<?= $this->render('../include/_table', [
    'category' => $category,
    'kw' => $kw,
    'filterSelected' => $filterSelected,
    'cateComps' => $cateComps
]) ?>


<?= HowWeWork::widget() ?>
<!--end of what we do section-->
<hr class="divider">
<?= HowToFind::widget() ?>

<?php

$this->registerJs(
   '$(document).ready(function(){ 
        var currentBaseUrl = "' . Url::toRoute('/') . '";
        $(document).on("change", "#home", function(e, id) {
            var id = $("#home").val();
            window.location.href = currentBaseUrl + "?filter="+id;
        });



    });'
);

?>