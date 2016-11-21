<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,  'options' => [
                    'id' => 'create-field-form'
]]);


echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'property_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($properties, 'id', 'title')],
        ],
    ]
]);


echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'actions'=>[
            'type'=>Form::INPUT_RAW, 
            'value'=>'<div style="text-align: right; margin-top: 20px">' . 
                Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                Html::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) . 
                '</div>'
        ],
    ]
]);

ActiveForm::end();
?>