<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$attributes = [
    [
        'group'=>true,
        'label'=>'Basic Details',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'id', 
        'label'=>'Category #',
        'displayOnly'=>true,
    ],
    [
        'attribute'=>'short_title', 
        'value'=>$model->short_title
    ],
    [
        'attribute'=>'title', 
        'value'=>$model->title
    ],
    [
        'attribute'=>'short_description', 
        'value'=>$model->short_description
    ],
    [
        'group'=>true,
        'label'=>'SEO Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'slug', 
        'value'=>$model->slug
    ],
    [
        'attribute'=>'meta_keywords', 
        'value'=>$model->meta_keywords
    ],
    [
        'attribute'=>'meta_description', 
        'value'=>$model->meta_description
    ]
];

//images
$allImages = [];
$allImageConfig = [];

if ($model->image_url) {
    // $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '200x150', ['class' => 'file-preview-image']);
    $allImages[] = '<img src="' . cloudinary_url($model->image_url, array("width" => 377, "height" => 220, "crop" => "fill")) .'" class="file-preview-image">';

    $allImageConfig[] =[   
            'caption' => 'Current Image',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['detach', 'id'=>$model->id])
    ];
}


//Company information
//
$viewMsg = 'View Company';
$updateMsg = 'Not applicable';
$deleteMsg = 'Remove Company';

$maxRank = $dataProvider->getTotalCount() - 1;

$gridColumns = [
    [
        'attribute' => 'rank',
        'label' => '#',
        'width' => '50px',
        'vAlign'=>'middle',
        'format' => 'raw',
        'value'=>function ($model, $key, $index, $widget) { 
            return ($model->rank+1);
        }
    ],
    [
        'attribute' => 'company_id',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->title;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'Mobile',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->feature_mobile;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'Instant Play',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->feature_instant_play;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'Download',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->feature_download;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'LIVE',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->feature_live_casino;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'VIP',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->company->feature_vip_program;
        }
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'label' => 'Enabled',
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
        'value'=>function ($model, $key, $index, $widget) { 
            return ($model->company->status == 1);
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'view') {
                return Url::toRoute(['/catalog/company/view', 'id'=> $model->company_id]);
            } else if ($action == 'delete') {
                return Url::toRoute(['deleteinfo', 'id'=>$model->category->id, 'infoId'=>$model->id]);
            } else if ($action == 'up') {
                return Url::toRoute(['rank', 'id'=>$model->category->id, 'actionId'=>$model->id, 'type' => 'up']);
            } else if ($action == 'down') {
                return Url::toRoute(['rank', 'id'=>$model->category->id, 'actionId'=>$model->id, 'type' => 'down']);
            } else {
                return '';
            }
        },
        'template' => '{up} {down} {view} {delete}',
        'buttons' => [
            'up' => function ($url, $model) {
                if ($model->rank != 0 ) {
                    return '<a class="change-rank" href="'. $url . '" data-rank="'. $model->rank .'" title="" data-toggle="tooltip" data-original-title="Up"><span class="glyphicon glyphicon-arrow-up"></span></a>';
                } else {
                    return '';
                }
            },
            'down' => function ($url, $model) {
                if ($model->rank != ($model->category->getMaxRank() - 1 ) ) {
                    return '<a class="change-rank"  href="'. $url . '" data-rank="'. $model->rank .'" title="" data-toggle="tooltip" data-original-title="Down"><span class="glyphicon glyphicon-arrow-down"></span></a>';
                } else {
                    return '';
                }
            },
        ],
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
        'width' => '110px'
    ],
];




//field additional information
//
//
$deleteFieldMsg = 'Delete field information';

$fieldGridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'property_id',
        'label' => 'Field',
        'vAlign'=>'middle',
        'width' => '30%',
        'value'=>function ($model, $key, $index, $widget) { 
             return $model->property->title;
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'delete') {
                return Url::toRoute(['deletefield', 'id'=>$model->category_id, 'fieldId'=>$model->id]);
            } else {
                return '';
            }
        },
        'deleteOptions'=>['title'=>$deleteFieldMsg, 'data-toggle'=>'tooltip'], 
    ],
];


$this->registerJs(
   '$(document).ready(function(){ 
        $(document).on("click", "#reset_companyinfos", function() {
            $.pjax.reload({container:"#companyinfos"});  //Reload GridView
        });

        $(document).pjax("a.change-rank", "#companyinfos");
    });'
);

?>
<div class="row">
    <div class="col-xs-12">

    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>$viewMode,
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'panel'=>[
            'heading'=>'Category Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view', 'id'=>$model->id])]
    ]);?>

    </div>

</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border" id>
    <h3 class="box-title">Companies</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'showFooter' => false,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::toRoute(['addinfo', 'id'=>$model->id]), ['title'=>'Add', 'id'=>'add_companyinfos', 'class'=>'showModalButton btn btn-success']) . ' ' .
                Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'reset_companyinfos', 'class'=>'btn btn-default'])
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'companyinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
    <h3 class="box-title">Additional Fields</h3>

    <?= GridView::widget([
        'dataProvider' => $fieldDataProvider,
        'columns' => $fieldGridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'showFooter' => false,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'add_fieldinfos', 'class'=>'showModalButton btn btn-success', 'value'=>Url::toRoute(['addfield', 'id'=>$model->id])]) 
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'fieldinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Category Image</h3>

        <?= FileInput::widget([
            'name'=>'new_category_image',
            'options' => [
                'id' => 'input-888'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  1,
                'initialPreview' => $allImages,
                'initialPreviewConfig' => $allImageConfig,
                'initialPreviewAsData' => false,
                'overwriteInitial' => true,
                'autoReplace' => true,
                'showClose' => false,
                'showBrowse' => true,
                'showRemove' => false,
                'showUpload' => false,
                'previewFileType' => 'image',
                'uploadUrl' => Url::toRoute(['upload', 'id'=>$model->id]),
            ]
        ]) ?>
    </div>
    </div>
<div>


<?php
    yii\bootstrap\Modal::begin([
        'header' => 'Add Field Info',
        'id'=>'addFieldInfoModal',
        'class' =>'modal',
        'size' => 'modal-md',
    ]);
        echo "<div class='modalContent' id='modalContent'></div>";
    yii\bootstrap\Modal::end();

        //js code:
    $this->registerJs('

        $(document).ready(function(){ 
            $(document).on("click", "#add_fieldinfos", function() {
                $("#addFieldInfoModal").modal("show")
                    .find("#modalContent")
                    .load($(this).attr("value"));
            });
        });
    ');
?>
