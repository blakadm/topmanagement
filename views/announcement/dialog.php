<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use kartik\dialog\Dialog;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
// widget with default options
echo Dialog::widget();

// buttons for testing the krajee dialog boxes
$btns = <<< HTML
<button type="button" id="btn-alert" class="btn btn-info">Alert</button>
<button type="button" id="btn-confirm" class="btn btn-warning">Confirm</button>
<button type="button" id="btn-prompt" class="btn btn-primary">Prompt</button>
<button type="button" id="btn-dialog" class="btn btn-default">Dialog</button>
HTML;
echo $btns;
 
// javascript for triggering the dialogs
$js = <<< JS
$("#btn-alert").on("click", function() {
    krajeeDialog.alert("This is a Krajee Dialog Alert!")
});
$("#btn-confirm").on("click", function() {
    krajeeDialog.confirm("Are you sure you want to proceed?", function (result) {
        if (result) {
            alert('Great! You accepted!');
        } else {
            alert('Oops! You declined!');
        }
    });
});
$("#btn-prompt").on("click", function() {
    krajeeDialog.prompt({label:'Provide reason', placeholder:'Upto 30 characters...'}, function (result) {
        if (result) {
            alert('Great! You provided a reason: ' + result);
        } else {
            alert('Oops! You declined to provide a reason!');
        }
    });
});
$("#btn-dialog").on("click", function() {
    krajeeDialog.dialog(
        'This is a <b>custom dialog</b>. The dialog box is <em>draggable</em> by default and <em>closable</em> ' +
        '(try it). Note that the Ok and Cancel buttons will do nothing here until you write the relevant JS code ' +
        'for the buttons within "options". Exit the dialog by clicking the cross icon on the top right.',
        function (result) {alert(result);}
    );
});
JS;
 
// register your javascript
$this->registerJs($js);
$form = ActiveForm::begin();
 
// Basic Checkbox X with ActiveForm. Check the model validation, when you set the value to null. 
// You can also navigate using keyboard navigation keys and use the `space bar` key to modify.
//echo $form->field($model, 'status')->widget(CheckboxX::classname(), []); 
 
// Allow only 2 states for the checkbox. Add your own label markup for the checkbox (which can be clicked to set the value).
echo '<label class="cbx-label" for="s_1">Is Active?</label>';
echo CheckboxX::widget([
    'name'=>'s_1',
    'options'=>['id'=>'s_1'],
    'pluginOptions'=>['threeState'=>false]
]);
 
//  Inline label alignment options - left, right, or enclosed. Also note checkbox with initial values.
echo '<label class="cbx-label" for="s_2">Left</label>';
echo CheckboxX::widget([
    'name'=>'s_2',
    'value'=>1,
    'options'=>['id'=>'s_2']
]); ?>
<span style="border-left: 1px solid #ddd; margin:0 15px 0 11px;"></span>
<?php echo CheckboxX::widget([
    'name'=>'s_3',
    'value'=>0,
    'options'=>['id'=>'s_3']
]);
echo '<label class="cbx-label" for="s_3">Right</label>'; ?>
<span style="border-left: 1px solid #ddd; margin:0 15px 0 11px;"></span>
<?php 
// Control checkbox sizes.
echo CheckboxX::widget(['name'=>'s_5', 'options'=>['id'=>'s_5'], 'pluginOptions'=>['size'=>'xs']]); 
echo '<label class="cbx-label" for="s_5">xs</label>';
echo CheckboxX::widget(['name'=>'s_6', 'options'=>['id'=>'s_6'], 'pluginOptions'=>['size'=>'sm']]); 
echo '<label class="cbx-label" for="s_6">sm</label>';
echo CheckboxX::widget(['name'=>'s_7', 'options'=>['id'=>'s_7'], 'pluginOptions'=>['size'=>'md']]); 
echo '<label class="cbx-label" for="s_7">md</label>';
echo CheckboxX::widget(['name'=>'s_8', 'options'=>['id'=>'s_8'], 'pluginOptions'=>['size'=>'lg']]); 
echo '<label class="cbx-label" for="s_8">lg</label>';
echo CheckboxX::widget(['name'=>'s_9', 'options'=>['id'=>'s_9'], 'pluginOptions'=>['size'=>'xl']]); 
echo '<label class="cbx-label" for="s_9">xl</label>';
 
// Disabled and readonly checkboxes
echo CheckboxX::widget([
    'name'=>'s_10', 
    'value'=>1,
    'disabled'=>true,
    'options'=>['id'=>'s_10'], 
]); 
echo '<label class="cbx-label" for="s_5" class="text-muted">Disabled</label>';
echo CheckboxX::widget([
    'name'=>'s_11',
    'readonly'=>true, 
    'options'=>['id'=>'s_11'], 
]);
echo '<label class="cbx-label" for="s_11" class="text-muted">Readonly</label>';
 
// Block style checkboxes like in checkbox list. Customize indicators for checked, 
// unchecked, and indeterminate states.
$pluginOptions = [
    'inline'=>false, 
    'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
    'iconUnchecked'=>'<i class="glyphicon glyphicon-minus"></i>',
    'iconNull'=>'<i class="glyphicon glyphicon-remove"></i>'
];
echo CheckboxX::widget([
    'name'=>'s_12', 
    'value'=>1,
    'pluginOptions'=>$pluginOptions
]);
echo CheckboxX::widget([
    'name'=>'s_13', 
    'value'=>0,
    'pluginOptions'=>$pluginOptions
]);
echo CheckboxX::widget([
    'name'=>'s_14',
    'pluginOptions'=>$pluginOptions
]);
 
// Advanced label styling and positioning when using with Yii ActiveForm & ActiveField. 
// Shows how you can right align labels by changing the template property of ActiveField. 
// You can also control the HTML attributes for the label via `labelOptions`.
//echo $form->field($model, 'rememberMe', [
//    'template' => '{input}{label}{error}{hint}',
//    'labelOptions' => ['class' => 'cbx-label']
//])->widget(CheckboxX::classname(), ['autoLabel'=>false]);
ActiveForm::end();
