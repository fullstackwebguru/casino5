<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'options' => ['enctype'=>'multipart/form-data']]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter title...']]
    ]
]);

echo $form->field($model, 'temp_image_logo')->widget(
    FileInput::classname(), 
    [  
        'options' => [
            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'showUpload' => false,
        ]
    ]
);

echo $form->field($model, 'temp_image')->widget(
    FileInput::classname(), 
    [  
        'options' => [
            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'showUpload' => false,
        ]
    ]
);

echo $form->field($model, 'description')->widget(
    MarkdownEditor::classname(), 
    ['height' => 300, 'encodeLabels' => false]
);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'website_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter website url...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'type_of_games'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter type of games...']]
    ]
]);


echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'bonus_as_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Bonnus Offers...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'bonus_offer'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Bonnus Offers...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'software'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter softwares...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'support'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter how you support...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'currencies'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'USD, EUR']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'languages'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'English, German']]
    ]
]);

echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>1,
    'attributes'=>[
        'rating'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter company rating...']
        ],
    ]
]);


echo $form->field($model, 'review')->widget(
    MarkdownEditor::classname(), 
    ['height' => 300, 'encodeLabels' => false]
);


echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>5,
    'attributes'=>[
        'feature_mobile'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Yes', false=>'No'], 
            'options'=>['inline'=>true]
        ],
        'feature_instant_play'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Yes', false=>'No'], 
            'options'=>['inline'=>true]
        ],
        'feature_download'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Yes', false=>'No'], 
            'options'=>['inline'=>true]
        ],
        'feature_live_casino'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Yes', false=>'No'], 
            'options'=>['inline'=>true]
        ],
        'feature_vip_program'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Yes', false=>'No'], 
            'options'=>['inline'=>true]
        ],
    ]
]);


echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_description'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter description for SEO...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_keywords'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter keywords for SEO...']]
    ]
]);
   
echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
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