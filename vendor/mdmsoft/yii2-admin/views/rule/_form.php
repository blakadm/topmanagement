<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */
/* @var $form ActiveForm */
?>
<div class="row div-hr" style="padding-left: 15px">
    <a href="/admin/" class="btn btn-primary"></i>Assignment</a>
    <a href="/admin/user" class="btn btn-primary"></i>User</a>
    <a href="/admin/route" class="btn btn-primary"></i>Route</a>
    <a href="/admin/role" class="btn btn-primary"></i>Role</a>
    <a href="/admin/permission" class="btn btn-primary"></i>Permissions</a>
    <a href="/admin/menu" class="btn btn-primary"></i>Menu</a>
    <a href="/admin/rule" class="btn btn-primary"></i>Rule</a>
</div>
<div class="auth-item-form">
     <div class="panel panel-default col-xs-6">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Rules</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-8">
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
    <?= $form->field($model, 'className')->textInput() ?>
                </div>
            </div>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
     </div>
</div>
