<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datecontrol\DateControl;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\Alert;
use yii\bootstrap\Progress;
use app\models\AnnouncementType;
/* @var $this yii\web\View */
/* @var $model app\models\Announcement */
/* @var $form yii\widgets\ActiveForm */
$this->registerJS('
   $(".modal").modal({backdrop:"static",keyboard:"false"})

');
if (Yii::$app->request->post()) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success',
        ],
        'body' => 'Record successfully Saved',
    ]);
}
?>

 <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-user-times fa-adn"></i> Announcement</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'AnnouncementID', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'AnnouncementTypeID')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(Announcementtype::find()->where('AnnouncementTypeID>=1')->orderBy('AnnouncementType')->all(), 'AnnouncementTypeID', 'AnnouncementType'),
        'options' => ['placeholder' => 'Choose Announcementtype'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'Title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>
        </div>
    </div>
            <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'StartDate')->widget(DateControl::classname(), [
        'type' =>DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => false,
        'autoWidget' => true,
        'displayFormat' => 'php:m/d/Y',
        'saveFormat' => 'php:Y-m-d',
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose StartDate',
                'autoclose' => true
            ],
        ],
    ]); ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'EndDate')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => false,
        'autoWidget' => true,
        'displayFormat' => 'php:m/d/Y',
        'saveFormat' => 'php:Y-m-d',
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose EndDate',
                'autoclose' => true
            ]
        ],
    ]); ?>
        </div>
    </div>
    <?= $form->field($model, 'Announcement')->widget(TinyMce::className(), [
    'options' => ['rows' => 10],
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
    ]);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), "/announcement" , ['class'=> 'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
        </div>
 </div>
