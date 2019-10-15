<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datecontrol\DateControl;
use dosamigos\tinymce\TinyMce;
//use dominus77\tinymce\TinyMce;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        if($model->isNewRecord){
           $form->field($model, 'UserID')->hiddenInput(['value'=>yii::$app->user->identity->id])->label(false);
        }else{
           $form->field($model, 'UserID')->hiddenInput();
        }  
    ?>
    <?= $form->field($model, 'PostTitle')->textInput(['maxlength' => true]) ?>
    <?php 
       if($model->isNewRecord){
            echo $form->field($model, 'DateCreated')->textInput(['value'=>'2017-12-6']);
       }else{
            $form->field($model, 'DateCreated')->hiddenInput();
            echo $form->field($model, 'DateCreated')->label();
       }
            
    ?>
    <?=
            $form->field($model, 'PostContent')->widget(TinyMce::className(), [
                'options' => ['rows' => 12],
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste",
                        "image imagetools spellchecker visualchars textcolor",
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    'image_advtab' => true,
                    'templates' => [
                        ['title' => 'Test template 1', 'content' => 'Test 1'],
                        ['title' => 'Test template 2', 'content' => 'Test 2']
                    ],
                    'visualblocks_default_state' => true,
                    'image_title' => true,
                    'images_upload_url' => '/help/postimage',
                    // here we add custom filepicker only to Image dialog
                    'file_picker_types' => 'image',
                    // and here's our custom image picker
                    'file_picker_callback' => new JsExpression("function(callback, value, meta) {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');

                        //If this is not included, the onchange function will not
                        //be called the first time a file is chosen 
                        //(at least in Chrome 58)
                        var foo = document.getElementById('cms-page_content_ifr');
                        foo.appendChild(input);
                    
                        input.onchange = function() {
                            //alert('File Input Changed');
                           // console.log( this.files[0] );

                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function () {
                                // Note: Now we need to register the blob in TinyMCEs image blob
                                // registry. In the next release this part hopefully won't be
                                // necessary, as we are looking to handle it internally.

                                //Remove the first period and any thing after it 
                                var rm_ext_regex = /(\.[^.]+)+/;
                                var fname = file.name;
                                fname = fname.replace( rm_ext_regex, '');

                                //Make sure filename is benign
                                var fname_regex = /^([A-Za-z0-9])+([-_])*([A-Za-z0-9-_]*)$/;
                                if( fname_regex.test( fname ) ) {
                                    var id = fname + '-' + (new Date()).getTime(); //'blobid' + (new Date()).getTime();
                                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                    var blobInfo = blobCache.create(id, file, reader.result);
                                    blobCache.add(blobInfo);

                                    // call the callback and populate the Title field with the file name
                                    callback(blobInfo.blobUri(), { title: file.name });
                                }else {
                                    alert( 'Invalid file name' );
                                }
                            };
                            //To get get rid of file picker input
                            this.parentNode.removeChild(this);
                    };
                    input.click();
                    }")
                ],
                //'fileManager' => [
                //   'class' => \dominus77\tinymce\components\MihaildevElFinder::className(),
                //],
            ]);
            ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
