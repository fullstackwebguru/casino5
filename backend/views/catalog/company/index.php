<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companys';
$this->params['breadcrumbs'][] = $this->title;

$viewMsg = 'View Company Details';
$updateMsg = 'Update Company Details';
$deleteMsg = 'Delete Company';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute'=>'logo_url', 
        'vAlign'=>'middle',
        'width'=>'80px',
        'format' => 'raw',
        'value'=>function ($model, $key, $index, $widget) { 
            // return Yii::$app->imageCache->img('@mainUpload/' . $model->logo_url, '80x80', ['class' => 'file-preview-image']);
            return '<img src="' . cloudinary_url($model->logo_url, array("width" => 80, "height" => 80, "crop" => "fill")) .'" class="file-preview-image">';
        },
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'title',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Title']
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'feature_mobile', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'feature_instant_play', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'feature_download', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'feature_live_casino', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'feature_vip_program', 
        'vAlign'=>'middle',
        'trueLabel' => 'Yes',
        'falseLabel' => 'No',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'update') {
                return Url::toRoute(['view', 'id'=>$key, 'viewMode'=>'edit']);     
            } else {
                return Url::toRoute([$action, 'id'=>$key]);
            }
        },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

?>

<div class="row">
    <div class="col-sm-6 col-xs-12">
      
    </div>
    <!-- /.col -->
    <div class="col-sm-6 col-xs-12">
        <a href="<?= Url::to(['create'])?>" class="pull-right">
            <div class="description-block border-right">
                <span class="icon-button"><i class="ion ion-plus-circled"></i></span>
                <h5 class="description-text">New Company</h5>
            </div>
         </a>
      <!-- /.description-block -->
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <!-- <div class="box">
    <div class="box-body"> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);?>
    <!-- </div>
    </div> -->
    </div>
</div>