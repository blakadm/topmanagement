<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DocumentationID') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'DocumentContent') ?>

    <?= $form->field($model, 'CategoryID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
