<?php
/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
?>
<h2>Search Documentation</h2>
<div class="row">
    <div class="col-md-8">
        <?php $form = ActiveForm::begin(['id' => 'search-form']); ?>
        <div class="input-group col-md-5">
            <input type="text" name="SearchText" class="form-control" placeholder="Enter keywords to search">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
            </span>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p><h3>Results:</h3></p>
    <div class="col-md-5" style="font-size: 18px">
            <ol>
                <li><a href="/">How to modify profile</a></li>
            </ol>
        </div>
    </div>
</div>
    
