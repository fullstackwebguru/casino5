<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use common\models\PropComp;


/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Companys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    [
        'group'=>true,
        'label'=>'Company Info',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'id', 
        'label'=>'Company #',
        'displayOnly'=>true,
    ],
    [
        'attribute'=>'title', 
        'value'=>$model->title
    ],
    [
        'attribute'=>'website_url', 
        'value'=>$model->website_url
    ],
    [
        'attribute'=>'bonus_as_value', 
        'value'=>$model->bonus_as_value
    ],
    [
        'attribute'=>'bonus_offer', 
        'value'=>$model->bonus_offer
    ],
    [
        'attribute'=>'bonus_text_font', 
        'value'=>$model->bonus_text_font
    ],
    [
        'attribute'=>'short_description', 
        'value'=>$model->short_description
    ],
    [
        'attribute'=>'description', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->description),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
    ],
    [
        'attribute'=>'status', 
        'format'=>'raw',
        'value'=>$model->status ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'group'=>true,
        'label'=>'Features',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'feature_mobile', 
        'format'=>'raw',
        'value'=>$model->feature_mobile ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'attribute'=>'feature_instant_play', 
        'format'=>'raw',
        'value'=>$model->feature_instant_play ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'attribute'=>'feature_download', 
        'format'=>'raw',
        'value'=>$model->feature_download ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'attribute'=>'feature_live_casino', 
        'format'=>'raw',
        'value'=>$model->feature_live_casino ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'attribute'=>'feature_vip_program', 
        'format'=>'raw',
        'value'=>$model->feature_vip_program ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'group'=>true,
        'label'=>'Editor\'s Review',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'rating', 
        'value'=>$model->rating
    ],
    [
        'attribute'=>'review', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->review),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
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
    ],
    [
        'group'=>true,
        'label'=>'Table Setting',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'button_text', 
        'value'=>$model->button_text
    ],
    [
        'attribute'=>'link_text', 
        'label' => 'Link Text ( #name# indicates casino name)',
        'value'=>$model->link_text
    ],
];



//images
$allImages = [];
$allImageConfig = [];

if ($model->image_url) {
    $allImages[] = '<img src="' . cloudinary_url($model->image_url, array("width" => 250, "height" => 190, "crop" => "fill")) .'" class="file-preview-image">';

    $allImageConfig[] =[   
            'caption' => 'Current Image',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['detach', 'id'=>$model->id])
    ];
}

$allLogos = [];
$allLogosConfig = [];

if ($model->logo_url) {
    $allLogos[] = '<img src="' . cloudinary_url($model->logo_url, array("width" => 247, "height" => 78, "crop" => "fill")) .'" class="file-preview-image">';

    $allLogosConfig[] =[   
            'caption' => 'Current Logo',
            'frameAttr'=> [
                'style' => 'height:150px; width:100px;',
            ],
            'url' => Url::toRoute(['delogo', 'id'=>$model->id])
    ];
}


//field additional information
//
//
$deleteMsg = 'Delete field information';

$gridColumns = [
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
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'value',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Value']
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'delete') {
                return Url::toRoute(['deleteinfo', 'id'=>$model->company_id, 'infoId'=>$model->id]);
            } else {
                return '';
            }
        },
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];


?>

<div class="row">
    <div class="col-xs-12">
    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'panel'=>[
            'heading'=>'Company Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view', 'id'=>$model->id])]
    ]);?>

    </div>
</div>




<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
    <h3 class="box-title">Additional Info</h3>

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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'add_fieldinfos', 'class'=>'showModalButton btn btn-success', 'value'=>Url::toRoute(['addinfo', 'id'=>$model->id])]) 
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
        <h3 class="box-title">Company Logo</h3>

        <?= FileInput::widget([
            'name'=>'new_company_logo',
            'options' => [
                'id' => 'input-888'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  1,
                'initialPreview' => $allLogos,
                'initialPreviewConfig' => $allLogos,
                'initialPreviewAsData' => false,
                'overwriteInitial' => true,
                'autoReplace' => true,
                'showClose' => false,
                'showBrowse' => true,
                'showRemove' => false,
                'showUpload' => false,
                'previewFileType' => 'image',
                'uploadUrl' => Url::toRoute(['uplogo', 'id'=>$model->id]),
            ]
        ]) ?>
    </div>
    </div>
<div>


<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Main Image</h3>

        <?= FileInput::widget([
            'name'=>'new_company_image',
            'options' => [
                'id' => 'input-810'
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
