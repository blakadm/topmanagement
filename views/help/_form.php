<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;
use dosamigos\ckeditor\CKEditor;
//use dominus77\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Documentation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentation-form">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book"></i> Update Documentation</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?=
            $form->field($model, 'CategoryID')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->where('CategoryID>=1')->orderBy('Category')->all(), 'CategoryID', 'Category'),
                'options' => ['placeholder' => 'Choose Category'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>
            <?=
            $form->field($model, 'DocumentContent')->widget(CKEditor::className(), [
                'options' => ['rows' => 12],
                'preset' => 'full',
                'clientOptions' => [
                   'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
                ]
            ]);
            ?>
            <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?= Html::a('Cancel', ['/help'], ['class' => 'btn btn-danger']) ?>
            </div>

<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
